<?php
  
namespace App\Http\Controllers;

use App\Like;
use App\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
  
class HomeController extends Controller
{
    public function index()
    {
        $wisatas = DB::table('fotos')
        ->leftjoin('wisatas', 'wisatas.id', '=', 'fotos.wisata_id')
        ->leftjoin('users', 'users.id', '=', 'fotos.created_by')
        ->selectRaw('fotos.id, likes, users.name, nama_file, nama_wisata, categori, alamat, DATE_FORMAT(fotos.created_date, "%d %M %Y") as created_date')
        ->orderBy('fotos.id', 'desc')
        ->get(); 
// dd($wisatas);
        $data =collect();
        foreach($wisatas as $wisata){
            $likes = DB::table('likes')
            ->where('foto_id', '=', $wisata->id)
            ->where('unlike', '=', 0)
            ->selectRaw('foto_id, count(*) as total')
            ->groupBy('foto_id')
            ->get();

            if($likes){
                $like = $likes[0]->total;
            }else{
                $like = 0;
            }
            $data->push((object)[
                "id"=> $wisata->id,
                "likes"=> $like,
                "name"=> "Muhammad Sani",
                "nama_file"=> "1621494203.jpg",
                "nama_wisata"=> "mata ie",
                "categori"=> "Aceh Besar",
                "alamat"=> "Aceh Besar",
                "created_date"=> "20 May 2021"
            ]);
        }
        // dd($data);
        // $wisatas  = $data;
        return view('home',['wisatas' =>$data]);
    }

    public function like(Request $request){
        $likes = DB::table('likes')
                ->where('foto_id', '=', $request->idfoto)
                ->where('user_id', '=', $request->iduser)
                ->get();
        if($likes){
            if($likes[0]->unlike == 0){
                $status = 1;
            }else {
                $status = 0;
            }
            $unlike = DB::table('likes')
              ->where('id', $likes[0]->id)
              ->update(['unlike' => $status]);
        }else{
            $like = new Like();
            $like->foto_id = $request->idfoto;
            $like->user_id = $request->iduser;
            $like->save();
        }
        return redirect('/home');
    }
}