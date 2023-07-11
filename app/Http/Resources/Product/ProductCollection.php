<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'name' => $this->name,
            'price' => $this->price,
            'discount' => $this->discount,
            'rating' => $this->reviews->count() > 0  
                      ? round($this->reviews->sum('star')/$this->reviews->count(),2)
                      : 'no rating yet',
            'product' =>
            [
                'details' => route('products.show', $this->id),
            ]
            ];
    }
}
