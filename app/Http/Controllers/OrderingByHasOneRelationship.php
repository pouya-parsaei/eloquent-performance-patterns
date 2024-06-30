<?php

namespace App\Http\Controllers;

use App\Models\User;

class OrderingByHasOneRelationship extends Controller
{
    public function index()
    {
        return User::select(['users.*','companies.name'])
            ->join('companies', 'users.company_id', '=', 'companies.id')
            ->orderBy('companies.name','desc')
            ->paginate();

//        return User::orderBy(
//            Profile::select('title')
//                ->whereColumn('user_id','=', 'users.id')
//                ->orderBy('title', 'desc')
//                ->take(1)
//        )
//            ->with('profile')
//            ->paginate();
    }
}
