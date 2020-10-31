<?php

use App\Http\Controllers\ModeratorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('index');
    })->name('index');

    Route::middleware('can:manage-moderators')->prefix('moderators')->group(function () {
        Route::get('/', [ModeratorController::class, 'index'])->name('moderators.index');
        Route::get('/create', [ModeratorController::class, 'create'])->name('moderators.create');
        Route::post('/create', [ModeratorController::class, 'store'])->name('moderators.store');
        Route::get('/{user}/edit', [ModeratorController::class, 'edit'])->name('moderators.edit');
        Route::put('/{user}', [ModeratorController::class, 'update'])->name('moderators.update');
        Route::delete('/{user}', [ModeratorController::class, 'destroy'])->name('moderators.destroy');
    });

});
