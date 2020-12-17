<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeesSalaryController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\JobLocationController;
use App\Http\Controllers\JobShiftController;
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

    Route::middleware('can:edit-admins,user')->prefix('admins')->group(function () {
        Route::get('/{user}/edit', [AdminController::class, 'edit'])->name('admins.edit');
        Route::put('/{user}', [AdminController::class, 'update'])->name('admins.update');
        Route::get('/{user}', [AdminController::class, 'show'])->name('admins.show');
    });

    Route::prefix('moderators')->group(function () {
        Route::middleware('can:manage-moderators')->group(function () {
            Route::get('/create', [ModeratorController::class, 'create'])->name('moderators.create');
            Route::post('/create', [ModeratorController::class, 'store'])->name('moderators.store');

            Route::get('/manage_attendance', [AttendanceController::class, 'manageAttendance'])->name('moderators.manage_attendance');

            Route::delete('/{user}', [ModeratorController::class, 'destroy'])->name('moderators.destroy');
            Route::get('/', [ModeratorController::class, 'index'])->name('moderators.index');
        });

        Route::middleware('can:edit-moderators,user')->group(function () {
            Route::get('/{user}/edit', [ModeratorController::class, 'edit'])->name('moderators.edit');
            Route::put('/{user}', [ModeratorController::class, 'update'])->name('moderators.update');
            Route::get('/{user}', [ModeratorController::class, 'show'])->name('moderators.show');
        });
    });

    Route::resource('job_locations', JobLocationController::class)->middleware('can:manage-job-locations');

    Route::resource('job_shifts', JobShiftController::class)->middleware('can:manage-job-shifts');

    Route::middleware('can:manage-employees')->prefix('employees')->group(function () {
        Route::get('import', [EmployeeController::class, 'showImportExcelForm'])->name('employees.showExcelForm');
        Route::post('import', [EmployeeController::class, 'storeFromExcel'])->name('employees.storeFromExcel');
        Route::get('attendance', [EmployeeController::class, 'attendance'])->name('employees.attendance');
        Route::post('attendance', [EmployeeController::class, 'submitAttendance'])->name('employees.submitAttendance');
    });

    Route::prefix('employees/salary')->middleware('can:manage-employees-salary')->group(function () {
        Route::get('/', [EmployeesSalaryController::class, 'index'])->name('employees.salary.index');
    });

    Route::resource('employees', EmployeeController::class)->middleware('can:manage-employees');
    
});
