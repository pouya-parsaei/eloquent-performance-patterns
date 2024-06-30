<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Region;

class FilteringByGeoSpatialArea extends Controller
{
    public function index()
    {
        $customers = Customer::query()
            ->inRegion(Region::where('name', 'The Prairies')->first())
            ->get();
        $customers->map(function($customer) {
            return $customer->location = mb_convert_encoding($customer->location, 'UTF-8', 'UTF-8');
        });

        return $customers;
    }

    public function findRegionByCustomer()
    {
        $customer = Customer::inRandomOrder()->first();
        $regions = Region::hasThisCustomer($customer)->get();

        $regions->map(function($region) {
           $region->offsetUnset('geometry');
        });
        return $regions;
    }
}