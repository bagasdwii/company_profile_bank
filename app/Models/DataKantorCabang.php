<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKantorCabang extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'alamat', 'gmap','telepon','gambar'];

}
