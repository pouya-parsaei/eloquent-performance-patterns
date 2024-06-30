<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Device;

class OrderingDataForHumanUsingNaturalSort extends Controller
{
    public function index()
    {
//        $devices = ['iphone 11','iphone 3'];
//        sort($devices,SORT_NATURAL);
//        return $devices;

        return Device::orderByRaw('naturalsort(name)')->get();
    }
}