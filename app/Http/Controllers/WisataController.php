<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wisata;

class WisataController extends Controller
{
    public function index(){
        $wisata = Wisata::all();
        dump($wisata);
        return view('index');
    }
}
