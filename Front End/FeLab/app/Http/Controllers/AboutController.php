<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        return view('admin.about.about');
    }
    public function create(){
        return view('admin.about.create');
    }
}
