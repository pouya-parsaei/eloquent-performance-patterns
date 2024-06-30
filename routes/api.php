<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/optimizing-circular-relationships', [\App\Http\Controllers\OptimizingCircularRelationships::class, 'index']);
Route::get('/setup-multi-column-searching', [\App\Http\Controllers\SettingUpMultiColumnSearching::class, 'index']);
Route::get('/faster-ordering-using-compound-indexes', [\App\Http\Controllers\FasterOrderingUsingCompoundIndexes::class, 'index']);
Route::get('/ordering-by-has-one-relationship', [\App\Http\Controllers\OrderingByHasOneRelationship::class, 'index']);
Route::get('/ordering-by-has-many-relationship', [\App\Http\Controllers\OrderingByHasManyRelationship::class, 'index']);
Route::get('/ordering-by-belongs-to-many-relationship', [\App\Http\Controllers\OrderingByBelongsToManyRelationship::class, 'index']);
Route::get('/ordering-by-nulls-always-last', [\App\Http\Controllers\OrderingByNULLsAlwaysLast::class, 'index']);
Route::get('/ordering-by-nulls-always-last-2', [\App\Http\Controllers\OrderingByNULLsAlwaysLast::class, 'users']);
Route::get('/ordering-by-custom-algorithms', [\App\Http\Controllers\OrderingByCustomAlgorithms::class, 'index']);
Route::get('/filtering-and-sorting-anniversary-dates', [\App\Http\Controllers\FilteringAndSortingAnniversaryDates::class, 'index']);
Route::get('/ordering-data-for-human-using-natural-sort', [\App\Http\Controllers\OrderingDataForHumanUsingNaturalSort::class, 'index']);
Route::get('/full-text-search-with-rankings', [\App\Http\Controllers\FullTextSearchingWithRanking::class, 'index']);
Route::get('/getting-distance-between-geographic-points', [\App\Http\Controllers\GettingDistanceBetweenGeographicPoints::class, 'index']);
Route::get('/getting-distance-between-geographic-points', [\App\Http\Controllers\GettingDistanceBetweenGeographicPoints::class, 'index']);
Route::get('/filtering-by-geographic-distance', [\App\Http\Controllers\FilteringByGeographicDistance::class, 'index']);
Route::get('/ordering-by-geographic-distance', [\App\Http\Controllers\OrderingByGeographicDistance::class, 'index']);
Route::get('/filtering-by-geo-spatial-area', [\App\Http\Controllers\FilteringByGeoSpatialArea::class, 'index']);
Route::get('/filtering-by-geo-spatial-area-2', [\App\Http\Controllers\FilteringByGeoSpatialArea::class, 'findRegionByCustomer']);
