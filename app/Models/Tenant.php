<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    protected $fillable = ['user_id','name','description','location','stand','distance','opens_at','closes_at','status','rating','photo'];
    protected $casts = ['rating' => 'decimal:1'];
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function menus(): HasMany { return $this->hasMany(Menu::class); }
    public function orders(): HasMany { return $this->hasMany(Order::class); }
    public function isOpen(): bool { return $this->status === 'open'; }
}
