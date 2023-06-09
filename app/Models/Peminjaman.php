<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjamans';
    protected $fillable = [
        'user_id', 'tgl_peminjaman', 'tgl_kembali', 'peminjaman', 'status_pinjam', 'alasan'
    ];

    public function buku()
    {
        return $this->belongsToMany(buku::class, 'peminjaman_buku');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }
}
