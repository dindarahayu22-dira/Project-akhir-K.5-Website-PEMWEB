<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    public const TAGS = ['Rasa mantap', 'Porsi pas', 'Cepat saji', 'Kemasan rapi', 'Ramah'];

    protected $fillable = [
        'user_id', 'order_id', 'tenant_id', 'menu_id',
        'rating', 'tags', 'comment', 'photo',
        'tenant_response', 'responded_at',
    ];

    protected $casts = [
        'tags' => 'array',
        'responded_at' => 'datetime',
    ];

    public function user(): BelongsTo   { return $this->belongsTo(User::class); }
    public function order(): BelongsTo  { return $this->belongsTo(Order::class); }
    public function tenant(): BelongsTo { return $this->belongsTo(Tenant::class); }
    public function menu(): BelongsTo   { return $this->belongsTo(Menu::class); }
}
