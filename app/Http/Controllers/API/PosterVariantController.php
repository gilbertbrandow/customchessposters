<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PosterFrameResource;
use App\Http\Resources\PosterSizeResource;
use App\Http\Resources\PosterVariantResource;
use App\Models\PosterFrame;
use App\Models\PosterSize;
use App\Models\PosterVariant;
use Illuminate\Http\Request;

class PosterVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'sizes' => PosterSizeResource::collection(PosterSize::all()),
            'frames' => PosterFrameResource::collection(PosterFrame::all()),
            'variants' =>  PosterVariantResource::collection(PosterVariant::all()),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PosterVariant  $posterVariant
     * @return \Illuminate\Http\Response
     */
    public function show(PosterVariant $posterVariant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PosterVariant  $posterVariant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosterVariant $posterVariant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PosterVariant  $posterVariant
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosterVariant $posterVariant)
    {
        //
    }
}
