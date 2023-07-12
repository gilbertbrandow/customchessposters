<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Game;
use App\Models\Poster;
use App\Models\PosterUser;
use App\Models\User;
use Image;
use Storage;

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

    public function generatePNG(Poster $poster, $width = 2000, $height = 3000): string
    {

        /*
        |--------------------------------------------------------------------------
        | Connect to filesystem and check if up-to-date file exists
        |--------------------------------------------------------------------------
        |
        */
        $filesystem = Storage::disk('s3');
 
        if (
            $filesystem->exists($path = 'poster' . $poster->id . '.png')
            && $filesystem->lastModified($path) > strtotime($poster->updated_at) && false
        ) return $filesystem->publicUrl($path);

        /*
        |--------------------------------------------------------------------------
        | Start building image
        |--------------------------------------------------------------------------
        |
        */

        $fonts['regular'] = public_path('../resources/fonts/Custom-Serif-By-Ayaka-Ito-Regular.ttf');
        $fonts['italic'] = public_path('../resources/fonts/Custom-Serif-By-Ayaka-Ito-Italic.ttf');

        $im =  Image::canvas($width, $height, 'rgb(251, 246, 238)');

        /*
        |--------------------------------------------------------------------------
        | Print the title
        |--------------------------------------------------------------------------
        |
        */

        for ($i = 0; $i < count($title = explode("\n", wordwrap($poster->title, 26))); $i++) {

            $im->text($title[$i], $width / 2, $height / 10 + $i * $height / 15, function ($font) use ($fonts, $height) {
                $font->file($fonts['regular']);
                $font->size($height / 20);
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

        for ($i = 0; $i < count($pgn = ($poster->pgn ? formatPGN($poster->pgn) : [])); $i++) {

            $im->text($pgn[$i] . ($i + 1 == count($pgn) ? ' | ' . $poster->result : ''), $width / 2, $height / 30 * 29 - ($height * 0.0125 * (count($pgn) - 1 - $i)), function ($font) use ($fonts, $height) {
                $font->file($fonts['regular']);
                $font->size($height * 0.006);
                $font->align('center');
                $font->color('rgb(65, 37, 29)');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Print the metadata
        |--------------------------------------------------------------------------
        |
        */
        $im->text($poster->white_title . ' ' . $poster->white_player . ' - ' . $poster->black_title . ' ' . $poster->black_player, $width / 2, $height / 6 + $height / 15 * (count($title) - 1), function ($font) use ($fonts, $height) {
            $font->file($fonts['regular']);
            $font->size($height / 300 * 7);
            $font->align('center');
            $font->valign('middle');
            $font->color('rgb(65, 37, 29)');
        });

        $im->text($poster->where . ($poster->where && $poster->when ? ' | ' : '') . $poster->when, $width / 2, $height / 5 + $height / 15 * (count($title) - 1), function ($font) use ($fonts, $height) {
            $font->file($fonts['italic']);
            $font->size($height / 300 * 4);
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

        $im->insert(public_path('/themes/New Waves/board.svg'), 'top-center', $width / 2, 27 + $boardY = ((min($height / 30 * 29 - ($height / 75 * (count($pgn))), $height / 3000 * 2860) - (isset($title[1]) ? $height / 3.75 : $height / 5)) / 2) - (isset($title[1]) ? 0 : $height / 15));

        /*
        |--------------------------------------------------------------------------
        | Print the rows and columns indication
        |--------------------------------------------------------------------------
        |
        */

        for ($x = 0; $x < 8; $x++) {

            $im->text(chr($poster->orientation ? 97 + $x : 104 - $x), $height / 600 + $height / 15 * ($x + 1), $height / 300 + $boardY, function ($font) use ($fonts, $height) {
                $font->file($fonts['regular']);
                $font->size($height / 75);
                $font->color('rgb(65, 37, 29)');
            });

            $im->text($poster->orientation ? 8 - $x : $x + 1  . '.', $height / 3000 * 1825, ($boardY + $height / 300 * 7 + $height / 15 * $x), function ($font) use ($fonts, $height) {
                $font->file($fonts['regular']);
                $font->size($height / 75);
                $font->color('rgb(65, 37, 29)');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Insert pieces
        |--------------------------------------------------------------------------
        |
        */

        for ($i = 0, $row = 0, $column = 0; $i < strlen($poster->fen); $i++) {

            if ($poster->fen[$i] == " ") {
                break;
            } else if ($poster->fen[$i] == "/") {

                $row++;
                $column = 0;
            } else if (preg_match('~[0-9]+~', $poster->fen[$i])) {
                $column += (int)$poster->fen[$i];
            } else {
                $im->insert(public_path('/themes/New Waves/' . (ctype_lower($poster->fen[$i]) ? 'Black' : 'White') . '/' . strtolower($poster->fen[$i]) . '.svg'), 'top-left', 200 * ($column + 1), 27 + 200 * $row  + $boardY);
                $column++;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Print the diagram comment
        |--------------------------------------------------------------------------
        |
        */

        if($poster->pgn) {
            $im->text(diagramInfo($poster->pgn, $poster->move_comment, $poster->diagram_position), $width / 2, $boardY + $height / 3000 * 1690, function ($font) use ($fonts, $height) {
                $font->file($fonts['italic']);
                $font->size($height / 3000 * 32);
                $font->align('center');
                $font->color('rgb(65, 37, 29)');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Save the image and return
        |--------------------------------------------------------------------------
        |
        */

        $im->encode('png'); 
        $filesystem->put($path, $im->getEncoded());

        return $filesystem->url($path);
    }
}
