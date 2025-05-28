<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\movieController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/movies", [MovieController::class, "index"]);
Route::get("/movies/{id}", [MovieController::class, "show"]);




