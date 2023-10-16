<?php

namespace App\Http\Controllers;

use App\Models\PosterFrame;
use App\Models\PosterSize;
use App\Models\PosterVariant;

class PosterVariantController extends Controller
{
    public function index () {

        return [
            'sizes' => PosterSize::select('id', 'name', 'width', 'height')->get(), 
            'frames' => PosterFrame::select('id', 'name', 'color')->get(),
            'variants' => PosterVariant::select('id', 'poster_size_id', 'poster_frame_id', 'price')->get()
        ];
    }
}
