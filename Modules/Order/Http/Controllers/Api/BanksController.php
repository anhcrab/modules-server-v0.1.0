<?php

namespace Modules\Order\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Order\Entities\Bank;

class BanksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json(Bank::all(), 200);
        } catch (\Throwable $throwable) {
            return response()->json([
                'msg' => $throwable->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $bank = Bank::create([
                'name' => $request->name,
                'number' => $request->number,
            ]);
            return response()->json($bank, 200);
        } catch (\Throwable $throwable) {
            return response()->json([
                'msg' => $throwable->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        try {
            return response()->json(Bank::findOrFail($id), 200);
        } catch (\Throwable $throwable) {
            return response()->json([
                'msg' => $throwable->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $bank = Bank::findOrFail($id);
            $bank->name = $request->name;
            $bank->number = $request->number;
            $bank->save();
            return response()->json([
                'msg' => 'success',
            ], 200);
        } catch (\Throwable $throwable) {
            return response()->json([
                'msg' => $throwable->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            $bank = Bank::findOrFail($id);
            $bank->delete();
            return response()->json([
                'msg' => 'success',
            ], 200);
        } catch (\Throwable $throwable) {
            return response()->json([
                'msg' => $throwable->getMessage(),
            ]);
        }
    }
}
