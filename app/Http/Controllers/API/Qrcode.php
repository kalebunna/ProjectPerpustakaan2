<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class Qrcode extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // untuk peminjan yang di generate adalah id semua
        // untuk pengembalian yang di generate qrcode adalah peminjaman_id
        // yang di post adalah id
        $id = $request->id;

        return response()->json([
            'status' => true,
            'message' => 'sukses menampilkan data',
            'payload' => ((int)$id += 100000)
        ], Response::HTTP_OK);
    }
}
