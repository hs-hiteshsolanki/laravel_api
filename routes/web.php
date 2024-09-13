<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ItemController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
