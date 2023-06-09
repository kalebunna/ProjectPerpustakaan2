<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Identitas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_sekolah',
        'nama_aplikasi',
        'alamat',
        'tahun_ajaran',
        'denda',
        'logo',
    ];
}
