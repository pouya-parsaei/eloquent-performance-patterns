<?php

namespace App\Http\Controllers;

use App\Models\User;

class FilteringAndSortingAnniversaryDates extends Controller
{
    public function index()
    {
        $users = User::query()
            ->whereBirthDayThisWeek()
            ->orderByBirthDay()
            ->orderBy('first_name')
            ->paginate();

        $users->map(function($user){
            $user->birth_date_converted = $user->birth_date->format('m-d');
        });

        return $users;
    }
}
