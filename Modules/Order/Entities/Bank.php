<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends Model
{
    use HasFactory;

    protected $guard = ['id', 'created_at', 'updated_at'];
    protected $table = 'banks';
    protected $fillable = [
        'name',
        'number',
    ];

    protected static function newFactory()
    {
        return \Modules\Order\Database\factories\BankFactory::new();
    }
}