<?php

namespace Modules\Product\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Inventory\Entities\Inventory;
use Modules\Product\Entities\Attribute;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\Product;
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
        $inventory = Inventory::findOrFail($this->id)->first();
        return [
            'id' => $this->id,
            'type' => Type::findOrFail($this->type_id)->name,
            'name' => $this->name,
            'slug' => $this->slug,
            'summary' => $this->summary,
            'detail' => $this->detail,
            'category' => Category::findOrFail($this->category_id)->name,
            'attributes' => Product::findOrFail($this->id)->first()->with('attributes')->get()->first()->attributes,
            'regular_price' => $this->regular_price,
            'sale_price' => $this->sale_price,
            'quantity' => $inventory->quantity,
            'total_sale' => $inventory->total_sale,
            'tags' => TagsResource::collection($this->whenLoaded('tag')),
            'images' => $this->getMedia('images')->map(function ($media) {
                // $imageParts = explode('localhost', $media->getUrl());
                // $image = $imageParts[0] . 'localhost:3000' . $imageParts[1];
                return $media->getUrl();
            }),
            'date' => $this->created_at,
        ];
    }
}
