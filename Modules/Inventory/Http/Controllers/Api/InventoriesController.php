<?php

namespace Modules\Inventory\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Inventory\Entities\Inventory;
use Throwable;

class InventoriesController extends Controller
{
    public function index()
    {
        try {
            return response()->json(Inventory::all());
        } catch (Throwable $th) {
            return response()->json([
                'Invetories message: ' => $th->getMessage(),
            ]);
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $inventory = Inventory::where(['product_id' => $id])->first();
            $inventory->quantity = $request->quantity;
            $inventory->save();
        } catch (Throwable $th) {
            return response()->json([
                'Inventories: ' => $th->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        //
    }
}
