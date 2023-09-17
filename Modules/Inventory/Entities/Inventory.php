<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;

class Inventory extends Model
{
    use HasFactory;

    protected $guard = ['id', 'created_at', 'updated_at'];
    protected $table = 'inventories';
    protected $fillable = [
        'product_id',
        'quantity',
        'total_sale',
    ];

    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InventoryFactory::new();
    }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}