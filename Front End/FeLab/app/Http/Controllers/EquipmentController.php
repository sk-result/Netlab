<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index(){
        return view('admin.equipment.equipment');
    }
    public function create(){
        return view('admin.equipment.create');
    }
}
