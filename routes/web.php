<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InformacijasPanelisController;

Route::get('/', function () {
    return view('welcome');
});
