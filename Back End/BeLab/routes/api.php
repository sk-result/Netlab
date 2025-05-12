<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Ambil semua kategori
Route::get('/category', [CategoryController::class, 'index']);
Route::post('/category/create', [CategoryController::class, 'store']);
Route::patch('/category/update/{id}', [CategoryController::class, 'update']);
Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy']);
Route::get('/category/show/{id}', [CategoryController::class, 'show']);


use App\Http\Controllers\AuthController;
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/admin-only', function () {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }
        return response()->json(['message' => 'Selamat datang, Admin!']);
    });
});


use App\Http\Controllers\EquipmentController;
Route::apiResource('equipment', EquipmentController::class);

use App\Http\Controllers\MatkulCategoryController;
Route::apiResource('matkul-categories', MatkulCategoryController::class);

use App\Http\Controllers\MateriMatkulController;
Route::apiResource('materi-matkul', MateriMatkulController::class);

use App\Http\Controllers\AboutController;
Route::apiResource('abouts', AboutController::class);

use App\Http\Controllers\PendaftaranController;
Route::apiResource('pendaftaran', PendaftaranController::class);
