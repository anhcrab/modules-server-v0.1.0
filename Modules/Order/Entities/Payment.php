<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $guard = ['id', 'created_at', 'updated_at'];
    protected $table = 'payments';
    protected $fillable = [
        'type',
        'detail',
    ];

    protected static function newFactory()
    {
        return \Modules\Order\Database\factories\PaymentFactory::new();
    }
}