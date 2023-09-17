<?php

namespace Modules\Order\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Inventory\Entities\Inventory;
use Modules\Order\Entities\Order;
use Modules\Order\Transformers\OrderResource;
use Throwable;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json(Order::all());
        } catch (Throwable $th) {
            return \response()->json([
                'Order message: ' => $th->getMessage(),
            ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $order = Order::create([
                'products' => json_encode($request->products),
                'total_price' => $request->total_price,
                'device_id' => $request->device_id,
                'address' => $request->address,
                'fullname' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'shipping_id' => $request->shipping_id,
                'payment_id' => $request->payment_id,
                'status' => $request->status == null ? 'accepted' : $request->status,
            ]);

            if ($request->user_id) {
                $order->user_id = $request->user_id;
                $order->save();
            }

            foreach ($request->products as $client_product) {
                $inventory = Inventory::where(['product_id' => $client_product['product_id']])->first();
                $inventory->quantity = $inventory->quantity - $client_product['quantity'];
                $inventory->total_sale = $inventory->total_sale + $client_product['quantity'];
                $inventory->save();
            }

            return response()->json($order->id);
        } catch (Throwable $err) {
            return response()->json([
                'Order message: ' => $err->getMessage(),
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return new OrderResource(Order::findOrFail($id));
        } catch (Throwable $th) {
            return \response()->json([
                'msg' => $th->getMessage(),
            ]);
        }

    }

    public function showByUuid(Request $request, string $uuid)
    {
        try {
            return response()->json(Order::where('device_id', $uuid)->get());
        } catch (Throwable $th) {
            return response()->json([
                'msg' => $th->getMessage(),
            ]);
        }
    }

    public function cancelById(Request $request, string $id)
    {
        try {
            $order = Order::findOrFail($id);
            $rawProducts = json_decode($order->products);
            foreach ($rawProducts as $rawProduct) {
                $inventory = Inventory::where(['product_id' => $rawProduct->product_id])->first();
                $inventory->quantity = $inventory->quantity + $rawProduct->quantity;
                $inventory->total_sale = $inventory->total_sale - $rawProduct->quantity;
                $inventory->save();
            }
            $order->status = 'cancel';
            $order->save();
            return response()->json('Order message: cancel', 200);
        } catch (Throwable $th) {
            return response()->json([
                'Orders message: ' => $th->getMessage(),
            ]);
        }

    }

    public function updateStatus(Request $request, string $id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->status = $request->status;
            $order->save();
            return response()->json($order, 200);
        } catch (Throwable $th) {
            return response()->json([
                'msg' => $th->getMessage(),
            ]);
        }
    }
}
