<?php

namespace App\Http\Controllers;


use App\Models\Customer;

class FasterOrderingUsingCompoundIndexes extends Controller
{
    public function index()
    {
        return Customer::orderBy('last_name')
            ->orderBy('first_name')
            ->paginate();
    }
}
