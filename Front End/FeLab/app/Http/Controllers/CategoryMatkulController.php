<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryMatkulController extends Controller
{
    public function index(){
        return view('admin.category_matkul.categoryMatkul');
    }
    public function create(){
        return view('admin.category_matkul.create');
    }
}
