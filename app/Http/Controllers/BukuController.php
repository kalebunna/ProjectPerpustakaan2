<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorebukuRequest;
use App\Http\Requests\UpdatebukuRequest;
use App\Models\buku;
use App\Models\kategori;
use App\Models\User;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        User::with("roles")->whereHas("roles", function ($q) {
            $q->where("name", "member");
        })->get();

        return view('book.index', [
            "title" => "Buku",
            "sub" => null,
            "item" => null,
            "active" => "buku",
            "bukus" => buku::with('kategori')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.new', [
            "title" => "Buku",
            "sub" => "Tambahkan",
            "active" => "buku",
            "item" => null,
            "kategoris" => kategori::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorebukuRequest $request)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'judul_buku' => 'required',
            'penerbit' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'jumlah_halaman' => 'required',
            'tahun_terbit' => 'required',
            'stok_buku' => 'required',
            'sinopsis' => 'required',
            'bahasa' => 'required',
            'label_buku' => 'required',
            'gambar' => 'required|mimes:png,jpg,jpeg',
        ]);

        $image = $request->file('gambar');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        $validatedData['gambar'] = $imageName;
        buku::create($validatedData);

        return redirect('/buku')->with('success', 'Buku baru telah ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(buku $buku)
    {
        return view('book.detail', [
            "title" => "Buku",
            "sub" => "Detail",
            "active" => "buku",
            "item" => $buku->judul,
            "buku" => $buku
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(buku $buku)
    {
        return view('book.edit', [
            "title" => "Buku",
            "sub" => "Edit",
            "active" => "buku",
            "item" => $buku->judul_buku,
            "kategori" => kategori::all(),
            "buku" => $buku
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebukuRequest $request, buku $buku)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'judul_buku' => 'required',
            'penerbit' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'jumlah_halaman' => 'required',
            'tahun_terbit' => 'required',
            'stok_buku' => 'required',
            'sinopsis' => 'required',
            'bahasa' => 'required',
            'label_buku' => 'required',
            'gambar' => 'mimes:png,jpg,jpeg',
        ]);

        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $validatedData['gambar'] = $imageName;
        } else {
            $validatedData['gambar'] = $buku->gambar;
        }

        $buku->update($validatedData);
        return redirect('/buku')->with('success', 'BUku telah diubah!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(buku $buku)
    {
        buku::destroy($buku->id);
        return redirect('/buku')->with('success', 'Buku telah dihapus.');
    }
}
