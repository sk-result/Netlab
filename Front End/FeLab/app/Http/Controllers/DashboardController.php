<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Render hanya konten bagian @section('content') saja
            return view('admin.dashboard.content');
        }

        // Jika bukan AJAX, render layout lengkap
        return view('admin.dashboard.dashboard');
    }
}
