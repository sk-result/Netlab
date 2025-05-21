<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.api.base_url');
    }

    public function index()
    {
        
        $response = Http::get("$this->baseUrl/api/category");
        $json = $response->json();
        $categories = $json['data'] ?? [];
        return view('admin.category.category', compact('categories'));
    }

    public function show($id)
    {
        
        $response = Http::get("$this->baseUrl/api/category/show/$id");
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
        
        $response = Http::post("$this->baseUrl/api/category/create", [
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
        
        $response = Http::get("$this->baseUrl/api/category/show/$id");
        if ($response->successful()) {
            $json = $response->json();
            $category = $json['data'] ?? [];
            return view('admin.category.update', compact('category'));
        }

        abort(404);
    }

    public function procesUpdate(Request $request, $id)
    {
        
        $response = Http::patch("$this->baseUrl/api/category/update/$id", [
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
        
        $response = Http::delete("$this->baseUrl/api/category/delete/$id");
        if ($response->successful()) {
            return redirect()->route('admin.category')->with('success', 'Kategori berhasil dihapus');
        } else {
            return redirect()->route('admin.category')->withErrors('Gagal menghapus kategori');
        }
    }
}
