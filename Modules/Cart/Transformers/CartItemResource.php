<?php

namespace Modules\Cart\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Product\Entities\Product;

class CartItemResource extends JsonResource
{

    public function toArray(Request $request)
    {
        $product = Product::find($this->product_id);

        return [
            'product_id' => $this->product_id,
            'price' => $product->sale_price ?: $product->regular_price,
            'name' => $product->name,
            'quantity' => $this->quantity,
            'images' => $product->getMedia('images')->map(function ($media) {
                //                $imageParts = explode('localhost', $media->getUrl());
//                $image = $imageParts[0].'localhost:3000'.$imageParts[1];
//                return $image;
                return $media->getUrl();
            }),
        ];
    }
}
