<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\KategoriResource;
use App\Models\kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $credentials = Auth::attempt([
            'email' => $request->user,
            'password' => $request->pass
        ]);
        if ($credentials) {
            $user = User::where(['email' => $request->user])->first();
            $profile = $user->profile()->first();
            $profile['nama'] = $user->name;
            $profile['email'] = $user->email;
            return response()->json([
                'status' => true,
                'message' => 'sukses menampilkan data',
                'payload' => $profile
            ], Response::HTTP_OK);
        } else {
        }
    }
}
