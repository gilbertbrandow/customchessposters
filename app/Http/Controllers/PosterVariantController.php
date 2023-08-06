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
            'frames' => PosterFrame::select('id', 'name', 'image')->get(),
            'variants' => PosterVariant::select('poster_size_id', 'poster_frame_id', 'price', 'variant_id')->get()
        ];
    }
}
