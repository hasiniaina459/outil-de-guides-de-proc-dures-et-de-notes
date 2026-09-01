<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ServiceController;
use App\Http\Controllers\individuController;
use App\Http\Controllers\procedureController;
use App\Http\Controllers\noteController;
use App\Http\Controllers\rappelController;

Route::resource('services', ServiceController::class)
    ->parameters(['services' => 'services']);

Route::resource('individus', individuController::class)
    ->parameters(['individus' => 'individus']);

Route::resource('procedures', procedureController::class)
    ->parameters(['procedures' => 'procedures']);

Route::resource('notes', noteController::class)
    ->parameters(['notes' => 'notes']);
    
Route::resource('rappels', rappelController::class)
    ->parameters(['rappels' => 'rappels']);

