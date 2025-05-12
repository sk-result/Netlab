<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        return response()->json(About::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description_1' => 'required|string',
            'description_2' => 'required|string',
            'image_1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image_2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['title', 'description_1', 'description_2']);

        if ($request->hasFile('image_1')) {
            $data['image_1'] = $request->file('image_1')->store('about', 'public');
        }

        if ($request->hasFile('image_2')) {
            $data['image_2'] = $request->file('image_2')->store('about', 'public');
        }

        $about = About::create($data);

        return response()->json([
            'message' => 'About berhasil dibuat',
            'data' => $about
        ], 201);
    }

    public function show($id)
    {
        $about = About::find($id);

        if (!$about) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($about, 200);
    }

    public function update(Request $request, $id)
    {
        $about = About::find($id);

        if (!$about) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'title' => 'required|string',
            'description_1' => 'required|string',
            'description_2' => 'required|string',
            'image_1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image_2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $about->title = $request->title;
        $about->description_1 = $request->description_1;
        $about->description_2 = $request->description_2;

        if ($request->hasFile('image_1')) {
            $about->image_1 = $request->file('image_1')->store('about', 'public');
        }

        if ($request->hasFile('image_2')) {
            $about->image_2 = $request->file('image_2')->store('about', 'public');
        }

        $about->save();

        return response()->json([
            'message' => 'About berhasil diperbarui',
            'data' => $about
        ], 200);
    }

    public function destroy($id)
    {
        $about = About::find($id);

        if (!$about) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $about->delete();

        return response()->json(['message' => 'About berhasil dihapus'], 200);
    }
}

