<?php

namespace App\Http\Controllers;

use App\Models\Space;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('users.dashboard');
        }

        $spaces = Space::all();
        // Kembalikan tampilan dengan data halaman
        return view('admin.dashboard', [
            'spaces' => $spaces,
        ]);
    }

    public function getUser()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $users = User::where('role', 'user')->get();

        // Kembalikan tampilan dengan data halaman
        return view('admin.alluser', [
            'users' => $users,
        ]);
    }

    public function profile()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $user = Auth::user();

        // Kembalikan tampilan dengan data halaman
        return view('admin.profile', [
            'user' => $user,
        ]);
    }

    public function jenis()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $genresCount = Space::select('genre', DB::raw('count(*) as total'))
            ->groupBy('genre')
            ->get();

        return view('admin.jenis-artikel', [
            'genresCount' => $genresCount,
        ]);
    }
}
