<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
{
    // List semua equipment
    public function index()
    {
        $equipments = Equipment::with('category')->get();
        return response()->json(['status' => 200, 'data' => $equipments]);
    }

    // Simpan data equipment baru (bisa upload image thumbnail)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('equipment', 'public');
        }

        $equipment = Equipment::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Peralatan berhasil ditambahkan',
            'data' => $equipment
        ], 201);
    }

    // Update equipment
    public function update(Request $request, $id)
    {
        $equipment = Equipment::find($id);
        if (!$equipment) {
            return response()->json(['message' => 'Peralatan tidak ditemukan'], 404);
        }

        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $equipment->name = $request->name;
        $equipment->category_id = $request->category_id;
        $equipment->description = $request->description;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($equipment->image) {
                Storage::disk('public')->delete($equipment->image);
            }
            $equipment->image = $request->file('image')->store('equipment', 'public');
        }

        $equipment->save();

        return response()->json([
            'status' => 200,
            'message' => 'Peralatan berhasil diperbarui',
            'data' => $equipment
        ]);
    }

    // Hapus equipment
    public function destroy($id)
    {
        $equipment = Equipment::find($id);
        if (!$equipment) {
            return response()->json(['message' => 'Peralatan tidak ditemukan'], 404);
        }

        if ($equipment->image) {
            Storage::disk('public')->delete($equipment->image);
        }

        $equipment->delete();

        return response()->json(['message' => 'Peralatan berhasil dihapus'], 200);
    }
}
