<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.category.category');
    }

    public function create(){
        return view('admin.category.create');
    }
}
