<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    public function index()
    {
        $baseUrl = config('services.api.base_url');
        $response = Http::get("$baseUrl/category");
        $json = $response->json();
        $categories = $json['data'] ?? [];
        return view('admin.category.category', compact('categories'));
    }

    public function show($id)
    {
        $baseUrl = config('services.api.base_url');
        $response = Http::get("$baseUrl/category/show/$id");
        if ($response->successful()) {
            $show = $response->json();
            return view('admin.category.category', compact('show'));
        }
        abort(404);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $baseUrl = config('services.api.base_url');
        $response = Http::post("$baseUrl/category/create", [
            'name' => $request->name,
        ]);
        if ($response->successful()) {
            return redirect()->route('admin.category')->with('success', 'Kategori berhasil dibuat');
        } else {
            return redirect()->back()->withErrors('Gagal membuat kategori');
        }
    }

    public function update($id)
    {
        $baseUrl = config('services.api.base_url');
        $response = Http::get("$baseUrl/category/show/$id");
        if ($response->successful()) {
            $json = $response->json();
            $category = $json['data'] ?? [];
            return view('admin.category.update', compact('category'));
        }

        abort(404);
    }

    public function procesUpdate(Request $request, $id)
    {
        $baseUrl = config('services.api.base_url');
        $response = Http::patch("$baseUrl/category/update/$id", [
            'name' => $request->name,
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.category')->with('success', 'Kategori berhasil diperbarui');
        } else {
            return redirect()->back()->withErrors('Gagal memperbarui kategori');
        }
    }

    public function destroy($id)
    {
        $baseUrl = config('services.api.base_url');
        $response = Http::delete("$baseUrl/category/delete/$id");
        if ($response->successful()) {
            return redirect()->route('admin.category')->with('success', 'Kategori berhasil dihapus');
        } else {
            return redirect()->route('admin.category')->withErrors('Gagal menghapus kategori');
        }
    }
}
