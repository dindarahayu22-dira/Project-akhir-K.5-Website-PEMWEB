<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'tenant_id'];

    public function tenant() { return $this->belongsTo(Tenant::class); }
    public function items()  { return $this->hasMany(CartItem::class); }

    public function total(): int
    {
        return $this->items->sum(fn ($i) => $i->menu->price * $i->quantity);
    }
}
