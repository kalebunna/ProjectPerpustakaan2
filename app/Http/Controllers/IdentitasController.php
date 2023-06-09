<?php

namespace App\Http\Controllers;

use App\Models\Identitas;
use Illuminate\Http\Request;

class IdentitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('indentitas.index', [
            'title' => 'Identtias Aplikasi',
            'identitas' => Identitas::first(),
            'active' => 'identitas',
        ]);
    }

    public function update(Request $request, Identitas $identitas)
    {
        // dd($request);
        $validatedData = $request->validate([
            'nama_sekolah' => 'required',
            'nama_aplikasi' => 'required',
            'alamat' => 'required',
            'tahun_ajaran' => 'required',
            'denda' => 'required',
            'logo' => 'mimes:png,jpg,jpeg',
        ]);

        if ($request->file('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('logo'), $imageName);
            $validatedData['logo'] = $imageName;
        } else {
            $validatedData['logo'] = $identitas->logo;
        }
        $identitas->update($validatedData);
        return redirect('/identitas')->with('status', 'Identitas Sekolah telah diperbarui!.');
    }
}
