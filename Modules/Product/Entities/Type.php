<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Database\factories\TypeFactory;

class Type extends Model
{
    use HasFactory;

    protected $guard = ['created_at', 'updated_at'];
    protected $table = 'types';
    protected $fillable = [
        'id',
        'name',
        'slug',
    ];

    protected static function newFactory()
    {
        return TypeFactory::new();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
