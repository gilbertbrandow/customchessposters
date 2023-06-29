<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Game;
use App\Models\Poster;
use App\Models\PosterUser;
use App\Models\User;
use Image;

use function App\diagramInfo;
use function App\formatPGN;

class PosterService
{

    public function create($posterData): Poster
    {
        //Search in DB for exact record except id
        array_shift($posterData);

        return Poster::firstOrCreate($posterData);
    }

    public function update($posterData, $userId, $sessionToken): Poster
    {

        //Hit this method when trying to update a poster with id that corresponds with a record in db
        $id = array_shift($posterData);

        //Search in DB for exact record, if match. Simply use that poster id
        $poster = Poster::where($posterData)->first();

        if (!$poster) {

            //Check if admin or the id of the poster has any relationship with either a cart, saved poster or game of another user
            if (
                User::find($userId, 'admin')->admin || (!Game::where('poster_id', '=', $id)->first()
                    && !PosterUser::where('poster_id', '=', $id)->where('user_id', '!=', $userId)->first()
                    && !Cart::hasPosterNotUser($id, [$userId, $sessionToken])->get())
            ) {
                //Either user is admin or no relationship found to any game, user or cart except for current
                $poster = Poster::find($id)->update($posterData);
            } else {
                $poster = Poster::create($posterData);
            }
        }

        if ($poster->id != $id) {

            //When the poster gets a new id by finding or creating, he current users relationships with the old poster needs to be updated
            PosterUser::where('user_id', '=', $userId)->where('poster_id', '=', $id)->update(['poster_id' => $poster->id]);
        }

        //Return poster
        return $poster;
    }

    public function generatePNG(Poster $poster): string
    {

        /*
        |--------------------------------------------------------------------------
        | Check if file exists and is up to date
        |--------------------------------------------------------------------------
        |
        */
        
        if(file_exists($path = public_path('uploads/poster' . $poster->id . '.png'))
        && filemtime($path) > strtotime($poster->updated_at)) return $path;

        /*
        |--------------------------------------------------------------------------
        | Start building image
        |--------------------------------------------------------------------------
        |
        */

        $fonts['regular'] = public_path('../resources/fonts/Custom-Serif-By-Ayaka-Ito-Regular.ttf');
        $fonts['italic'] = public_path('../resources/fonts/Custom-Serif-By-Ayaka-Ito-Italic.ttf');

        $im =  Image::canvas(2000, 3000, 'rgb(251, 246, 238)');

        /*
        |--------------------------------------------------------------------------
        | Print the title
        |--------------------------------------------------------------------------
        |
        */

        for ($i = 0; $i < count($title = explode("\n", wordwrap($poster->title, 26))); $i++) {

            $im->text($title[$i], 1000, 300 + $i * 200, function ($font) use ($fonts) {
                $font->file($fonts['regular']);
                $font->size(150);
                $font->align('center');
                $font->valign('middle');
                $font->color('rgb(65, 37, 29)');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Print the PGN
        |--------------------------------------------------------------------------
        |
        */

        for ($i = 0; $i < count($pgn = formatPGN($poster->pgn)); $i++) {

            $im->text($pgn[$i], 1000, 2900 - (40 * (count($pgn) - 1 - $i)), function ($font) use ($fonts) {
                $font->file($fonts['regular']);
                $font->size(18);
                $font->align('center');
                $font->color('rgb(65, 37, 29)');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Print the result
        |--------------------------------------------------------------------------
        |
        */

        $im->text('| 1-0', 1000 + 3.7 * strlen($pgn[count($pgn) - 1]), 2900, function ($font) use ($fonts) {
            $font->file($fonts['regular']);
            $font->size(18);
            $font->align('left');
            $font->color('rgb(65, 37, 29)');
        });

        /*
        |--------------------------------------------------------------------------
        | Print the metadata
        |--------------------------------------------------------------------------
        |
        */
        $im->text($poster->white_title . ' ' . $poster->white_player . ' - ' . $poster->black_title . ' ' . $poster->black_player, 1000, 500 + 200 * (count($title) - 1), function ($font) use ($fonts) {
            $font->file($fonts['regular']);
            $font->size(70);
            $font->align('center');
            $font->valign('middle');
            $font->color('rgb(65, 37, 29)');
        });

        $im->text($poster->where . ($poster->where && $poster->when ? ' | ' : '') . $poster->when, 1000, 600 + 200 * (count($title) - 1), function ($font) use ($fonts) {
            $font->file($fonts['italic']);
            $font->size(40);
            $font->align('center');
            $font->valign('middle');
            $font->color('rgb(65, 37, 29)');
        });

        /*
        |--------------------------------------------------------------------------
        | Insert board
        |--------------------------------------------------------------------------
        |
        */

        $im->insert(public_path('/themes/New Waves/board.svg'), 'top-left', 200, 27 + $boardY = ((min(2900 - (40 * (count($pgn))), 2860) - (isset($title[1]) ? 800 : 600)) / 2) - (isset($title[1]) ? 0 : 200));

        /*
        |--------------------------------------------------------------------------
        | Print the rows and columns indication
        |--------------------------------------------------------------------------
        |
        */

        for ($x = 0; $x < 8; $x++) {

            $im->text(chr($poster->orientation ? 97 + $x : 104 - $x), 5 + 200 * ($x + 1), 10 + $boardY, function ($font) use ($fonts) {
                $font->file($fonts['regular']);
                $font->size(40);
                $font->color('rgb(65, 37, 29)');
            });

            $im->text($poster->orientation ? 8 - $x : $x + 1  . '.', 1825, ($boardY + 70 + 200 * $x), function ($font) use ($fonts) {
                $font->file($fonts['regular']);
                $font->size(40);
                $font->color('rgb(65, 37, 29)');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Insert pieces
        |--------------------------------------------------------------------------
        |
        */

        for($i = 0, $row = 0, $column = 0; $i < strlen($poster->fen); $i++) {

            if($poster->fen[$i] == " ") {
                break; 
            } else if ($poster->fen[$i] == "/") {

                $row++;
                $column = 0;

            } else if(preg_match('~[0-9]+~', $poster->fen[$i])) {
                $column += (int)$poster->fen[$i];
            } else {
                $im->insert(public_path('/themes/New Waves/'. (ctype_lower($poster->fen[$i]) ? 'Black' : 'White') .'/'. strtolower($poster->fen[$i]) .'.svg'), 'top-left', 200 * ($column + 1), 27 + 200 * $row  + $boardY = ((min(2900 - (40 * (count($pgn))), 2860) - (isset($title[1]) ? 800 : 600)) / 2) - (isset($title[1]) ? 0 : 200));
                $column++;
            
            } 
        }


        /*
        |--------------------------------------------------------------------------
        | Print the diagram comment
        |--------------------------------------------------------------------------
        |
        */

        $im->text(diagramInfo($poster->pgn, $poster->move_comment, $poster->diagram_position), 1000, $boardY + 1690, function ($font) use ($fonts) {
            $font->file($fonts['italic']);
            $font->size(32);
            $font->align('center');
            $font->color('rgb(65, 37, 29)');
        });

        $im->save($path);

        return $path;
    }
}
