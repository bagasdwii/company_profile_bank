<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDeposito extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'keterangan', 'gambar','nama_button','nomor_button'];

}
