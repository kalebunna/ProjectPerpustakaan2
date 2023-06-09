<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\Peminjaman;
use App\Models\pengembalian;
use Illuminate\Http\Request;
use DataTables;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function pending(Request $request)
    {
        $data = Peminjaman::where('status_pinjam', "0")->with('user')->with('buku')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('tgl_peminjaman', function ($row) {
                    return $row->tgl_peminjaman;
                })
                ->addColumn('tgl_kembali', function ($row) {
                    return $row->tgl_kembali;
                })
                ->addColumn('buku', function ($row) {
                    $r = "";
                    foreach ($row->buku as $buku) {
                        $r .= '<ul>' . $buku->judul_buku . '</ul>';
                    }

                    return  $r .= "";
                })->escapeColumns([])
                ->addColumn('action', function ($row) {
                    $actionBtn = ' <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-success btn-sm" data-id="' . $row->id . '" data-nama="' . $row->user->name . '" onClick="updateTerima(this)"  data-toggle="modal" data-target="#modalTerima">
                                            <i class="fa fa-check" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-id="' . $row->id . '" data-nama="' . $row->user->name . '"onClick="updateTolak(this)"  data-toggle="modal" data-target="#modalTolak"><i class="fa fa-times"
                                                aria-hidden="true"></i></button>
                                    </div>';
                    return $actionBtn;
                })->escapeColumns([])
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('peminjaman.index', [
            'title' => "Peminjaman Pending",
            'data' => null,
            'active' => "pending",
        ]);
    }



`

    // public function pinjamDiKembalikan(Request $request)
    // {
    //     $data = Peminjaman::where('status_pinjam', "5")->with('user')->with('buku')->get();
    //     if ($request->ajax()) {
    //         return DataTables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('name', function ($row) {
    //                 return $row->user->name;
    //             })
    //             ->addColumn('tgl_peminjaman', function ($row) {
    //                 return $row->tgl_peminjaman;
    //             })
    //             ->addColumn('tgl_kembali', function ($row) {
    //                 return $row->tgl_kembali;
    //             })
    //             ->addColumn('buku', function ($row) {
    //                 $r = "";
    //                 foreach ($row->buku as $buku) {
    //                     $r .= '<ul>' . $buku->judul_buku . '</ul>';
    //                 }

    //                 return  $r .= "";
    //             })->escapeColumns([])
    //             ->addColumn('alasan', function ($row) {
    //                 return $row->alasan;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }

    //     return view('peminjaman.ditolak', [
    //         'title' => "Peminjaman Di Kembalikan",
    //         'data' => null,
    //         'active' => "dikembalikan",
    //     ]);
    // }
}
