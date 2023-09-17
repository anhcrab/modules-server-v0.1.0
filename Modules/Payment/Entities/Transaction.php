<?php

namespace Modules\Payment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $guard = ['id', 'created_at', 'updated_at'];
    protected $table = 'transactions';
    protected $fillable = [
        'uuid',
        'user_id',
        'order_id',
        'intent',
        'payer_id',
        'name',
        'country_code',
        'email',
        'purchase_units',
        'status',
    ];

    protected static function newFactory()
    {
        return \Modules\Payment\Database\factories\TransactionFactory::new();
    }
}