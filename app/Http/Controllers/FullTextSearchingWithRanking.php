<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class FullTextSearchingWithRanking
{
    public function index()
    {
        return Post::query()
            ->when(request('q'), function ($query, $search) {
                $query
                    ->selectRaw('*, match(title, body) against (? in boolean mode) as score', [$search])
                    ->whereFullText(['title', 'body'], $search, ['mode' => 'boolean']);
            }, function ($query) {
                $query->latest();
            })
            ->paginate();
    }
}