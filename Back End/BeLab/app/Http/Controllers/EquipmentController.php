<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::with('category')->get();
        return response()->json(['status' => 200, 'data' => $equipment]);
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
            $path = $request->file('image')->store('equipment', 'public');
        }

        $equipment = Equipment::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image' => $path,
            'description' => $request->description,
        ]);

        return response()->json(['status' => 201, 'message' => 'Peralatan berhasil ditambahkan', 'data' => $equipment], 201);
    }

    public function show($id)
    {
        $equipment = Equipment::with('category')->find($id);
        if (!$equipment) {
            return response()->json(['message' => 'Peralatan tidak ditemukan'], 404);
        }

        return response()->json(['status' => 200, 'data' => $equipment], 200);
    }

    public function update(Request $request, $id)
    {
        $equipment = Equipment::find($id);

        if (!$equipment) {
            return response()->json(['message' => 'Peralatan tidak ditemukan'], 404);
        }

        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update data model
        $equipment->name = $request->name;
        $equipment->category_id = $request->category_id;
        $equipment->description = $request->description;

        // Jika ada file baru di-upload
        if ($request->hasFile('image')) {
            // Menghapus gambar lama jika ada
            if ($equipment->image) {
                Storage::delete('public/' . $equipment->image);
            }
            $imagePath = $request->file('image')->store('equipment', 'public');
            $equipment->image = $imagePath;
        }

        // Simpan perubahan ke database
        $equipment->save();

        return response()->json([
            'status' => 200,
            'message' => 'Data peralatan berhasil diperbarui',
            'data' => $equipment
        ], 200);
    }


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
