<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Store;

class OrderingByGeographicDistance extends Controller
{
    public function index()
    {
        $coordinates = [-79.47, 43.14];

        $stores = Store::query()
            ->selectDistanceTo($coordinates)
            ->withinDistanceTo($coordinates, 1000000)
            ->orderByDistanceTo($coordinates,'desc')
            ->paginate();

        $stores->map(function ($store) {
            $store->distance = number_format($store->distance / 1000, 2);
            $store->location = mb_convert_encoding($store->location, 'ISO-8859-1', 'UTF-8');
        });

        return $stores;
    }
}