<?php

namespace Modules\Cart\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    protected $guard = ['id', 'created_at', 'updated_at'];
    protected $table = 'cart_items';
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    protected static function newFactory()
    {
        return \Modules\Cart\Database\factories\CartItemFactory::new();
    }
}