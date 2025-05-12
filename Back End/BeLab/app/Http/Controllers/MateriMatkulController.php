<?php

// app/Http/Controllers/MateriMatkulController.php

namespace App\Http\Controllers;

use App\Models\MateriMatkul;
use Illuminate\Http\Request;

class MateriMatkulController extends Controller
{
    public function index()
    {
        $materi = MateriMatkul::with('category')->get();
        return response()->json(['status' => 200, 'data' => $materi]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'bab' => 'required',
            'description' => 'required',
            'file_pdf' => 'required|mimes:pdf|max:2048',
            'category_id' => 'required|exists:matkul_categories,id',
        ]);

        $pdfPath = $request->file('file_pdf')->store('materi_pdf', 'public');

        $materi = MateriMatkul::create([
            'name' => $request->name,
            'bab' => $request->bab,
            'description' => $request->description,
            'file_pdf' => $pdfPath,
            'category_id' => $request->category_id,
        ]);

        return response()->json(['message' => 'Materi berhasil dibuat', 'data' => $materi], 201);
    }

    public function show($id)
    {
        $materi = MateriMatkul::with('category')->find($id);
        if (!$materi) {
            return response()->json(['message' => 'Materi tidak ditemukan'], 404);
        }
        return response()->json(['data' => $materi]);
    }

    public function update(Request $request, $id)
    {
        $materi = MateriMatkul::find($id);
        if (!$materi) {
            return response()->json(['message' => 'Materi tidak ditemukan'], 404);
        }

        $request->validate([
            'name' => 'required',
            'bab' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:matkul_categories,id',
            'file_pdf' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file_pdf')) {
            $pdfPath = $request->file('file_pdf')->store('materi_pdf', 'public');
            $materi->file_pdf = $pdfPath;
        }

        $materi->update([
            'name' => $request->name,
            'bab' => $request->bab,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return response()->json(['message' => 'Materi berhasil diperbarui', 'data' => $materi]);
    }

    public function destroy($id)
    {
        $materi = MateriMatkul::find($id);
        if (!$materi) {
            return response()->json(['message' => 'Materi tidak ditemukan'], 404);
        }

        $materi->delete();
        return response()->json(['message' => 'Materi berhasil dihapus']);
    }
}
