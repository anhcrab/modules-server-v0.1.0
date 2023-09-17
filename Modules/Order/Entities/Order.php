<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $guard = ['id', 'created_at', 'updated_at'];
    protected $table = 'orders';
    protected $fillable = [
        'id',
        'device_id',
        'total_price',
        'user_id',
        'fullname',
        'email',
        'phone',
        'address',
        'products',
        'shipping_id',
        'payment_id',
        'status',
    ];

    protected static function newFactory()
    {
        return \Modules\Order\Database\factories\OrderFactory::new();
    }
}
