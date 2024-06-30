<?php

namespace App\Http\Controllers;

use App\Models\User;

class OrderingByHasManyRelationship extends Controller
{
    public function index()
    {
        return User::select('users.*')
            ->join('features', 'features.user_id', '=', 'users.id')
            ->orderByDesc('features.created_at')
            ->with('features')
            ->paginate();

//        return User::orderBy(
//            Feature::select('created_at')
//                ->whereColumn('user_id', 'users.id')
//                ->latest()
//                ->take(1)
//        )
//            ->with('features')
//            ->paginate();
    }
}
