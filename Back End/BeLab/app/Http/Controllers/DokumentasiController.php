<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumentasi;
use Illuminate\Support\Facades\Storage;

class DokumentasiController extends Controller
{
    public function index()
    {
        $dokumentasi = Dokumentasi::with('category')->get();
        return response()->json(['status' => 200, 'data' => $dokumentasi]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('dokumentasi', 'public');
        }

        $dokumentasi = Dokumentasi::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image' => $path,
            'description' => $request->description,
        ]);

        return response()->json(['status' => 201, 'message' => 'Peralatan berhasil ditambahkan', 'data' => $dokumentasi], 201);
    }

    public function show($id)
    {
        $dokumentasi = Dokumentasi::with('category')->find($id);
        if (!$dokumentasi) {
            return response()->json(['message' => 'Peralatan tidak ditemukan'], 404);
        }

        return response()->json(['status' => 200, 'data' => $dokumentasi], 200);
    }

    public function update(Request $request, $id)
    {
        $dokumentasi = Dokumentasi::find($id);

        if (!$dokumentasi) {
            return response()->json(['message' => 'Peralatan tidak ditemukan'], 404);
        }

        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update data model
        $dokumentasi->name = $request->name;
        $dokumentasi->category_id = $request->category_id;
        $dokumentasi->description = $request->description;

        // Jika ada file baru di-upload
        if ($request->hasFile('image')) {
            // Menghapus gambar lama jika ada
            if ($dokumentasi->image) {
                Storage::delete('public/' . $dokumentasi->image);
            }
            $imagePath = $request->file('image')->store('dokumentasi', 'public');
            $dokumentasi->image = $imagePath;
        }

        // Simpan perubahan ke database
        $dokumentasi->save();

        return response()->json([
            'status' => 200,
            'message' => 'Data peralatan berhasil diperbarui',
            'data' => $dokumentasi
        ], 200);
    }


    public function destroy($id)
    {
        $dokumentasi = Dokumentasi::find($id);
        if (!$dokumentasi) {
            return response()->json(['message' => 'Peralatan tidak ditemukan'], 404);
        }

        if ($dokumentasi->image) {
            Storage::disk('public')->delete($dokumentasi->image);
        }

        $dokumentasi->delete();

        return response()->json(['message' => 'Peralatan berhasil dihapus'], 200);
    }
}
