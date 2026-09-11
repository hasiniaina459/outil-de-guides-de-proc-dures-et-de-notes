<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ServiceController;
use App\Http\Controllers\individuController;
use App\Http\Controllers\procedureController;
use App\Http\Controllers\noteController;
use App\Http\Controllers\rappelController;
use App\Http\Controllers\noteTrackingController;
use App\Http\Controllers\Auth\IndividuAuthController;
/*
use App\Http\Controllers\NoteTrackingController;

Route::get('/track/note/{note}/{individu}', [NoteTrackingController::class, 'track'])
    ->name('notes.track')
    ->middleware('signed');
*/

Route::middleware('guest:individu')->group(function(){
    Route::get('/login',[IndividuAuthController::class,'showloginform'])->name('login');
    Route::post('/login',[IndividuAuthController::class,'login']);

    Route::get('/register', [individuController::class, 'create'])->name('register');
    Route::post('/register', [individuController::class, 'store'])->name('register.store');
});
Route::get('track/note/{note}/{individu}', [noteTrackingController::class, 'track'])
    ->name('notes.track')
    ->middleware('signed');
Route::middleware('auth:individu')->group(function(){
    Route::post('/logout',[IndividuAuthController::class,'logout'])->name('logout');
        
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

    route::get('individus/{individus}/download',[individuController::class,'download'])
        ->name('individus.download');
});