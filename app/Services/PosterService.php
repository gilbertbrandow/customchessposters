<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Game;
use App\Models\Poster;
use App\Models\PosterUser;
use App\Models\User;
use Image;
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

        $path = 'poster' . $poster->id . '.png';
        $fontPath = public_path('../resources/fonts/Custom-Serif-By-Ayaka-Ito-regular.ttf');

        $title = explode("\n", wordwrap($poster->title, 26));
        $pgn = formatPGN($poster->pgn);

        $boardY = ((min(2900 - (40 * (count($pgn))), 2860) - (isset($title[1]) ? 800 : 600)) / 2) - (isset($title[1]) ? 0 : 200); 

        $im =  Image::canvas(2000, 3000, 'rgb(251, 246, 238)');

        $im->insert(public_path('/uploads/posters/svg/poster2.svg'));


        //Print the title
        for ($i = 0; $i < count($title); $i++) {

            $im->text($title[$i], 1000, 300 + $i * 200, function ($font) use ($fontPath) {
                $font->file($fontPath);
                $font->size(150);
                $font->align('center');
                $font->valign('middle');
                $font->color('rgb(65, 37, 29)');
            });
        }

        //Print the metadata
        $im->text($poster->white_title . ' ' . $poster->white_player . ' - ' . $poster->black_title . ' ' . $poster->black_player, 1000, 500 + 200 * (count($title) - 1), function ($font) use ($fontPath) {
            $font->file($fontPath);
            $font->size(70);
            $font->align('center');
            $font->valign('middle');
            $font->color('rgb(65, 37, 29)');
        });

        $im->text($poster->where . ($poster->where && $poster->when ? ' | ' : '') . $poster->when, 1000, 600 + 200 * (count($title) - 1), function ($font) use ($fontPath) {
            $font->file($fontPath);
            $font->size(40);
            $font->align('center');
            $font->valign('middle');
            $font->color('rgb(65, 37, 29)');
        });

        //Generate columns and rows indication
        for ($x = 0; $x < 8; $x++) {

            $im->text(chr($poster->orientation ? 97 + $x : 104 - $x), (190 + 200 * $x), $boardY, function ($font) use ($fontPath) {
                $font->file($fontPath);
                $font->size(40);
                $font->color('rgb(65, 37, 29)');
            });

            $im->text($poster->orientation ? 8 - $x : $x + 1  . '.', 1825, ($boardY + 70 + 200 * $x), function ($font) use ($fontPath) {
                $font->file($fontPath);
                $font->size(40);
                $font->color('rgb(65, 37, 29)');
            });
        }

        $im->text("Position after White's move 12. Nxf7, Inviting the King for a walk", 1000, 2600, function ($font) use ($fontPath) {
            $font->file($fontPath);
            $font->size(32);
            $font->align('center');
            $font->valign('middle');
            $font->color('rgb(65, 37, 29)');
        });

        //Print the pgn rows
        for ($i = 0; $i < count($pgn); $i++) {

            $im->text($pgn[$i], 1000, 2900 - (40 * (count($pgn) - 1 - $i)), function ($font) use ($fontPath) {
                $font->file($fontPath);
                $font->size(18);
                $font->align('center');
                $font->valign('middle');
                $font->color('rgb(65, 37, 29)');
            });
        }

        $im->save($path);

        return $path;
    }
}
