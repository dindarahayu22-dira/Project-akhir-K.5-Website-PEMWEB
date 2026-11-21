<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['order_id', 'method', 'status', 'amount', 'expires_at', 'paid_at'];

    protected $casts = ['expires_at' => 'datetime', 'paid_at' => 'datetime'];

    public function order() { return $this->belongsTo(Order::class); }
}
