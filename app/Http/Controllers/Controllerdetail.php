<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\detail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use DB;
use App\jenis;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
class Controllerdetail extends Controller
{
    public function tambah(Request $req){
        if(Auth::user()->level=="admin"){
            $validator=Validator::make($req->all(),
        [
            
            'id_transaksi'=>'required',
            'id_jenis'=>'required',
           
            
            
        ]
    ); 
    if($validator->fails()){
        return Response()->json($validator->errors());
    }
    $hargakilo =jenis::where('id',$req->id_jenis)->first() ;
    $subtotal=$hargakilo->harga_kilo*$req->qty;
    $simpan=detail::create([
            
            'id_transaksi'=>$req->id_transaksi,
            'id_jenis'=>$req->id_jenis,
            'id_pelanggan'=>$req->id_pelanggan,
            'subtotal'=>$subtotal,
            'qty'=>$req->qty,
        
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
        $validator=Validator::make($req->all(),
        [
            'id_petugas'=>'required',
            'id_pelanggan'=>'required',
            'tgl_transaksi'=>'required',
            'tgl_selesai'=>'required'
            
           
            
        ]
    );
    if($validator->fails()){
        return Response()->json($validator->errors());
    }
    $hargakilo =jenis::where('id',$req->id_jenis)->first() ;
    $subtotal=$hargakilo->harga_kilo*$req->qty;
    $ubah=detail::where('id',$id)->update([
        'id_transaksi'=>$req->id_transaksi,
        'id_jenis'=>$req->id_jenis,
        'id_pelanggan'=>$req->id_pelanggan,
        'subtotal'=>$subtotal,
        'qty'=>$req->qty,
        
    ]);
    if($ubah){
        return Response()->json(['status'=>'berhasil update data']);
    }
    else{
     return Response()->json(['status'=>'gagal deh :(']);
    }
    
    }
    public function destroy($id){
        $hapus=tiket::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>'berhasil']);
        }
        else{
            return Response()->json(['status'=>'gogol']);
        }
    }
    public function show()
    {
        if(Auth::user()->level == 'admin'){
            $dt_detail=Detail::get();
            return Response()->json($dt_detail);
        }else{
            return Response()->json('Anda Bukan admin');
        }
    }
}
