<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    protected $fillable = ['tenant_id','category_id','name','description','price','stock','status','image'];
    protected $casts = ['price' => 'integer', 'stock' => 'integer'];
    public function tenant(): BelongsTo { return $this->belongsTo(Tenant::class); }
    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function isOrderable(): bool { return $this->status === 'available' && $this->stock > 0 && $this->tenant?->status === 'open'; }
}
