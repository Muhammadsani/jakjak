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
        // $rules = [
        //     'name'                  => 'required|min:3|max:35',
        //     'email'                 => 'required|email|unique:users,email',
        //     'password'              => 'required|confirmed'
        // ];

        // $messages = [
        //     'name.required'         => 'Nama Lengkap wajib diisi',
        //     'name.min'              => 'Nama lengkap minimal 3 karakter',
        //     'name.max'              => 'Nama lengkap maksimal 35 karakter',
        //     'email.required'        => 'Email wajib diisi',
        //     'email.email'           => 'Email tidak valid',
        //     'email.unique'          => 'Email sudah terdaftar',
        //     'password.required'     => 'Password wajib diisi',
        //     'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
        // ];

        // $validator = Validator::make($request->all(), $rules, $messages);

        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInput($request->all);
        // }

        
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
        // if(true){
        //     Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
        //     return redirect()->route('post');
        // } else {
        //     Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
        //     return redirect()->route('post');
        // }
    }
}
