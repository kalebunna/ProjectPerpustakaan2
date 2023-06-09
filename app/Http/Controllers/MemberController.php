<?php

namespace App\Http\Controllers;

use App\Models\profile;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('member.index', [
            "title" => "Member",
            "sub" => null,
            "active" => "member",
            "item" => null,
            "datas" => User::with("roles")->whereHas("roles", function ($q) {
                $q->where("name", "member");
            })->with('profile')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('member.new', [
            "title" => "Member",
            "sub" => "Tambahkan",
            "item" => null,
            'active' => 'member',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $validatedDataPofile = $request->validate([
            'nim' => 'required',
            'kelamin' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        // $user = User::has('profile')->create($request->all());
        $user = User::create($validatedData);
        $user->profile()->create($validatedDataPofile);
        $user->assignRole('member');
        return redirect('/member');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id', $id)->with('profile')->first();
        return view('member.detail', [
            'title' => 'Member',
            'member' => $user,
            'active' => 'member',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id', $id)->with('profile')->first();
        return view('member.edit', [
            'title' => 'Member',
            'member' => $user,
            'active' => 'member',
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
            'nim' => 'required',
            'kelamin' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
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
        return redirect('/member')->with('success', 'Kategori telah diubah!.');
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
        return redirect('/member')->with('success', 'Kategori telah dihapus!.');
    }
}
