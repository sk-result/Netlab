<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EquipmentController extends Controller
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.api.base_url');
    }

    public function index(Request $request)
    {
        $equipmentResponse = Http::get("{$this->baseUrl}/api/equipment");
        $categoryResponse = Http::get("{$this->baseUrl}/api/category");
        

        $categories = $categoryResponse->successful()
            ? $categoryResponse->json()['data'] ?? []
            : [];

        $equipments = $equipmentResponse->successful()
            ? $equipmentResponse->json()['data'] ?? []
            : [];
        if ($request->ajax()) {
            // Render hanya konten bagian @section('content') saja
            return view('admin.equipment.content', compact('equipments', 'categories'));
        }

        return view('admin.equipment.equipment', compact('equipments', 'categories'));
    }

    public function show($id)
    {
        $response = Http::get("{$this->baseUrl}/api/equipment/show/{$id}");

        if ($response->successful()) {
            $equipment = $response->json()['data'] ?? null;
            return view('admin.equipment.equipment', compact('equipment'));
        }

        abort(404);
    }


    public function store(Request $request)
    {
        $multipartData = [
            ['name' => 'name', 'contents' => $request->name],
            ['name' => 'category_id', 'contents' => $request->category_id],
            ['name' => 'description', 'contents' => $request->description ?? ''],
        ];

        if ($request->hasFile('image')) {
            $multipartData[] = [
                'name' => 'image',
                'contents' => fopen($request->file('image')->getPathname(), 'r'),
                'filename' => $request->file('image')->getClientOriginalName(),
            ];
        }

        $response = Http::asMultipart()->post("{$this->baseUrl}/api/equipment/create", $multipartData);

        return $response->successful()
            ? redirect()->route('admin.equipment')->with('success', 'Peralatan berhasil dibuat')
            : redirect()->back()->withErrors($response->json()['message'] ?? 'Gagal membuat peralatan');
    }


    public function processUpdate(Request $request, $id)
    {
        // Siapkan data multipart seperti sebelumnya (jika ada file)
        $multipartData = [
            ['name' => 'name', 'contents' => $request->name],
            ['name' => 'category_id', 'contents' => $request->category_id],
            ['name' => 'description', 'contents' => $request->description ?? ''],
        ];

        if ($request->hasFile('image')) {
            $multipartData[] = [
                'name' => 'image',
                'contents' => fopen($request->file('image')->getPathname(), 'r'),
                'filename' => $request->file('image')->getClientOriginalName(),
            ];
        }

        $response = Http::asMultipart()->put("{$this->baseUrl}/api/equipment/update/{$id}", $multipartData);
        // dd( $response);
        if ($response->successful()) {
            return redirect()->route('admin.equipment')->with('success', 'Peralatan berhasil diperbarui');
        } else {

            // Tangkap seluruh response JSON untuk debugging
            $errorData = $response->json();

            // Simpan error lengkap ke session supaya bisa tampil di view
            return redirect()->back()->with('error_data', $errorData)
                ->withErrors($errorData['message'] ?? 'Gagal memperbarui peralatan');
        }
    }

    public function destroy($id)
    {
        $response = Http::delete("{$this->baseUrl}/api/equipment/destroy/{$id}");

        return $response->successful()
            ? redirect()->route('admin.equipment')->with('success', 'Peralatan berhasil dihapus')
            : redirect()->route('admin.equipment')->withErrors('Gagal menghapus peralatan');
    }
}
