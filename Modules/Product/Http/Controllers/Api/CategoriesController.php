<?php

namespace Modules\Product\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Product\Entities\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            return response()->json(Category::all());
        } catch (\Throwable $th) {
            return response()->json([
                'Product categories message: ' => $th->getMessage(),
            ], $th->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            // $newCategory = Category::create($request->all());
            // $newCategory->slug = Str::slug($request->name);
            // $newCategory->save();
            $newCategory = Category::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);
            return response()->json($newCategory);
        } catch (\Throwable $th) {
            return response()->json([
                'Product categories message: ' => $th->getMessage(),
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
            return response()->json(Category::findOrFail($id)->first());
        } catch (\Throwable $th) {
            return response()->json([
                'Product categories message: ' => $th->getMessage(),
            ], $th->getCode());
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
            $category = Category::findOrFail($id)->first();
            $category->name = $request->name;
            $category->category_id = $request->category_id;
            $category->slug = Str::slug($category->name);

            return response()->json($category);
        } catch (\Throwable $th) {
            return response()->json([
                'Product categories message: ' => $th->getMessage(),
            ], $th->getCode());
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
            Category::findOrFail($id)->first()->delete();

            return response()->json('Product category has been deleted');
        } catch (\Throwable $th) {
            return response()->json([
                'Product categories message: ' => $th->getMessage(),
            ], $th->getCode());
        }
    }
}
