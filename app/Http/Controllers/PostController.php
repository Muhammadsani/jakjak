<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Foto;
use App\Wisata;

class PostController extends Controller
{
    public function index()
    {
        return view('post');
    }
    public function submit(Request $request)
    {        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imageName = time().'.'.$request->image->extension();  
     
        $request->image->move(public_path('images'), $imageName);
  
        $wisata = DB::table('wisatas')->where('nama_wisata', $request->namawisata)->first();
        if($wisata == null){
            $wisatas = new Wisata;
            $wisatas->nama_wisata = $request->namawisata;
            $wisatas->alamat = $request->alamat;
            $wisatas->categori = $request->alamat;
            $wisatas->created_by = $request->userId;
            $wisatas->save();
            $wisata = DB::table('wisatas')->where('nama_wisata', $request->namawisata)->first();
        }
        $foto = new Foto;
        $foto->nama_file = $imageName;
        $foto->wisata_id = $wisata->id;
        $foto->created_by = $request->userId;
        $simpan = $foto->save();
    
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName); 
    }
}
