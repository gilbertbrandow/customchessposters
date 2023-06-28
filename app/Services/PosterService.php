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

    public function generatePNG(Poster $poster)
    {

        $path = 'image.png';
        $fontPath = public_path('../resources/fonts/Custom-Serif-By-Ayaka-Ito-regular.ttf'); 
        $title = explode("\n", wordwrap($poster->title, 26));

        $pgn = formatPGN($poster->pgn); 

        dd($pgn); 

        //Generate svg file if not exists
        $im =  Image::canvas(2000, 3000, 'rgb(251, 246, 238)');

        $im->insert(public_path('/uploads/posters/svg/poster15.svg')); 


        for ($i = 0; $i < count($title); $i++) {

            $im->text($title[$i], 1000, 300 + $i * 200, function ($font) use ($fontPath) {
                $font->file($fontPath);
                $font->size(150);
                $font->align('center');
                $font->valign('middle');
                $font->color('rgb(65, 37, 29)');
            });
        }

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

            $im->text(chr($poster->orientation ? 97 + $x : 104 - $x), (190 + 200 * $x), 930, function ($font) use ($fontPath) {
                $font->file($fontPath);
                $font->size(40);
                $font->color('rgb(65, 37, 29)');
            });

            $im->text($poster->orientation ? 8 - $x : $x + 1  . '.', 1815, (980 + 200 * $x), function ($font) use ($fontPath) {
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


        $im->save($path);

        return $path;
    }

    public function generateSVG(Poster $poster)
    {

        //generate svg file and write to temp file
        $path = 'images/poster.svg';
        $bgcolor = 'rgb(0, 0, 0)';
        $color = '#000000';
        $font = 'Custom Serif By Ayaka Ito';

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 2000 3000" style="background-color: ' . $bgcolor . ';  fill: ' . $color . '; font-family: ' . $font . ';">';

        $svg .= '<text id="title" font-size="150" text-anchor="middle" font-weight="400">
                    <tspan x="1000" y="300">Testing row</tspan>
                    <tspan x="1000" y="500">Testing row 2</tspan>
                    </text>';

        $svg .= "<style>
         @font-face {
           font-family: 'Custom Serif By Ayaka Ito';
           src: local('Custom Serif By Ayaka Ito'), url(data:font/ttf;base64)
         }
         </style>";

        $svg .= '</svg>';

        //Write to file
        $myfile = fopen($path, "w") or die("Unable to open file!");
        fwrite($myfile, $svg);
        fclose($myfile);

        return $path;
    }
}
