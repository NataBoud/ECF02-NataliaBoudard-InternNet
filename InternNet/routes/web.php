<?php

use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::name('opportunities.')
    ->prefix("opportunities")
    ->controller(OpportunityController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/opportunity/{opportunity}', 'show')->name('show');
        Route::get('/opportunity/{id}/edit', 'edit')->name('edit');
        Route::put('/opportunity/{id}', 'update')->name('update');
        Route::delete('/opportunity/{id}', 'destroy')->name('destroy');

    });

Route::get('/', function () {
    return redirect()->route('opportunities.index');
})->name('welcome');


require __DIR__.'/auth.php';
