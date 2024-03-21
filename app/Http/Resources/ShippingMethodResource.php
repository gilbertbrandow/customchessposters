<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShippingMethodResource extends JsonResource
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
            'name' => $this->name,
            'cost' => $this->cost,
            'estimated_delivery' => $this->when(
                match ($this->selectedForOrder->status) {
                    'pending' => false,
                    'recieved' => true,
                    'fulfilling' => true,
                    'shipped' => true,
                    'confirmed' => false, 
                    'declined' => false, 
                },
                substr($this->desc, strpos($this->desc, ':') + 2, -2)
            ),
            'desc' => rtrim(strtok($this->desc, '(')),
        ];
    }
}
