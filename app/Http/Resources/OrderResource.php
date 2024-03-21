<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'status' => ucfirst($this->status),
            'items' => OrderItemResource::collection($this->orderItems),
            'shipping' => new ShippingMethodResource($this->shipping),
            'created' => $this->created_at, 
            'last_updated' => $this->updated_at,
            'total' => $this->total,
        ];
    }
}
