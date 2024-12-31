<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DutyController;

// Employee Routes
Route::resource('employees', EmployeeController::class);

// Duty Routes
Route::get('/duty-assignments', [DutyController::class, 'getEmployeeAssignments'])->name('duty.assignments');

// Default Home Route
Route::get('/', function () {
    return view('welcome');
});
