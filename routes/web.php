<?php

use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

Route::controller(MoviesController::class)->group(function (){
    Route::get('/','index')->name('movies.index');
    Route::get('/movies/{movie}','show')->name('movies.show');
});
