<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryMatkulController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MateriMatkulController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// CATEGORY ROUTE
Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category-create');

// CATEGORY MATKUL ROUTE
Route::get('/categoryMatkul', [CategoryMatkulController::class, 'index'])->name('admin.categoryMatkul');
Route::get('/categoryMatkul/create', [CategoryMatkulController::class, 'create'])->name('admin.categoryMatkul-create');

Route::get('/equipment', [EquipmentController::class, 'index'])->name('admin.equipment');
Route::get('/equipment/create', [EquipmentController::class, 'create'])->name('admin.equipment-create');

Route::get('/MateriMatkul', [MateriMatkulController::class, 'index'])->name('admin.MateriMatkul');
Route::get('/MateriMatkul/create', [MateriMatkulController::class, 'create'])->name('admin.MateriMatkul-create');
});