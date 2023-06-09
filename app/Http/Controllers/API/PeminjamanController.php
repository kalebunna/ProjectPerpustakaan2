<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\buku;
use App\Models\kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use function PHPUnit\Framework\isEmpty;

class PeminjamanController extends Controller
{
    public function getPeminjamanByUser($id)
    {
        $Peminjaman = Peminjaman::where('user_id', $id)->with('buku')->get();
        $dataar = false;
        foreach ($Peminjaman as $row) {
            $dataar[] = array(
                'id_peminjaman' => $row->id,
                'tgl_peminjaman' => $row['tgl_peminjaman'],
                'tgl_kembali' => $row['tgl_kembali'],
                'id_mahasiswa' => $row['user_id'],
                'peminjaman' => $row->buku->count(),
                // 'id_peminjaman' => $row['peminjaman'],
                'status_pinjam' => $row['status_pinjam'],
                'alasan' => $row['alasan']
            );
        }
        if ($dataar) {
            return response()->json([
                'status' => true,
                'message' => 'sukses menampilkan data',
                'payload' => $dataar
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'gagal menampilkan data',
                'payload' => null
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function show($id)
    {
        // $data = Peminjaman::where('id', $id)->has('buku')->get();
        $data = buku::whereHas('peminjaman', function ($query) use ($id) {
            $query->where('peminjamans.id', $id);
        })->has('kategori')->get();
        $dataBuku = [];
        foreach ($data as $key) {
            $dataBuku[] = [
                "id" => $key->id,
                "judul_buku" => $key->judul_buku,
                "kategori" => $key->kategori->nama_kategori,
                "gambar" => $key->gambar,
                "pengarang" => $key->pengarang,
                "penerbit" => $key->penerbit
            ];
        }

        return response()->json([
            'status' => true,
            'message' => 'sukses menampilkan data',
            'payload' => $dataBuku
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $Date = date('Y-m-d H:i:s');
        $dataStore = array(
            'user_id' => $request->id_mahasiswa,
            'tgl_kembali' => date('Y-m-d', strtotime($Date . ' + 7 days')),
            'tgl_peminjaman' => $Date,
            'status_pinjam' => "0",
            'alasan' => ""
        );
        $tempBuku = $this->checkBuku($request->id_buku);
        if (sizeof($tempBuku) > 0) {
            $peminjaman = Peminjaman::create($dataStore);
            $itemPeminjam = $peminjaman->buku()->attach($tempBuku);
            return response()->json([
                'status' => true,
                'message' => 'sukses menampilkan data',
                'payload' => $itemPeminjam
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'gagal menampilkan data',
                'payload' => ''
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function checkBuku($bukus)
    {
        $dataBuku = [];
        foreach ($bukus as $buku) {
            $tempBuku = buku::where('id', $buku)->first();
            $stokbuku = (int)$tempBuku->stok_buku;
            if ($stokbuku > 0) {
                $stokbuku -= 1;
                $tempBuku->update([
                    "stok_buku" => $stokbuku
                ]);
                $dataBuku[] = $tempBuku->id;
            }
        }

        return $dataBuku;
    }
}
