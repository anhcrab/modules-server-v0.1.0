<?php

namespace Modules\Product\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Product\Entities\Tag;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            return response()->json(Tag::all());
        } catch (\Throwable $th) {
            return response()->json([
                'Product tags message: ' => $th->getMessage(),
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
            $newTag = Tag::create($request->all());
            $newTag->slug = Str::slug($newTag->name);
            $newTag->save();

            return response()->json($newTag);
        } catch (\Throwable $th) {
            return response()->json([
                'Product tags message: ' => $th->getMessage(),
            ], $th->getCode());
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
            return response()->json(Tag::findOrFail($id)->first());
        } catch (\Throwable $th) {
            return response()->json([
                'Product tags message: ' => $th->getMessage(),
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
            $tag = Tag::findOrFail($id)->first();
            $tag->name = $request->name;
            $tag->slug = Str::slug($request->name);
            $tag->save();

            return response()->json($tag);
        } catch (\Throwable $th) {
            return response()->json([
                'Product tags message: ' => $th->getMessage(),
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
            $tag = Tag::findOrFail($id)->first();
            $tag->delete();

            return response()->json('Product tag has been deleted.');
        } catch (\Throwable $th) {
            return response()->json([
                'Product tags message: ' => $th->getMessage(),
            ], $th->getCode());
        }
    }
}
