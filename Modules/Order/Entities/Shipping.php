<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipping extends Model
{
    use HasFactory;

    protected $guard = ['id', 'created_at', 'updated_at'];
    protected $table = 'shippings';
    protected $fillable = [
        'name',
        'price',
    ];

    protected static function newFactory()
    {
        return \Modules\Order\Database\factories\ShippingFactory::new();
    }
}