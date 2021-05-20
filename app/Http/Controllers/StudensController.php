<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Studen;

class StudensController extends Controller
{
    public function index(){
        $mahasiswa = Studen::all();
        dump($mahasiswa);
        return view('index');
    }
}
