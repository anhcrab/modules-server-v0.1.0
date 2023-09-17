<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $guard = ['id', 'created_at', 'updated_at'];
    protected $table = 'reviews';
    protected $fillable = [
        'user_id',
        'product_id',
        'comment',
        'star',
    ];

    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ReviewFactory::new();
    }
}