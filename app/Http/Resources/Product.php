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
        $status = $this->status;
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'product_title' => $this->product_title,
            'slug' => $this->slug,
            'product_image' => $this->product_image != null? asset('site/uploads/product/'.$this->product_image) : null,
            'product_description' => $this->product_description,
            'product_cost' => $this->product_cost,
            'status' => $status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
