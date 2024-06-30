<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    public function scopeSelectDistanceTo($query, array $coordinates)
    {
        if (is_null($query->getQuery()->columns)) {
            $query->select('*');
        }

        $query->selectRaw('ST_Distance(
        location,
        ST_SRID(Point(?, ?), 4326)
        ) as distance', $coordinates)->selectRaw('ST_X(location) as latitude, ST_Y(location) as longitude');
    }

    public function scopeWithinDistanceTo($query, array $coordinates, int $distance)
    {
        $query->whereRaw('ST_Distance(
        location,
        ST_SRID(Point(?,?), 4326)
        ) <=?', [...$coordinates, $distance]);
    }

    public function scopeOrderByDistanceTo($query, array $coordinates, string $direction = 'asc')
    {
        $direction = strtolower($direction) === 'asc' ? 'asc' : 'desc';

        $query->orderByRaw('ST_Distance(
        location,
        ST_SRID(Point(?,?), 4326)
        ) ' . $direction, $coordinates);
    }
}
