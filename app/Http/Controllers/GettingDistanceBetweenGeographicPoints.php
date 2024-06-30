<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Store;

class GettingDistanceBetweenGeographicPoints extends Controller
{
    public function index()
    {
        $coordinates = [-79.47, 43.14];
        return Store::query()
            ->selectDistanceTo($coordinates)
            ->paginate();
    }
}