<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryMatkulController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category-create');

Route::get('/categoryMatkul', [CategoryMatkulController::class, 'index'])->name('admin.categoryMatkul');
});
