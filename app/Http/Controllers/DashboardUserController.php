<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Space;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'user') {
            abort(403, 'Unauthorized action.');
        }

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Ambil space yang terkait dengan pengguna
        $spaces = $user->spaces()->get();

        // Kembalikan tampilan dengan data halaman
        return view('users.dashboard', [
            'spaces' => $spaces,
        ]);
    }

    public function storeSpace(Request $request)
    {
        $user = Auth::user();

        // Ambil jumlah halaman yang dimiliki pengguna
        $spaceCount = $user->spaces()->count();

        // Buat page_title yang sesuai dengan jumlah halaman yang ada
        $spaceTitle = $spaceCount === 0 ? 'untitled' : 'untitled' . ($spaceCount + 1);
        $defaultImageUrl = 'images/default.png';
        $space = new Space([
            'user_id' => $user->id,
            'title' => $spaceTitle,
            'image_url' => $defaultImageUrl,
            'parent_id' => null,
        ]);


        $space->save();

        $page = new Page([
            'space_id' => $space->id,
            'title' => 'page',
            'description' => '',
            'page_cover' => null,
            'parent_id' => null,
            'order' => 1,
        ]);
        $page->save();

        return redirect()->back();
    }
}
