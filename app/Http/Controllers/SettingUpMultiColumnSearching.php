<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SettingUpMultiColumnSearching extends Controller
{
    public function index(Request $request)
    {
        return User::search($request->q)
            ->with('company')
            ->paginate($request->page_size);
    }
}
