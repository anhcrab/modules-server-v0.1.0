<?php

namespace Modules\Product\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Product\Entities\Attribute;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\Type;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => Type::findOrFail($this->type_id)->name,
            'name' => $this->name,
            'slug' => $this->slug,
            'summary' => $this->summary,
            'detail' => $this->detail,
            'category' => Category::findOrFail($this->category_id)->name,
            'attributes' => AttributesResource::collection(Attribute::where('product_id', $this->id)->get()),
            'regular_price' => $this->regular_price,
            'sale_price' => $this->sale_price,
            'quantity' => $this->stock_quantity,
            'total_sale' => $this->total_sale,
            'tags' => TagsResource::collection($this->whenLoaded('tag')),
            'images' => $this->getMedia('images')->map(function ($media) {
                $imageParts = explode('localhost', $media->getUrl());
                $image = $imageParts[0].'localhost:3000'.$imageParts[1];

                return $image;
            }),
            'date' => $this->created_at,
        ];
    }
}
