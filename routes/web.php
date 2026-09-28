<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\EmpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DynamicPageController;

/*
|--------------------------------------------------------------------------
| Guest routes (login only – employees come from the Oracle EMP table)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/login/employees', [LoginController::class, 'getEmployeesByUnit'])->name('login.employees');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Any logged-in employee
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/home', fn () => redirect()->route('dashboard'));
});

/*
|--------------------------------------------------------------------------
| Administrators only (EMP.ADMIN = 1  or  role "admin")
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::resource('emps', EmpController::class)->except('show');          // CRUD on EMP + assign roles
    Route::resource('roles', RoleController::class)->except('show');        // CRUD on roles (+ their permissions)
    Route::resource('permissions', PermissionController::class)->except('show');
});
Route::get('/{path}', [DynamicPageController::class, 'show'])
    ->where('path', '[A-Za-z0-9\-_]+')
    ->name('dynamic.page');