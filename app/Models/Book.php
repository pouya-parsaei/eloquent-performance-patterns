<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    use HasFactory;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'checkouts')
            ->using(Checkout::class)
            ->withPivot('borrowed_date');
    }

    public function lastCheckout(): BelongsTo
    {
        return $this->belongsTo(Checkout::class);
    }

    public function scopeWithLastCheckout($query): void
    {
        $query->addSelect(['last_checkout_id' => Checkout::select('id')
            ->whereColumn('book_id', 'books.id')
            ->latest('borrowed_date')
            ->take(1)
        ])->with('lastCheckout');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
