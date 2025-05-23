<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryMatkulController extends Controller
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.api.base_url');
    }

    public function index(Request $request)
    {
        $response = Http::get("$this->baseUrl/api/matkul-categories");
        $json = $response->json();
        $categories = $json['data'] ?? [];
        if ($request->ajax()) {
            // Render hanya konten bagian @section('content') saja
            return view('admin.category_matkul.content', compact('categories'));
        }

        return view('admin.category_matkul.categoryMatkul', compact('categories'));
    }

    public function show($id)
    {
        $response = Http::get("$this->baseUrl/api/matkul-categories/show/$id");
        if ($response->successful()) {
            $show = $response->json();
            return view('admin.category_matkul.update', compact('show'));
        }
        abort(404);
    }


    public function store(Request $request)
    {
        $response = Http::post("$this->baseUrl/api/matkul-categories/create", [
            'name' => $request->name,
        ]);
        if ($response->successful()) {
            return redirect()->route('admin.categoryMatkul')->with('success', 'Kategori berhasil dibuat');
        } else {
            return redirect()->back()->withErrors('Gagal membuat kategori matkul');
        }
    }


    public function update(Request $request, $id)
    {

        $response = Http::patch("$this->baseUrl/api/matkul-categories/update/$id", [
            'name' => $request->name,
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.categoryMatkul')->with('success', 'Kategori matkul berhasil diperbarui');
        } else {
            return redirect()->back()->withErrors('Gagal memperbarui kategori matkul');
        }
    }

    public function destroy($id)
    {

        $response = Http::delete("$this->baseUrl/api/matkul-categories/destroy/$id");
        if ($response->successful()) {
            return redirect()->route('admin.categoryMatkul')->with('success', 'Kategori matkul berhasil dihapus');
        } else {
            return redirect()->route('admin.categoryMatkul')->withErrors('Gagal menghapus kategori matkul');
        }
    }
}
