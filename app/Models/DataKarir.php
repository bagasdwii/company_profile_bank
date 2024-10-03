<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKarir extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'keterangan', 'gambar','hari','tanggal','user_id'];

}
