<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::post('/price-window-gold', [ProductController::class, 'goldcoin']);
