<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

    protected $guard = ['id', 'created_at', 'updated_at'];
    protected $table = 'stores';
    protected $fillable = [
        'name',
        'address',
    ];

    protected static function newFactory()
    {
        return \Modules\Order\Database\factories\StoreFactory::new();
    }
}