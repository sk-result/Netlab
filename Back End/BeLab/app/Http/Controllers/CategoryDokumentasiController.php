<?php

namespace App\Http\Controllers;

use App\Models\CategoryDokumentasi;
use Illuminate\Http\Request;

class CategoryDokumentasiController extends Controller
{

    // GET /api/categories
    public function index()
    {
        $categories = CategoryDokumentasi::all();

        if ($categories->isEmpty()) {
            return response()->json([           
                'status' => 404,
                'message' => 'Tidak ada kategori ditemukan',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => 201,
            'message' => 'Berhasil mengambil data kategori',
            'data' => $categories
        ], 200, [], JSON_PRETTY_PRINT);
    }

    // GET /api/categories/{id}
    public function show($id)
    {
        $category = CategoryDokumentasi::find($id);

        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data kategori',
            'data' => $category
        ], 200);
    }

    // POST /api/categories
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category = CategoryDokumentasi::create([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Kategori berhasil dibuat',
            'data' => $category
        ], 201); // 201 Created
    }

    // PUT /api/categories/{id}
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category = CategoryDokumentasi::find($id);

        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        $category->name = $request->name;
        $category->save();

        return response()->json([
            'status' => 200,
            'message' => 'Kategori berhasil diperbarui',
            'data' => $category
        ], 200); // 200 OK
    }

    // DELETE /api/categories/{id}
    public function destroy($id)
    {
        $category = CategoryDokumentasi::find($id);

        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Kategori berhasil dihapus'
        ], 200); // 200 OK
    }


}
