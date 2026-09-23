<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
Auth::routes();




Route::middleware(['auth'])->group(function(){
    Route::get('/',[HomeController::class,'index']);
   






});
Route::middleware(['auth',AuthAdmin::class])->group(function(){
    Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions',PermissionController::class);
    Route::get('roles/{role}/permissions', [RoleController::class, 'edit'])->name('roles.permissions.edit');
    Route::post('roles/{role}/permissions', [RoleController::class, 'update'])->name('roles.permissions.update');
    Route::get('users/{user}/roles', [UserController::class,'edit'])->name('users.roles.edit');
    Route::post('users/{user}/roles', [UserController::class,'update'])->name('users.roles.update');

});
