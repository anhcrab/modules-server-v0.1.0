<?php

namespace Modules\Product\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Attribute;

class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            return response()->json(Attribute::all());
        } catch (\Throwable $th) {
            return response()->json([
                'Product attributes message: ' => $th->getMessage(),
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
            $newAttribute = Attribute::create($request->all());

            return response()->json($newAttribute);
        } catch (\Throwable $th) {
            return response()->json([
                'Product attributes message: ' => $th->getMessage(),
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
            return response()->json(Attribute::findOrFail($id)->first());
        } catch (\Throwable $th) {
            return response()->json([
                'Product attributes message: ' => $th->getMessage(),
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
            $attribute = Attribute::findOrFail($id);
            $attribute->type = $request->type;
            $attribute->name = $request->name;
            $attribute->code = $request->code;
            $attribute->save();

            return response()->json($attribute);
        } catch (\Throwable $th) {
            return response()->json([
                'Product attributes message: ' => $th->getMessage(),
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
            Attribute::findOrFail($id)->first()->delete();

            return response()->json('Product attribute has been deleted');
        } catch (\Throwable $th) {
            return response()->json([
                'Product attributes message: ' => $th->getMessage(),
            ], $th->getCode());
        }
    }
}
