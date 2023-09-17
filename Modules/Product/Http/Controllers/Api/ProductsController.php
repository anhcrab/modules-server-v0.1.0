<?php

namespace Modules\Product\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Inventory\Entities\Inventory;
use Modules\Product\Entities\Attribute;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Type;
use Modules\Product\Transformers\ProductsResource;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            return response()->json(ProductsResource::collection(Product::all()));
        } catch (\Throwable $th) {
            return \response()->json([
                'Products message: ' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate

        // Store the information in the database
        try {
            $newProduct = Product::create([
                'type_id' => Type::firstOrCreate(['name' => $request->type])->id,
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'summary' => $request->summary,
                'detail' => $request->detail,
                'category_id' => $request->category,
                'regular_price' => $request->regular_price,
                'sale_price' => $request->sale_price,
                'total_sale' => $request->total_sale,
            ]);
            Inventory::create([
                'product_id' => $newProduct->id,
                'quantity' => $request->stock_quantity,
            ]);
            $newAttribute = Attribute::where(['attribute_name' => $request->attribute_name])->firstOrCreate([
                'type' => $request->attribute_type ? $request->attribute_type : '',
                'name' => $request->attribute_name ? $request->attribute_name : '',
                'code' => $request->attribute_code ? $request->attribute_code : '',
            ]);

            $newProduct->attributes()->attach($newAttribute->id);

            // Store the image
            if ($request->hasFile('images')) {
                //                $imagePath = $request->file('images')->store('images');
                $newProduct->addMediaFromRequest('images')->toMediaCollection('images');
            }

            return response()->json([
                'message' => 'Created',
            ], 200);
        } catch (\Throwable $th) {
            return \response()->json([
                'Products message: ' => $th->getMessage(),
            ], 200);
        }
    }

    /**
     * Show the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            $cat_id = $product->category_id;
            $relatedProducts = ProductsResource::collection(Product::where('category_id', '=', $cat_id)
                ->where('slug', '!=', $product->slug)
                ->inRandomOrder()->take(10)->get());
            $nonRelatedProducts = ProductsResource::collection(Product::where('category_id', '!=', $cat_id)->take(10)->get());

            return response()->json([
                'product' => new ProductsResource($product),
                'related_products' => $relatedProducts,
                'non_related_products' => $nonRelatedProducts,
            ]);
        } catch (\Throwable $th) {
            return \response()->json([
                'Products message: ' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     */
    public function showBySlug(string $slug)
    {
        try {
            return $this->show(Product::where('slug', $slug)->first()->id);
        } catch (\Throwable $th) {
            return \response()->json([
                'Product message: ' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::where('id', $id)->first();
            $product->type_id = Type::where('name', $request->type)->first()->id;
            $product->name = $request->name;
            $product->slug = $request->slug || Str::slug($product->name);
            $product->summary = $request->summary;
            $product->detail = $request->detail;
            $product->category_id = Category::where('name', $request->category)->first()->id;
            $product->regular_price = $request->regular_price;
            $product->sale_price = $request->sale_price;
            $product->total_sale = $request->total_sale;
            Inventory::findOrFail($product->id)->first()->quantity = $request->stock_quantity;
            Attribute::firstOrCreate([
                'type' => $request->attribute_type,
                'name' => $request->attribute_name,
                'code' => $request->attribute_code,
            ]);
            // Store the image
            if ($request->hasFile('images')) {
                $product = Product::where('id', $id)->first();
                $product->media()->delete();
                $product->addMediaFromRequest('images')->toMediaCollection('images');
            }
            $product->save();

            return response()->json([
                'message' => 'Updated type of products successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return \response()->json([
                'msg' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            Product::findOrFail($id)->delete();

            return response()->json('Product has been deleted');
        } catch (\Throwable $th) {
            return \response()->json([
                'Products message: ' => $th->getMessage(),
            ], $th->getCode());
        }
    }

    /**
     * Store product images.
     *
     * @return Response
     */
    public function storeImages(Request $request)
    {
        try {
            $id = $request->product_id;
            if ($request->hasFile('images')) {
                $product = Product::where('id', $id)->first();
                $product->media()->delete();
                $product->addMediaFromRequest('images')->toMediaCollection('images');
            }
            return response()->json('success.');
        } catch (\Throwable $th) {
            return \response()->json([
                'Product images message: ' => $th->getMessage(),
            ], $th->getCode());
        }
    }
}
