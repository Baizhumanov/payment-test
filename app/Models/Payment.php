<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'merchant_id',
        'payment_id',
        'status',
        'amount',
        'amount_paid',
        'signature',
    ];

    public function scopeMerchant(Builder $query, string $id): void
    {
        $query->where('merchant_id', $id);
    }

    public function scopePayment(Builder $query, string $id): void
    {
        $query->where('payment_id', $id);
    }
}
