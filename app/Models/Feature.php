<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Feature extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function scopeOrderByStatus($query, $direction): void
    {
        $query->orderBy(DB::raw('
            case
                when status = "pending" then 1
                when status = "approved" then 2
                when status = "rejected" then 3
            end
        '), $direction);
    }

    public function scopeOrderByActivity($query, $direction): void
    {
        $query->orderBy(
            DB::raw('(votes_count + (comments_count * 2))'),
            $direction
        );
    }
}
