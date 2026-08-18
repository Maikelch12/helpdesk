<?php

use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('requests.index');
});

Route::resource('requests', RequestController::class)
    ->parameters(['requests' => 'supportRequest']);