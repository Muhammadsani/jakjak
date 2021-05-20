<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
  
class HomeController extends Controller
{
    public function index()
    {
        $wisatas = DB::table('fotos')
        ->join('wisatas', 'wisatas.id', '=', 'fotos.wisata_id')
        ->join('users', 'users.id', '=', 'fotos.created_by')
        // ->select()
        ->selectRaw('likes, users.name, nama_file, nama_wisata, categori, alamat, DATE_FORMAT(fotos.created_date, "%d %M %Y") as created_date')
        ->get(); 
        return view('home',['wisatas' =>$wisatas]);
    }
}