<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\pengembalian;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $peminjaman = Peminjaman::where('id', $request->pengembalian)->first();
        $t = date_create($peminjaman->tgl_kembali);
        $n = date_create(date('Y-m-d'));
        $terlambat = date_diff($t, $n);
        $hari = $terlambat->format("%a");
        if ($n < $t) {
            $denda = "0";
        } else {
            $denda = $hari * 1000;
        }

        $peminjaman->pengembalian()->create([
            'peminjaman_id' => $peminjaman->id,
            'tgl_pengembalian' => $n,
            'denda' => $denda,
            'pengembalian' => $peminjaman->id,
            'status_kembali' => "0"
        ]);

        return response([
            'status' => true,
            'message' => 'sukses menampilkan data',
            'payload' => "Sukses"
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = pengembalian::with('peminjaman.user')->with('peminjaman.buku')->whereHas('peminjaman.user', function ($query) use ($id) {
            $query->where('users.id', $id);
        })->get();

        foreach ($data as $row) {
            $dataar[] = array(
                'id' => $row['id'],
                'tgl_peminjaman' => $row->peminjaman->tgl_peminjaman,
                'tgl_kembali' => $row->peminjaman->tgl_kembali,
                'tgl_pengembalian' => $row['tgl_pengembalian'],
                'id_mahasiswa' => $row->peminjaman->user->id,
                'pengembalian' => $row->peminjaman->buku->count(),
                'id_pengembalian' => $row['peminjaman_id'],
                'status_kembali' => $row['status_kembali'],
                'denda' => "Denda Rp." . number_format($row['denda'], 2)
            );
        }


        return response([
            'status' => true,
            'message' => 'sukses menampilkan data',
            'payload' => $dataar
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
