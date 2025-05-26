<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryDokumentasiController;
use App\Http\Controllers\CategoryMatkulController;
use App\Http\Controllers\CkeditorUploadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MateriMatkulController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/ckeditor/upload-image', [CkeditorUploadController::class, 'upload'])->name('ckeditor.upload');


Route::get('/showLogin' , [AuthController::class, 'showLogin'])->name('showLogin');
Route::get('/showRegister' , [AuthController::class, 'showRegister'])->name('showRegister');
Route::post('/login' , [AuthController::class, 'login'])->name('login');
Route::post('/register' , [AuthController::class, 'register'])->name('register');

Route::prefix('admin')->group(function () {

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// CATEGORY ROUTE
Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category-store');
Route::patch('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category-update');
Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category-destroy');

// CATEGORY MATKUL ROUTE
Route::get('/categoryMatkul', [CategoryMatkulController::class, 'index'])->name('admin.categoryMatkul');
Route::post('/categoryMatkul/store', [CategoryMatkulController::class, 'store'])->name('admin.categoryMatkul-store');
Route::patch('/categoryMatkul/update/{id}', [CategoryMatkulController::class, 'update'])->name('admin.categoryMatkul-update');
Route::delete('/categoryMatkul/delete/{id}', [CategoryMatkulController::class, 'destroy'])->name('admin.categoryMatkul-destroy');

// CATEGORY DOKUMENTASI
Route::get('/categoryDokumentasi', [CategoryDokumentasiController::class, 'index'])->name('admin.categoryDokumentasi');
Route::post('/categoryDokumentasi/store', [CategoryDokumentasiController::class, 'store'])->name('admin.categoryDokumentasi-store');
Route::patch('/categoryDokumentasi/update/{id}', [CategoryDokumentasiController::class, 'update'])->name('admin.categoryDokumentasi-update');
Route::delete('/categoryDokumentasi/delete/{id}', [CategoryDokumentasiController::class, 'destroy'])->name('admin.categoryDokumentasi-destroy');

// EQUIPMENT ROUTE
Route::get('/equipment', [EquipmentController::class, 'index'])->name('admin.equipment');
Route::post('/equipment/store', [EquipmentController::class, 'store'])->name('admin.equipment-store');
Route::put('/equipment/processUpdate/{id}', [EquipmentController::class, 'processUpdate'])->name('admin.equipment-processUpdate');
Route::delete('/equipment/delete/{id}', [EquipmentController::class, 'destroy'])->name('admin.equipment-destroy');
Route::post('/equipment/upload', [EquipmentController::class, 'upload'])->name('admin.equipment-upload');


Route::get('/MateriMatkul', [MateriMatkulController::class, 'index'])->name('admin.MateriMatkul');
Route::get('/MateriMatkul/create', [MateriMatkulController::class, 'create'])->name('admin.MateriMatkul-create');
Route::post('/MateriMatkul/store', [MateriMatkulController::class, 'store'])->name('admin.MateriMatkul-store');
Route::get('/MateriMatkul/update/{id}', [MateriMatkulController::class, 'update'])->name('admin.MateriMatkul-update');
Route::put('/MateriMatkul/processUpdate/{id}', [MateriMatkulController::class, 'processUpdate'])->name('admin.MateriMatkul-processUpdate');
Route::delete('/MateriMatkul/delete/{id}', [MateriMatkulController::class, 'destroy'])->name('admin.MateriMatkul-destroy');


Route::get('/about', [AboutController::class, 'index'])->name('admin.about');
Route::get('/about/create', [AboutController::class, 'create'])->name('admin.about-create');

});