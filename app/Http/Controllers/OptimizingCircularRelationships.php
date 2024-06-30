<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeatureResource;
use App\Models\Comment;
use App\Models\Feature;
use Illuminate\Http\Request;

class OptimizingCircularRelationships extends Controller
{
    public function index()
    {
        $feature = Feature::first()->load('comments.user');
        $feature->comments->each->setRelation('feature',$feature);
        return FeatureResource::make($feature);
    }
}
