<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\jenis;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class Controllerjenis extends Controller
{
    public function tambah(Request $req){
        if(Auth::user()->level=="admin"){
            $validator=Validator::make($req->all(),
        [
            'nama_jenis'=>'required',
            'harga_kilo'=>'required',
            
        ]
    );
    if($validator->fails()){
        return Response()->json($validator->errors());
    }
    $simpan=jenis::create([
            'nama_jenis'=>$req->nama_jenis,
            'harga_kilo'=>$req->harga_kilo,
        
    ]);
    if($simpan){
        return response ()->json(['status'=>'berhasil tambah data']);
    }
    else{
        return response ()->json(['status'=>'gagal']);
    }
        }
        else{
            return response()->json(['status'=>'bukan admin :(']);                                      
        }
    }
    public function update($id,Request $req){
        if(Auth::user()->level=="admin"){
        $validator=Validator::make($req->all(),
        [
           
            'nama_jenis'=>'required',
            
        ]
    );
    if($validator->fails()){
        return Response()->json($validator->errors());
    }
    $ubah=jenis::where('id',$id)->update([
        'nama_jenis'=>$req->nama_jenis,
            'harga_kilo'=>$req->harga_kilo,
            
        
    ]);
    if($ubah){
        return Response()->json(['status'=>'berhasil update data']);
    }
    else{
     return Response()->json(['status'=>'gagal deh :(']);
    }
}else{
    return Response()->json(['status'=>'anda bukan admin  :(']);
}
    }
    public function destroy($id){
        if(Auth::user()->level=="admin"){
        $hapus=jenis::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>'berhasil']);
        }
        else{
            return Response()->json(['status'=>'gogol']);
        }
    }else{
        return Response()->json(['status'=>'anda bukan admin  :(']);
    }
    }
    public function show(){
        $dt_detail= jenis::get();
        return Response()->json($dt_detail);    
        }
    
    }
    
    



