<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jenis extends Model
{
    protected $table="jenis";
  protected $primaryKey="id";
  protected $fillable=['nama_jenis','harga_kilo'];
  
}
