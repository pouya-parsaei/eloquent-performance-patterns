<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;

class OrderingByNULLsAlwaysLast extends Controller
{
    public function index()
    {
        return Book::with('user')
            ->orderByRaw('user_id is null')
            ->orderBy('name')
            ->paginate();
    }

    public function users()
    {
        return User::when(request('sort') === 'town', function ($query) {
            $query->orderByNullsLast('town', request('direction'));
        })
            ->orderBy('first_name')
            ->paginate();
    }
}
