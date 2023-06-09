<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use DataTables;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index', [
            "title" => "Laporan Peminjaman",
            "active" => "laporan",
            "sub" => null,
            "item" => null,
        ]);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            if ($request->tglAwal == null || $request->tglAkhir == null) {
                $data = Peminjaman::with('buku')->with('user')->with('user.profile')->with('pengembalian')->get();
            } else if ($request->status == null) {
                $data = Peminjaman::where('tgl_peminjaman', '>', date_create($request->tglAwal))->where('tgl_peminjaman', '<', date_create($request->tglAkhir))->with('buku')->with('user')->with('user.profile')->with('pengembalian')->get();
            } else {
                $data = Peminjaman::where('tgl_peminjaman', '>', date_create($request->tglAwal))->where('tgl_peminjaman', '<', date_create($request->tglAkhir))->where('status_pinjam', $request->status)->with('buku')->with('user')->with('user.profile')->with('pengembalian')->get();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('alamat', function ($row) {
                    return $row->user->profile->alamat;
                })
                ->addColumn('buku', function ($row) {
                    $r = "";
                    foreach ($row->buku as $buku) {
                        $r .=  $buku->judul_buku . ",";
                    }
                    return  $r .= "";
                })->escapeColumns([])
                ->addColumn('status', function ($row) {
                    switch ($row->status_pinjam) {
                        case '0':
                            $data = 'PENDING';
                            break;
                        case '1':
                            $data = 'ON GOING';
                            # code...
                            break;
                        case '2':
                            $data = 'SELESAI';
                            # code...
                            break;

                        default:
                            $data = "DI TOLAK";
                            # code...
                            break;
                    }
                    return $data;
                })
                ->addColumn('tgl_peminjaman', function ($row) {
                    return $row->tgl_peminjaman;
                })
                ->addColumn('jatuh_tempo', function ($row) {
                    return $row->tgl_kembali;
                })
                ->addColumn('pengembalian', function ($row) {
                    if ($row->status_pinjam == "2") {
                        return  $row->pengembalian->tgl_pengembalian;
                    } else {
                        return "-";
                    }
                })
                ->addColumn('denda', function ($row) {
                    if ($row->status_pinjam == "2") {
                        return number_format($row->pengembalian->denda, 2, ',', '.');
                    } else {
                        return "-";
                    }
                })
                ->make(true);
        } else {
        }
    }
}
