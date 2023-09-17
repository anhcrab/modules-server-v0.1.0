<?php

namespace Modules\Product\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Product\Entities\Type;
use Modules\Product\Transformers\TypesResource;

class TypesController extends Controller
{
    /**
     * Display a listing of the types of product are stored in database.
     *
     * @return Response
     */
    public function index()
    {
        try {
            return response()->json(TypesResource::collection(Type::all()));
        } catch (\Throwable $th) {
            return response()->json([
                'Product types message: ' => $th->getMessage(),
            ], $th->getCode());
        }
    }

    /**
     * Store a newly created type product in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $newType = Type::create($request->all());
            $newType->slug = Str::slug($newType->name);
            $newType->save();

            return response()->json($newType);
        } catch (\Throwable $th) {
            return response()->json([
                'Product types message: ' => $th->getMessage(),
            ], 200);
        }
    }

    /**
     * Show the specified type of product.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            return response()->json(new TypesResource(Type::findOrFail($id)->first()));
        } catch (\Throwable $th) {
            return response()->json([
                'Product types message: ' => $th->getMessage(),
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
            $type = Type::findOrFail($id)->first();
            $type->name = $request->name;
            $type->slug = Str::slug($type->name);
            $type->save();

            return response()->json($type);
        } catch (\Throwable $th) {
            return response()->json([
                'Product types message: ' => $th->getMessage(),
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
            $type = Type::findOrFail($id)->first();
            $type->delete();

            return response()->json([
                'Product types message: ' => 'the product types has been deleted.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'Product types message: ' => $th->getMessage(),
            ], $th->getCode());
        }
    }
}
