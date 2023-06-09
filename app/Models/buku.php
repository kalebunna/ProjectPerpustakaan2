<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    use HasFactory;
    protected $fillable = [
        'kategori_id',
        'judul_buku',
        'tahun_terbit',
        'penerbit',
        'pengarang',
        'bahasa',
        'penerbit',
        'jumlah_halaman',
        'stok_buku',
        'sinopsis',
        'label_buku',
        'gambar',
    ];

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'kategori_id');
    }

    /**
     * The roles that belong to the buku
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function peminjaman()
    {
        return $this->belongsToMany(Peminjaman::class, 'peminjaman_buku');
    }
}
