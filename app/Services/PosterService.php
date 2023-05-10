<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Game;
use App\Models\Poster;
use App\Models\PosterUser;

class PosterService
{

    public function savePoster($posterData, $user): Poster
    {
        $posterData['pgn'] = $posterData['pgn'] ?? '';
        $id = array_shift($posterData);


        //Search in DB for exact record
        $poster = Poster::where($posterData)->first();

        if (!$poster) {
            if ($poster = Poster::find($id)) {
                if ($poster->usersSaved()->count() == 1 && $poster->usersSaved()->first()->id == $user->id) {

                    //Existing poster record can be updated, no need to attach relationship
                    $poster->update($posterData);
                    session()->flash('savedSuccess', 'A poster was saved!');
                    return $poster;
                } else {

                    //The old relationship needs to be detached since that poster can not be updated
                    $user->posters()->detach($id);
                }
            }

            //Create new record in database
            $poster = Poster::create($posterData);
        }

        //If user already has this poster poster saved, prevent duplicate relationships to same poster id
        if ($user->posters()->find($poster))  $user->posters()->detach($poster->id);

        //Attach user
        $poster->usersSaved()->attach($user->id);

        session()->flash('savedSuccess', 'A poster was saved!');

        return $poster;
    }

    public function create($posterData): Poster
    {
        //Hit this method when trying to create a poster that has no id
        $posterData['pgn'] = $posterData['pgn'] ?? '';

        //Search in DB for exact record, else create
        return Poster::firstOrCreate($posterData);
    }

    public function update($posterData, $sessionToken, $userId =  null): Poster
    {

        //Hit this method when trying to update a poster with id that corresponds with a record in db
        $posterData['pgn'] = $posterData['pgn'] ?? '';
        $id = array_shift($posterData);

        //Search in DB for exact record, if match. Simply use that id
        $poster = Poster::where($posterData)->first();

        if (!$poster) {

            //Check if the id of the poster has any relationship with either a cart, saved user or game.
            if (
                Game::where('poster_id', '=', $id)
                || PosterUser::where('poster_id', '=', $id)->where('user_id', '!=', $userId)
                || Cart::hasProductNotUser($id, [$userId, $sessionToken])->get()
            ) {
                $poster = Poster::create($posterData);
            } else {
                //No relationship found to any game, user or cart except for current
                Poster::find($id)->update($posterData);
            }
        }

        //Return poster
        return $poster;
    }

    public function createPng($posterData, $size)
    {
        //Create and return path to png?
        $path = "";

        return $path;
    }
}
