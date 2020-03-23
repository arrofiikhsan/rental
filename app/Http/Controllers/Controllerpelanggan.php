<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pelanggan;
use Auth;
use Illuminate\Support\Facades\Validator;
class Controllerpelanggan extends Controller
{
    public function tambah(Request $req){
        if(Auth::user()->level=="admin"){
            $validator=Validator::make($req->all(),
        [
            'nama'=>'required',
            'no_telp'=>'required',
            'alamat'=>'required',
            
        ]
    );
    if($validator->fails()){
        return Response()->json($validator->errors());
    }
    $simpan=pelanggan::create([
            'nama'=>$req->nama,
            'no_telp'=>$req->no_telp,
            'alamat'=>$req->alamat,
        
    ]);
    if($simpan){
        return response ()->json(['status'=>'berhasil tambah data']);
    }
    else{
        return response ()->json(['status'=>'gagal']);
    }
        }
        else{
            return response()->json(['status'=>'gagal :(']);                                      
        }
    }
    public function update($id,Request $req){
        if(Auth::user()->level=="admin"){
        $validator=Validator::make($req->all(),
        [
            'nama_film'=>'required',
            'genre'=>'required',
            'deskripsi'=>'required',
            
        ]
    );
    if($validator->fails()){
        return Response()->json($validator->errors());
    }
    $ubah=film::where('id',$id)->update([
        'nama_film'=>$req->nama_film,
            'genre'=>$req->genre,
            'deskripsi'=>$req->deskripsi,
        
    ]);
    if($ubah){
        return Response()->json(['status'=>'berhasil update data']);
    }
    else{
     return Response()->json(['status'=>'gagal deh :(']);
    }
}else{
    return Response()->json(['status'=>'bukan admin :(']);
}
    
    }
    public function destroy($id){
        if(Auth::user()->level=="admin"){
        $hapus=pelanggan::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>'berhasil']);
        }
        else{
            return Response()->json(['status'=>'gogol']);
        }
    }else{
        return Response()->json(['status'=>'bukan admin :(']);
    }
}
    public function show(){
        if(Auth::user()->level=="admin"){
        $datapelanggan = film::get();
        $arr_data = array();
        foreach($datapelanggan as $data) {
            $arr_data[] = array(
                'nama pelanggan'=>$data->nama,
                'almaat'=>$data->alamat,
                'no_telp'=>$data->no_telp,
        
            );
        
        }
    }else{
        return Response()->json(['status'=>'bukan admin :(']);
    }
    
        return Response()->json($arr_data);
    }
    }
    

