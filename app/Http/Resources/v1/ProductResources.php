<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'product_name' => $this->product_name,
            'product_desc' => $this->product_desc,
            'product_image' => $this->product_image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
