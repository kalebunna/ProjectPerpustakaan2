<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index', [
            "title" => "Admin",
            "active" => "admin",
            "sub" => null,
            "item" => null,
            "datas" => User::with("roles")->whereHas("roles", function ($q) {
                $q->where("name", "admin");
            })->with('profile')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create', [
            "title" => "Admin",
            "sub" => "Tambahkan",
            "item" => null,
            'active' => 'admin',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'kelamin' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        // $user = User::has('profile')->create($request->all());
        $validatedData['password'] = (bcrypt($request->password));
        $user = User::create($validatedData);
        $user->profile()->create($request->except(['name', 'email', 'password']));
        $user->assignRole('admin');
        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id', $id)->with('profile')->first();
        return view('admin.detail', [
            'title' => 'Admin',
            'admin' => $user,
            'active' => 'admin',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id', $id)->with('profile')->first();
        return view('admin.edit', [
            'title' => 'Admin',
            'admin' => $user,
            'active' => 'admin',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user  = User::findOrFail($id);
        // dd($user);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => '',
        ]);
        $validatedDataPofile = $request->validate([
            'kelamin' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);


        if ($validatedData['password'] == '') {
            $validatedData['password'] = $user->password;
        } else {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }
        $user->update($validatedData);
        $user->profile()->update($validatedDataPofile);
        return redirect('/admin')->with('success', 'Kategori telah diubah!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->first();
        // dd($user);
        $user->profile()->delete();
        $user->delete();
        return redirect('/admin')->with('success', 'Kategori telah dihapus!.');
    }
}
