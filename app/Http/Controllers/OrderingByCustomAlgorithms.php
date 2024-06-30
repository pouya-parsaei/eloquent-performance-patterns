<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Support\Facades\DB;

class OrderingByCustomAlgorithms extends Controller
{
    public function index()
    {
        $features = Feature::query()
            ->withCount('comments', 'votes')
            ->when(request('sort'), function ($query, $sort) {
                switch ($sort) {
                    case 'title':
                        return $query->orderBy('title', request('direction'));
                    case 'status':
                        return $query->orderByStatus(request('direction'));
                    case 'activity':
                        return $query->orderByActivity(request('direction'));
                }
            })
            ->latest()
            ->paginate();

        $features->map(function ($feature) {
            $feature->activity = $feature->votes_count + ($feature->comments_count * 2);
        });

        return $features;
    }
}
