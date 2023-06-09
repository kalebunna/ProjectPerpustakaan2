<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BukuController extends Controller
{
    public function filterBuku(Request $request)
    {
        $k = str_replace('%20', ' ', $request->query('k'));
        $j = str_replace('%20', ' ', $request->query('j'));
        // $j = $_GET['j'];
        if (empty($k) && empty($j)) {
            $ids = "1";
        } else if (empty($j)) {
            $ids = "2";
        } else if (empty($k)) {
            $ids = "3";
        } else if ($k === null && $j === null) {
            $ids = "2";
        } else {
            $ids = "2";
        }


        if ($ids == "1") {
            $datas = buku::with('kategori')->get();
        } elseif ($ids == "2") {
            $datas = buku::where('judul_buku', 'like', '%' . $j . '%')->whereHas('kategori', function ($q) use ($k) {
                $q->where('nama_kategori', '=', $k);
            })->get();
        } else {
            $datas = buku::with('kategori')->where('judul_buku', 'like', '%' . $j . '%')->get();
        }
        $finalData = collect();
        foreach ($datas as $key) {
            $tempData['id'] = $key->id;
            $tempData['judul_buku'] = $key->judul_buku;
            $tempData['pengarang'] = $key->pengarang;
            $tempData['penerbit'] = $key->penerbit;
            $tempData['tahun_terbit'] = $key->tahun_terbit;
            $tempData['jumlah_halaman'] = $key->jumlah_halaman;
            $tempData['gambar'] =  $key->gambar;
            $tempData['stok_buku'] = $key->stok_buku;
            $tempData['bahasa'] = $key->bahasa;
            $tempData['sinopsis'] = $key->sinopsis;
            $tempData['kategori'] = $key->kategori->id;
            $tempData['id_kategori'] = $key->kategori->id;
            $tempData['nama_kategori'] = $key->kategori->nama_kategori;
            $finalData->add($tempData);
        }

        return response()->json([
            'status' => true,
            'message' => 'sukses menampilkan data',
            'payload' => $finalData
        ], Response::HTTP_OK);
    }

    public function getDataById($id)
    {
        return response()->json([
            'status' => true,
            'message' => 'sukses menampilkan data',
            'payload' => buku::where('id', $id)->first()
        ], Response::HTTP_OK);
    }

    // public function get_data_peminjaman_with_buku()
    // {
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'sukses menampilkan data',
    //         'payload' => Buku::with('peminjaman')->get()
    //     ], Response::HTTP_OK);
    // }
}
