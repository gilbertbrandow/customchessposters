<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Game;
use App\Models\Poster;
use App\Models\PosterUser;
use Auth;
use Image;
use Storage;

use function App\diagramInfo;
use function App\formatPGN;

class PosterService
{

    public function create($posterData): Poster
    {
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
                Auth::user()->admin || (!Game::where('poster_id', '=', $id)->first()
                    && !PosterUser::where('poster_id', '=', $id)->where('user_id', '!=', $userId)->first()
                    && !Cart::hasPosterNotUser($id, [$userId, $sessionToken])->get())
            ) {
                //Either user is admin or no relationship found to any game, user or cart except for current
                $poster = Poster::find($id);
                $poster->update($posterData);
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

    /***
     * @param Poster $poster The poster of which the PNG will be created
     * @param int $width The width of the PNG in pixels 
     * @param int $height The height of the PNG in pixels 
     * @return string The url to the PNG in AWS S3
     */

    public function generatePNG(
        Poster $poster,
        $width = 6000,
        $height = 8550,
        $noCache = false
    ): string {

        /*
        |--------------------------------------------------------------------------
        | Connect to filesystem and check if up-to-date file exists
        |--------------------------------------------------------------------------
        |
        */

        $filesystem = Storage::disk('s3');

        if (
            $filesystem->exists($path = 'poster' . $poster->id . '-' . $width . 'x' . $height . '.png')
            && $filesystem->lastModified($path) > strtotime($poster->updated_at)
            && !$noCache
        ) return $filesystem->publicUrl($path);

        /*
        |--------------------------------------------------------------------------
        | Start building image
        |--------------------------------------------------------------------------
        |
        */

        $im =  Image::canvas($width, $height, $poster->theme->background);

        /*
        |--------------------------------------------------------------------------
        | Print the title
        |--------------------------------------------------------------------------
        |
        */

        for ($i = 0; $i < count($title = explode("\n", wordwrap($poster->title, 26))); $i++) {

            $im->text(
                $title[$i],
                intval($width / 2),
                $height / 10 + $i * $height / 15,

                function ($font) use ($poster, $height) {
                    $font->file(resource_path($poster->theme->font_regular));
                    $font->size($height / 20);
                    $font->align('center');
                    $font->valign('middle');
                    $font->color($poster->theme->color);
                }
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Print the PGN
        |--------------------------------------------------------------------------
        |
        */

        for ($i = 0; $i < count($pgn = ($poster->pgn ? formatPGN($poster->pgn) : [])); $i++) {

            $im->text(
                $pgn[$i] . ($i + 1 == count($pgn) ? ' | ' . $poster->result : ''),
                intval($width / 2),
                $height / 30 * 29 - ($height * 0.0125 * (count($pgn) - 1 - $i)),

                function ($font) use ($poster, $height) {
                    $font->file(resource_path($poster->theme->font_regular));
                    $font->size($height * 0.006);
                    $font->align('center');
                    $font->color($poster->theme->color);
                }
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Print the metadata
        |--------------------------------------------------------------------------
        |
        */
        $im->text(
            $poster->white_title . ' ' . $poster->white_player . ($poster->white_rating ? '(' . $poster->white_rating . ')' : '') . ' - ' . $poster->black_title . ' ' . $poster->black_player . ($poster->black_rating ? '(' . $poster->black_rating . ')' : ''),
            intval($width / 2),
            $height / 6 + $height / 15 * (count($title) - 1),

            function ($font) use ($poster, $height) {
                $font->file(resource_path($poster->theme->font_regular));
                $font->size($height / 300 * 6);
                $font->align('center');
                $font->valign('middle');
                $font->color($poster->theme->color);
            }
        );

        $im->text(
            $poster->where . ($poster->where && $poster->when ? ' | ' : '') . $poster->when,
            intval($width / 2),
            $height / 5 + $height / 15 * (count($title) - 1),

            function ($font) use ($poster, $height) {
                $font->file(resource_path($poster->theme->font_italic));
                $font->size($height / 300 * 4);
                $font->align('center');
                $font->valign('middle');
                $font->color($poster->theme->color);
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Insert board
        |--------------------------------------------------------------------------
        |
        */

        $im->insert(
            public_path(
                'themes/' . $poster->theme->path . '/Board.svg'
            ),
            'top-center',
            intval($width / 2),
            27 + $boardY = intval(((min($height / 30 * 29 - ($height / 75 * (count($pgn))), $height / 3000 * 2860) - (isset($title[1]) ? $height / 3.75 : $height / 5)) / 2) - (isset($title[1]) ? 0 : $height / 15))
        );

        /*
        |--------------------------------------------------------------------------
        | Print the rows and columns indication
        |--------------------------------------------------------------------------
        |
        */

        for ($x = 0; $x < 8; $x++) {

            $im->text(
                chr($poster->orientation ? 97 + $x : 104 - $x),
                $height / 50 + $height / 15 * ($x + 1),
                $boardY - $height / 250,

                function ($font) use ($poster, $height) {
                    $font->file(resource_path($poster->theme->font_regular));
                    $font->size($height / 75);
                    $font->color($poster->theme->color);
                }
            );

            $im->text(
                $poster->orientation ? 8 - $x : $x + 1  . '.',
                $height / 3000 * 1875,
                $boardY + $height / 300 * 5 + $height / 15 * $x,

                function ($font) use ($poster, $height) {
                    $font->file(resource_path($poster->theme->font_regular));
                    $font->size($height / 75);
                    $font->color($poster->theme->color);
                }
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Insert square highlighting
        |--------------------------------------------------------------------------
        |
        */

        if ($poster->highlight_last_move) {

            $columnFrom = ord($poster->from[0]) - ord('a');
            $rowFrom = (int)$poster->from[1] - 1;
            $columnTo = ord($poster->to[0]) - ord('a');
            $rowTo = (int)$poster->to[1] - 1;

            if ($poster->theme_id == 1) {

                //New waves theme
                $im->insert(
                    public_path('themes/' . $poster->theme->path . '/Highlight.svg'),
                    'top-left',
                    intval(($width - 4560) / 2) + 570 * ($poster->orientation ? $columnTo : 7 - $columnTo),
                    $boardY + 25 + 570 * ($poster->orientation ? 7 - $rowTo : $rowTo),
                );

                $im->insert(
                    public_path('themes/' . $poster->theme->path . '/Highlight.svg'),
                    'top-left',
                    intval(($width - 4560) / 2) + 570 * ($poster->orientation ? $columnFrom : 7 - $columnFrom),
                    $boardY + 25 + 570 * ($poster->orientation ? 7 - $rowFrom : $rowFrom),
                );

            } else if ($poster->theme_id == 2) {

                //Old knowledge theme
                $im->insert(
                    public_path('themes/' . $poster->theme->path . '/Highlights/To.svg'),
                    'top-left',
                    intval(($width - 4560) / 2) + 570 * ($poster->orientation ? $columnTo : 7 - $columnTo) - 100,
                    $boardY + 25 + 570 * ($poster->orientation ? 7 - $rowTo : $rowTo) - 100,
                );

                $im->insert(
                    public_path('themes/' . $poster->theme->path . '/Highlights/From' . (($rowFrom + $columnFrom) % 2 == 1 ? 'White' : 'Black') . 'Square.svg'),
                    'top-left',
                    intval(($width - 4560) / 2) + 570 * ($poster->orientation ? $columnFrom : 7 - $columnFrom) - 100,
                    $boardY + 25 + 570 * ($poster->orientation ? 7 - $rowFrom : $rowFrom) - 100,
                );

            }
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

                $im->insert(
                    public_path('themes/' . $poster->theme->path . '/' . (ctype_lower($poster->fen[$i]) ? 'Black' : 'White') . '/' . strtolower($poster->fen[$i]) . '.svg'),
                    'top-left',
                    intval(($width - 4560) / 2) + 570 * ($poster->orientation ? $column : 7 - $column),
                    $boardY + 25 + 570 * ($poster->orientation ? $row : 7 - $row),
                );

                $column++;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Print the diagram comment
        |--------------------------------------------------------------------------
        |
        */

        if ($poster->pgn) {
            $im->text(
                diagramInfo($poster->pgn, $poster->move_comment ?? '', $poster->diagram_position),
                intval($width / 2),
                $boardY + $height / 3000 * 1690,

                function ($font) use ($poster, $height) {
                    $font->file(resource_path($poster->theme->font_italic));
                    $font->size($height / 3000 * 32);
                    $font->align('center');
                    $font->color($poster->theme->color);
                }
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Save the image and return url
        |--------------------------------------------------------------------------
        |
        */

        $im->encode('png');
        $filesystem->put($path, $im->getEncoded());

        return $filesystem->url($path);
    }
}
