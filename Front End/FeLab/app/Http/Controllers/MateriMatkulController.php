<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MateriMatkulController extends Controller
{

    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.api.base_url');
    }

    public function index()
    {
        $response = Http::get("{$this->baseUrl}/api/materi-matkul");

        $materis = $response->successful()
            ? $response->json()['data'] ?? []
            : [];

        return view('admin.MateriMatkul.MateriMatkul', compact('materis'));
    }

    public function show($id)
    {
        $response = Http::get("{$this->baseUrl}/api/materi-matkul/show/{$id}");

        if ($response->successful()) {
            $materi = $response->json()['data'] ?? null;
            return view('admin.MateriMatkul.MateriMatkul', compact('materi'));
        }

        abort(404);
    }

    public function create()
    {
        $response = Http::get("{$this->baseUrl}/api/matkul-categories");

        $categories = $response->successful()
            ? $response->json()['data'] ?? []
            : [];

        return view('admin.MateriMatkul.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $multipartData = [
            ['name' => 'name', 'contents' => $request->name],
            ['name' => 'bab', 'contents' => $request->bab],
            ['name' => 'category_id', 'contents' => $request->category_id],
            ['name' => 'description', 'contents' => $request->description ?? ''],
        ];


        if ($request->hasFile('file_pdf')) {
            $multipartData[] = [
                'name' => 'file_pdf',
                'contents' => fopen($request->file('file_pdf')->getPathname(), 'r'),
                'filename' => $request->file('file_pdf')->getClientOriginalName(),
            ];
        }

        $response = Http::asMultipart()->post("{$this->baseUrl}/api/materi-matkul/create", $multipartData);

        return $response->successful()
            ? redirect()->route('admin.MateriMatkul')->with('success', 'Peralatan berhasil dibuat')
            : redirect()->back()->withErrors($response->json()['message'] ?? 'Gagal membuat peralatan');
    }

    public function update($id)
    {
        $materiResponse = Http::get("{$this->baseUrl}/api/materi-matkul/show/{$id}");
        $categoryResponse = Http::get("{$this->baseUrl}/api/matkul-categories");

        if ($materiResponse->successful() && $categoryResponse->successful()) {
            $materi = $materiResponse->json()['data'] ?? null;
            $categories = $categoryResponse->json()['data'] ?? [];

            return view('admin.MateriMatkul.update', compact('materi', 'categories'));
        }

        abort(404);
    }


    public function processUpdate(Request $request, $id)
    {
        // Siapkan data multipart seperti sebelumnya (jika ada file)
        $multipartData = [
            ['name' => 'name', 'contents' => $request->name],
            ['name' => 'bab', 'contents' => $request->bab],
            ['name' => 'category_id', 'contents' => $request->category_id],
            ['name' => 'description', 'contents' => $request->description ?? ''],
        ];

        if ($request->hasFile('file_pdf')) {
            $multipartData[] = [
                'name' => 'file_pdf',
                'contents' => fopen($request->file('file_pdf')->getPathname(), 'r'),
                'filename' => $request->file('file_pdf')->getClientOriginalName(),
            ];
        }

        $response = Http::asMultipart()->put("{$this->baseUrl}/api/materi-matkul/update/{$id}", $multipartData);
        // dd( $response);
        if ($response->successful()) {
            return redirect()->route('admin.MateriMatkul')->with('success', 'Peralatan berhasil diperbarui');
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
        $response = Http::delete("{$this->baseUrl}/api/materi-matkul/destroy/{$id}");

        return $response->successful()
            ? redirect()->route('admin.MateriMatkul')->with('success', 'Peralatan berhasil dihapus')
            : redirect()->route('admin.MateriMatkul')->withErrors('Gagal menghapus peralatan');
    }
}
