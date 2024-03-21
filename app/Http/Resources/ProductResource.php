<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'type' => $this->type,
            'frame' =>  new PosterFrameResource($this->variant->posterFrame),
            'width' => $this->variant->posterSize->width,
            'height' => $this->variant->posterSize->height,
            'price' => $this->price,
            'poster' => new PosterResource($this->poster),
        ];
    }
}
