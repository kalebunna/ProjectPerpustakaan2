<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class kategori extends Model
{
    use HasApiTokens, HasFactory;
    protected $fillable = [
        "nama_kategori"
    ];
    protected $guarded = ['id'];
    public function buku()
    {
        return $this->hasMany(buku::class);
    }
}
