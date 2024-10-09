<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKontak extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'telepon', 'no_wa','alamat','gmap'];
}
