<?php

namespace App\Http\Resources;

use App\Models\PosterFrame;
use App\Models\PosterSize;
use Illuminate\Http\Resources\Json\JsonResource;

class PosterVariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "size" => $this->poster_size_id,
            "frame" => $this->poster_frame_id,
            "price" => $this->price
        ];
    }
}
