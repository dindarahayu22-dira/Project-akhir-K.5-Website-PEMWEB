<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_number', 'user_id', 'tenant_id', 'total', 'status', 'pickup_time', 'pickup_code', 'note'];

    public function user()    { return $this->belongsTo(User::class); }
    public function tenant()  { return $this->belongsTo(Tenant::class); }
    public function items()   { return $this->hasMany(OrderItem::class); }
    public function payment() { return $this->hasOne(Payment::class); }
    public function review()  { return $this->hasOne(Review::class); }
}
