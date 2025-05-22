<?php

use App\Http\Controllers\AboutController;
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
Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category-store');
Route::get('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category-update');
Route::patch('/category/procesUpdate/{id}', [CategoryController::class, 'procesUpdate'])->name('admin.category-procesUpdate');
Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category-destroy');


// CATEGORY MATKUL ROUTE
Route::get('/categoryMatkul', [CategoryMatkulController::class, 'index'])->name('admin.categoryMatkul');
Route::get('/categoryMatkul/create', [CategoryMatkulController::class, 'create'])->name('admin.categoryMatkul-create');
Route::post('/categoryMatkul/store', [CategoryMatkulController::class, 'store'])->name('admin.categoryMatkul-store');
Route::get('/categoryMatkul/update/{id}', [CategoryMatkulController::class, 'update'])->name('admin.categoryMatkul-update');
Route::patch('/categoryMatkul/procesUpdate/{id}', [CategoryMatkulController::class, 'procesUpdate'])->name('admin.categoryMatkul-procesUpdate');
Route::delete('/categoryMatkul/delete/{id}', [CategoryMatkulController::class, 'destroy'])->name('admin.categoryMatkul-destroy');

// EQUIPMENT ROUTE
Route::get('/equipment', [EquipmentController::class, 'index'])->name('admin.equipment');
Route::get('/equipment/create', [EquipmentController::class, 'create'])->name('admin.equipment-create');
Route::post('/equipment/store', [EquipmentController::class, 'store'])->name('admin.equipment-store');
Route::get('/equipment/update/{id}', [EquipmentController::class, 'update'])->name('admin.equipment-update');
Route::put('/equipment/processUpdate/{id}', [EquipmentController::class, 'processUpdate'])->name('admin.equipment-processUpdate');
Route::delete('/equipment/delete/{id}', [EquipmentController::class, 'destroy'])->name('admin.equipment-destroy');


Route::get('/MateriMatkul', [MateriMatkulController::class, 'index'])->name('admin.MateriMatkul');
Route::get('/MateriMatkul/create', [MateriMatkulController::class, 'create'])->name('admin.MateriMatkul-create');
Route::post('/MateriMatkul/store', [MateriMatkulController::class, 'store'])->name('admin.MateriMatkul-store');
Route::get('/MateriMatkul/update/{id}', [MateriMatkulController::class, 'update'])->name('admin.MateriMatkul-update');
Route::put('/MateriMatkul/processUpdate/{id}', [MateriMatkulController::class, 'processUpdate'])->name('admin.MateriMatkul-processUpdate');
Route::delete('/MateriMatkul/delete/{id}', [MateriMatkulController::class, 'destroy'])->name('admin.MateriMatkul-destroy');


Route::get('/about', [AboutController::class, 'index'])->name('admin.about');
Route::get('/about/create', [AboutController::class, 'create'])->name('admin.about-create');

});