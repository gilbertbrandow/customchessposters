<?php

namespace App\Services;

use App\Models\Poster;
use App\Models\User;

class PosterService
{

    public function savePoster($posterData, $user): Poster
    {
        $posterData["pgn"] = $posterData["pgn"] ? $posterData["pgn"] : "";
        $id = array_shift($posterData);


        //Search in DB for exact record
        $poster = Poster::where($posterData)->first();

        if (!$poster) {

            //Check if it was an edit of existing poster
            if ($poster = Poster::find($id)) {
                if ($poster->usersSaved->count() == 1 && $poster->usersSaved->first()->id == $user->id) {

                    //Existing poster record can be updated, no need to attach relationship
                    $poster->update($posterData)->save();
                    return $poster;
                } else {

                    //The old relationship needs to be detached since that poster can not be updated
                    $user->savedPosters()->detach($id);
                }
            }

            $poster = Poster::create($posterData);
        }

        //Attach a relationship
        $poster->usersSaved()->attach($user->id);

        session()->flash('savedSuccess', 'A poster was saved!');

        return $poster;
    }

    public function createPng($posterData, $size)
    {
        //Create and return path to png?
        $path = "";

        return $path;
    }
}
