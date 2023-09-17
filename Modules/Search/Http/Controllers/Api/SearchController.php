<?php

namespace Modules\Search\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Product\Transformers\ProductsResource;
use Throwable;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            $keyword = $request->search_keyword;
            $queryBuilder = Product::query();
            $queryBuilder->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('slug', 'like', '%' . $keyword . '%');
            })->orWhereHas('categories', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('slug', 'like', '%' . $keyword . '%');
            })->orWhereHas('types', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('slug', 'like', '%' . $keyword . '%');
            })->orWhereHas('attributes', function ($query) use ($keyword) {
                $query->where('type', 'like', '%' . $keyword . '%')
                    ->orWhere('name', 'like', '%' . $keyword . '%')
                    ->orWhere('code', 'like', '%' . $keyword . '%');
            })->orWhereHas('tags', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('slug', 'like', '%' . $keyword . '%');
            });
            return response()->json(ProductsResource::collection($queryBuilder->get()));
        } catch (Throwable $th) {
            return response()->json([
                'msg' => $th->getMessage(),
            ], 200);
        }
    }
}
