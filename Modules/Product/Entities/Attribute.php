<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Database\factories\AttributeFactory;

class Attribute extends Model
{
    use HasFactory;

    protected $guard = ['id', 'created_at', 'updated_at'];
    protected $table = 'attributes';
    protected $fillable = [
        'id',
        'type',
        'name',
        'code',
    ];

    protected static function newFactory()
    {
        return AttributeFactory::new();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attribute', 'attribute_id', 'product_id');
    }
}
