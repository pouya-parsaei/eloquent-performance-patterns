<?php

namespace App\Models;

use Database\Factories\CheckoutFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Checkout extends Pivot
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = true;

    protected $table = 'checkouts';

    protected $casts = [
        'borrowed_date' => 'date'
    ];

    protected static function newFactory(): Factory
    {
        return CheckoutFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
