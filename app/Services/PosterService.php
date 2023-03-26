<?php

namespace App\Services;

use App\Models\Poster;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PosterService
{

    public function savePoster($posterData, $name): Poster
    {
        $posterData["pgn"] = $posterData["pgn"] ? $posterData["pgn"] : "";
        $id = array_shift($posterData['id']);

        //Search in DB for exact record
        $poster = Poster::where($posterData)->first();

        if (!$poster) { //What happens when a user tries to save an exact copy of their own design?

            //Check if it was an edit of existing poster
            if ($poster = Poster::find($id)) {

                if ($poster->usersSaved->count() == 1 && $poster->usersSaved->first()->id == Auth::id()) {

                    //Existing poster record can be updated
                    $poster->update($posterData)->save();
                    return $poster;

                } else {

                    //The old relationship needs to be detached since that poster can not be updated
                    User::find(Auth::id())->savedPosters()->detach($id);
                }
            }

            $poster = Poster::create($posterData);
        }

        //Attach a relationship
        $poster->users_saved()->attach([Auth::id() => ['name' => $name]]);

        return $poster;
    }

    public function createPng($posterData, $size)
    {
        //Create and return path to png?
        $path = "";
        
        return $path;

    }
}
