<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TreeNodeController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TreePageMappingController;
use App\Http\Controllers\DynamicPageController;
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
Auth::routes();
Route::resource('tree-nodes', TreeNodeController::class)
    ->names('admin.tree-nodes');
Route::resource('pages', PageController::class)
    ->names('admin.pages');
    Route::resource('tree-page-mappings', TreePageMappingController::class)
    ->names('admin.tree-page-mappings');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);

});
Route::middleware(['auth', AuthAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('roles/{role}/permissions', [RoleController::class, 'edit'])->name('roles.permissions.edit');
    Route::post('roles/{role}/permissions', [RoleController::class, 'update'])->name('roles.permissions.update');
    Route::get('users/{user}/roles', [UserController::class, 'edit'])->name('users.roles.edit');
    Route::post('users/{user}/roles', [UserController::class, 'update'])->name('users.roles.update');

});
Route::get('/{path}', [DynamicPageController::class, 'show'])
    ->where('path', '[A-Za-z0-9\-_]+')
    ->name('dynamic.page');