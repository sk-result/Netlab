<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MateriMatkulController extends Controller
{
    public  function index(){
        return view('admin.MateriMatkul.MateriMatkul');
    }
    public  function create(){
        return view('admin.MateriMatkul.create');
    }
}
