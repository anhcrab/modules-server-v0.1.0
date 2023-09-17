<?php

namespace Modules\Cart\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $guard = ['id', 'created_at', 'updated_at'];
    protected $table = 'carts';
    protected $fillable = [
        'device',
    ];

    protected static function newFactory()
    {
        return \Modules\Cart\Database\factories\CartFactory::new();
    }
}