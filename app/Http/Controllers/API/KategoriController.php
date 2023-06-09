<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\KategoriResource;
use App\Models\kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return KategoriResource::collection(kategori::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kategori = kategori::create([
            "nama_kategori" => $request->nama_kategori
        ]);

        $token = $kategori->createToken('myAppToken');

        return (new KategoriResource($kategori))->additional([
            'token' => $token->plainTextToken
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = kategori::find($id);
        return new KategoriResource($kategori);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
