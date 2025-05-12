<?php

namespace App\Http\Controllers;

use App\Models\MatkulCategory;
use Illuminate\Http\Request;

class MatkulCategoryController extends Controller
{
    public function index()
    {
        $data = MatkulCategory::all();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data kategori matkul',
            'data' => $data
        ], 200);
    }

    public function show($id)
    {
        $category = MatkulCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Kategori matkul tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Kategori matkul berhasil ditemukan',
            'data' => $category
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = MatkulCategory::create([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Kategori matkul berhasil dibuat',
            'data' => $category
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $category = MatkulCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Kategori matkul tidak ditemukan'], 404);
        }

        $request->validate([
            'name' => 'required'
        ]);

        $category->update(['name' => $request->name]);

        return response()->json([
            'status' => 200,
            'message' => 'Kategori matkul berhasil diperbarui',
            'data' => $category
        ]);
    }

    public function destroy($id)
    {
        $category = MatkulCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Kategori matkul tidak ditemukan'], 404);
        }

        $category->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Kategori matkul berhasil dihapus'
        ]);
    }
}
