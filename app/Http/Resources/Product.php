<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'category_id' => $this->category_id,
            'product_title' => $this->product_title,
            'slug' => $this->slug,
            'product_image' => $this->product_image,
            'product_description' => $this->product_description,
            'product_cost' => $this->product_cost,
            'status' => (string) ($this->status == "Y")?"Y":"N",
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
