<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{

    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.api.base_url');
    }
    public function index()
    {
        $categoryResponse = Http::get("{$this->baseUrl}/api/category");
        $equipmentResponse = Http::get("{$this->baseUrl}/api/equipment");

        if ($categoryResponse->successful() && $equipmentResponse->successful()) {
            $category = $categoryResponse->json()['data'] ?? [];
            $equipment = $equipmentResponse->json()['data'] ?? [];

            return view('landing-pages.index', compact('category', 'equipment'));
        }

        // Tambahkan penanganan error jika perlu
        return abort(500, 'Failed to fetch data from API.');
    }
}
