<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use function collect;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'date',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function features(): HasMany
    {
        return $this->hasMany(Feature::class);
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'checkouts')
            ->using(Checkout::class)
            ->withPivot('borrowed_date');
    }

    public function scopeSearch(Builder $query, string $terms = null)
    {
        collect(str_getcsv($terms, ' ', '"'))->filter()->each(function ($term) use ($query) {
            $term = preg_replace('/[^A-Za-z0-9]/', '', $term) . '%';
            $query->whereIn('id', function ($query) use ($term) {
                $query->select('id')
                    ->from(function ($query) use ($term) {
                        $query->select('id')
                            ->from('users')
                            ->where('first_name_normalized', 'like', $term)
                            ->orWhere('last_name_normalized', 'like', $term)
                            ->union(
                                $query
                                    ->newQuery()
                                    ->select('users.id')
                                    ->from('users')
                                    ->join('companies', 'companies.id', '=', 'users.company_id')
                                    ->where('companies.name_normalized', 'like', $term)
                            );
                    });
            });
        });
    }

    public function scopeOrderByBirthDay($query)
    {
        $query->orderByRaw('date_format(birth_date,"%m-%d")');
    }

    public function scopeWhereBirthDayThisWeek($query)
    {
        Carbon::setTestNow(Carbon::parse('January 1,2020'));

        $dates = Carbon::now()->startOfWeek()
            ->daysUntil(Carbon::now()->endOfWeek())
            ->map(fn($date) => $date->format('m-d'));

        $query->whereRaw('date_format(birth_date,"%m-%d") in (?,?,?,?,?,?,?)', iterator_to_array($dates));
    }
}
