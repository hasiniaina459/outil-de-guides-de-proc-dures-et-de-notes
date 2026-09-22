<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ServiceController;
use App\Http\Controllers\individuController;
use App\Http\Controllers\procedureController;
use App\Http\Controllers\noteController;
use App\Http\Controllers\rappelController;
use App\Http\Controllers\NoteTrackingController;
use App\Http\Controllers\DMAdminController;
use App\Http\Controllers\Auth\IndividuAuthController;

Route::middleware('guest:individu')->group(function(){
    Route::get('/login',[IndividuAuthController::class,'showloginform'])->name('login');
    Route::post('/login',[IndividuAuthController::class,'login']);

    Route::get('/register', [individuController::class, 'create'])->name('register');
    Route::post('/register', [individuController::class, 'store'])->name('register.store');
});

Route::get('track/note/{note}/{individu}', [NoteTrackingController::class, 'track'])
    ->name('notes.track')
    ->middleware('signed');

Route::middleware('auth:individu')->group(function(){
    Route::post('/logout',[IndividuAuthController::class,'logout'])->name('logout');

    //route access service
    Route::middleware('admin')->group(function () {
        Route::resource('services', ServiceController::class)
            ->only(['create','store','edit','update','destroy'])
            ->parameters(['services'=>'services']);
    });

    Route::resource('services', ServiceController::class)
        ->only(['index','show'])
        ->parameters(['services' => 'services']);
        
    //historique individus
    Route::get('individus/historique', [individuController::class, 'historique'])
        ->name('individus.historique');
    Route::get('individus/historique/download', [individuController::class, 'historiqueDownload'])
        ->name('individus.historique.download');

    //download liste individu
    Route::get('individus/{individus}/download', [individuController::class, 'download'])
        ->name('individus.download');

    //route access individu
    Route::middleware('admin')->group(function(){
        Route::get('individus/create',[individuController::class,'create'])
            ->name('individus.create');
        Route::get('individus/store',[individuController::class,'store'])
            ->name('individus.store'); 
    });
    Route::resource('individus', individuController::class)
        ->only(['index','show','edit','update','destroy'])
        ->parameters(['individus' => 'individus']);

    
    //historique procedure
    Route::get('procedures/historique', [ProcedureController::class, 'historique'])
        ->name('procedures.historique');
    Route::get('procedures/historique/download', [ProcedureController::class, 'historiqueDownload'])
        ->name('procedures.historique.download');

    //route procedure access
    Route::middleware('admin')->group( function (){
        Route::resource('procedures',procedureController::class)
            ->only(['create','store','edit','update','destroy'])
            ->parameters(['procedures'=>'procedures']);
    });

    Route::resource('procedures', procedureController::class)
        ->only(['index', 'show'])
        ->parameters(['procedures' => 'procedures']);

    //historique notes
    Route::get('notes/historique', [noteController::class, 'historique'])
        ->name('notes.historique');
    Route::get('notes/historique/download', [noteController::class, 'historiqueDownload'])
        ->name('notes.historique.download');

    // route access note
    Route::middleware('admin')->group( function (){
        Route::resource('notes', noteController::class)
            ->only(['create', 'store', 'edit', 'update', 'destroy'])
            ->parameters(['notes' => 'notes']);
            });

    Route::resource('notes',noteController::class)
        ->only(['index','show'])        
        ->parameters(['notes' => 'notes']);

    //historique rappels
    Route::get('rappels/historique', [rappelController::class, 'historique'])
        ->name('rappels.historique');
    Route::get('rappels/historique/download', [rappelController::class, 'historiqueDownload'])
        ->name('rappels.historique.download');

    //route access rappel
    Route::middleware('admin')->group(function(){
        Route::resource('rappels', rappelController::class)
        ->only(['create', 'store', 'edit', 'update', 'destroy'])
        ->parameters(['rappels' => 'rappels']);
    });

    Route::resource('rappels', rappelController::class)
        ->only(['index', 'show'])
        ->parameters(['rappels' => 'rappels']);
    
    //demande admin
    Route::get('/demandes', [DMAdminController::class, 'create'])
        ->name('demandes.create');
    Route::post('/demandes', [DMAdminController::class, 'store'])
        ->name('demandes.store');

    Route::middleware('admin')->group(function(){
        Route::get('/admin/demandes',[DMAdminController::class,'index'])
            ->name('admin.demandes.index');

        Route::post('/admin/demandes/{demande}/approve',[DMAdminController::class,'approve'])
            ->name('admin.demandes.approve');

        Route::post('admin/demandes/{demande}/reject',[DMAdminController::class,'reject'])
            ->name('admin.demandes.reject');
    });
});