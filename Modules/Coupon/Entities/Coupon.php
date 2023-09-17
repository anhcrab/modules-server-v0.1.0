<?php

namespace Modules\Coupon\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $guard = ['id', 'created_at', 'updated_at'];
    protected $table = 'coupons';
    protected $fillable = [
        'id',
        'code',
        'name',
        'description',
        'max_uses',
        'max_uses_user',
        'type',
        'discount_amount',
        'min_amount',
        'status',
        'starts_at',
        'expires_at',
    ];

    protected static function newFactory()
    {
        return \Modules\Coupon\Database\factories\CouponFactory::new();
    }
}
