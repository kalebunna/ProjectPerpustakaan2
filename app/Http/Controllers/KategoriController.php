<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorekategoriRequest;
use App\Http\Requests\UpdatekategoriRequest;
use App\Models\kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kategori.index', [
            "title" => "Kategori",
            "active" => "kategori",
            "sub" => null,
            "item" => null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.new', [
            "title" => "Buku",
            "sub" => "Tambahkan",
            "item" => null,
            'active' => 'kategori',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorekategoriRequest $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required',
        ]);
        kategori::create($validatedData);

        return redirect('/kategori')->with('success', 'Kategori baru telah ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(kategori $kategori)
    {
        return view('kategori.detail', [
            "active" => "kategori",
            "title" => "Buku",
            "sub" => "Detail",
            "item" => $kategori->nama_kategori,
            "kategori" => $kategori
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategori $kategori)
    {
        return view('kategori.edit', [
            'title' => 'kategori',
            'kategori' => $kategori,
            'active' => 'kategori',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatekategoriRequest $request, kategori $kategori)
    {
        $rules = [
            'id' => 'required',
        ];

        if ($request->nama_kategori != $kategori->nama_kategori) {
            $rules['nama_kategori'] = 'required';
        }

        $validatedData = $request->validate($rules);
        kategori::where('id', $validatedData['id'])->update($validatedData);

        return redirect('/kategori')->with('success', 'Kategori telah diubah!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kategori $kategori)
    {
        kategori::destroy($kategori->id);
        return redirect('/kategori')->with('success', 'Buku telah dihapus.');
    }
}
