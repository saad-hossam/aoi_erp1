<?php

use Illuminate\Support\Facades\Route;

/* ---- Auth ---- */
use App\Http\Controllers\Auth\LoginController;

/* ---- Dashboard ---- */
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard\AdminController;

/* ---- Admin CRUD ---- */
use App\Http\Controllers\EmpController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
/* ---- Tree / Pages ---- */
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TreeNodeController;
use App\Http\Controllers\Admin\TreePageMappingController;

/* ---- Dynamic front pages ---- */
use App\Http\Controllers\DynamicPageController;

/* ---- Middleware ---- */
use App\Http\Middleware\AuthAdmin;


/*
|--------------------------------------------------------------------------
| Guest routes (login only – employees come from the Oracle EMP table)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/login/employees', [LoginController::class, 'getEmployeesByUnit'])
        ->name('login.employees');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Any logged-in employee
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/',      [HomeController::class, 'index'])->name('dashboard');
    Route::get('/home',  fn () => redirect()->route('dashboard'));
});


/*
|--------------------------------------------------------------------------
| Administrators only
|   Middleware: auth + AuthAdmin
|   (AuthAdmin checks EMP.ADMIN = 1 OR role "admin")
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /* Dashboard */
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    /* Employees (Oracle EMP) + role assignment */
    Route::resource('emps', EmpController::class)->except('show');

    /* Roles + Permissions */
    Route::resource('roles', RoleController::class)->except('show');
    Route::resource('permissions', PermissionController::class)->except('show');
Route::delete('permissions/bulk-delete', [PermissionController::class, 'bulkDelete'])
    ->name('permissions.bulkDelete');
    /* Role → permissions editor */
    Route::get ('roles/{role}/permissions', [RoleController::class, 'edit'])
        ->name('roles.permissions.edit');
    Route::post('roles/{role}/permissions', [RoleController::class, 'update'])
        ->name('roles.permissions.update');
        Route::delete('roles/bulk-delete', [RoleController::class, 'bulkDelete'])->name('roles.bulkDelete');

    /* Employees (local users table) – kept from File 2 for compatibility */
    Route::resource('users', UserController::class);
    Route::get ('users/{user}/roles', [UserController::class, 'edit'])
        ->name('users.roles.edit');
    Route::post('users/{user}/roles', [UserController::class, 'update'])
        ->name('users.roles.update');

    /* Tree / Pages */
    Route::resource('tree-nodes', TreeNodeController::class)
        ->names('admin.tree-nodes');

    Route::resource('pages', PageController::class)
        ->names('admin.pages');

    Route::resource('tree-page-mappings', TreePageMappingController::class)
        ->names('admin.tree-page-mappings');
});


/*
|--------------------------------------------------------------------------
| Welcome page
|--------------------------------------------------------------------------
*/
Route::get('/welcome', fn () => view('welcome'))->name('welcome');


/*
|--------------------------------------------------------------------------
| Dynamic front pages (must be LAST – catch-all)
|--------------------------------------------------------------------------
*/
Route::get('/{path}', [DynamicPageController::class, 'show'])
    ->where('path', '[A-Za-z0-9\-_]+')
    ->name('dynamic.page');