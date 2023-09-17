<?php

namespace Modules\Coupon\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Coupon\Entities\Coupon;
use Throwable;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        try {
            return response()->json(Coupon::all());
        } catch (Throwable $th) {
            return response()->json([
                'Coupons message:' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $newCoupon = Coupon::create($request->all());
            return response()->json($newCoupon->id);
        } catch (Throwable $th) {
            return response()->json([
                'Coupons message: ' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(Request $request, string $code)
    {
        try {
            return response()->json(Coupon::where(['code' => $code])->first());
        } catch (Throwable $th) {
            return response()->json([
                'Coupons message: ' => $th->getMessage(),
            ]);
        }
    }

    public function showById(Request $request, string $id)
    {
        try {
            return response()->json(Coupon::findOrFail($id)->first());
        } catch (Throwable $th) {
            return response()->json([
                'Coupons message: ' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try {
            $coupon = Coupon::findOrFail($id)->first();
            $coupon->code = $request->code;
            $coupon->name = $request->name;
            $coupon->description = $request->description;
            $coupon->max_uses = $request->max_uses;
            $coupon->max_uses_user = $request->max_uses_user;
            $coupon->type = $request->type;
            $coupon->discount_amount = $request->discount_amount;
            $coupon->min_amount = $request->min_amount;
            $coupon->status = $request->status;
            $coupon->starts_at = $request->starts_at;
            $coupon->expires_at = $request->expires_at;
            $coupon->save();
            return response()->json($coupon);
        } catch (Throwable $th) {
            return response()->json([
                'Coupons message: ' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request, string $id)
    {
        try {
            Coupon::findOrFail($id)->first()->delete();
            return response()->json('deleted');
        } catch (Throwable $th) {
            return response()->json([
                'Coupons message: ' => $th->getMessage(),
            ]);
        }
    }
}
