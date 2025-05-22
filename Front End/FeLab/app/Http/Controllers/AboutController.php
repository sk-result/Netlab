<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(Request $request){
          if ($request->ajax()) {
            // Render hanya konten bagian @section('content') saja
            return view('admin.about.content');
        }

        return view('admin.about.about');
    }
    public function create(){
        return view('admin.about.create');
    }
}
