<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;

Route::get('/quote/daily', [QuoteController::class, 'daily']);
