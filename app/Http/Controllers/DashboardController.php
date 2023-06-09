<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $currentTime = Carbon::now();
        return view('Dashboard.index', [
            "title" => "Dashboard",
            "active" => "dashboard",
            "sub" => null,
            "item" => null,
            "member" => User::with("roles")->whereHas("roles", function ($q) {
                $q->where("name", "member");
            })->count(),
            "book" => buku::all()->count(),
            "ongoing" => Peminjaman::where('status_pinjam', "1")->count(),
            "sekarang" => Peminjaman::whereDate('created_at', Carbon::today())->count(),
            "time" => $currentTime->toDateTimeString()
        ]);
    }
}
