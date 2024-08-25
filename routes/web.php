<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
    
//     // return view('default');
//     // $contents = ->with('foo', 'bar');
//     // return response($contents)->header('cache-control', 'max-age=1, stale-while-revalidate=1, stale-if-error=1');
// });


// Route::middleware('cache.headers:public;max_age=10;etag')->group(function () {
// Route::middleware('cache.headers:public;')->group(function () {
//     Route::get('/', function () {
//         return view('default');
//     });
// });

Route::middleware('page-cache')->get('/', function() {
    return view('default');
});