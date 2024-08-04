<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::middleware(['api.errors'])->group(function () {
    Route::get('/', [PetController::class, 'index']);
    Route::resource('pets', PetController::class);
});



