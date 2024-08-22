<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SpaceController extends Controller
{
    public function index($spaceId)
    {
        // if (Auth::user()->role !== 'user') {
        //     abort(403, 'Unauthorized action.');
        // }

        $user = Auth::user();
        $spaces = $user->spaces()->get();
        $detailSpace = Space::find($spaceId);

        // Retrieve pages with their subpages and sub-subpages
        $pages = Page::with('subpages')->whereNull('parent_id')->where('space_id', $spaceId)->get();


        return view('users.space-edit', [
            'spaces' => $spaces,
            'detailSpace' => $detailSpace,
            'pages' => $pages,
        ]);
    }

    public function updateTitleSpace(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $space = Space::findOrFail($id);
        $space->title = $request->title;
        $space->save();

        return redirect()->back();
    }

    public function updateGenreSpace(Request $request, $id)
    {
        $request->validate([
            'genre' => 'required|string|max:255',
        ]);

        $space = Space::findOrFail($id);
        $space->genre = $request->genre;
        $space->save();

        return redirect()->back();
    }

    public function uploadImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Temukan space berdasarkan ID
        $space = Space::findOrFail($id);

        // Handle file upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($space->image_url && Storage::exists($space->image_url)) {
                Storage::delete($space->image_url);
            }

            // Simpan gambar baru
            $path = $request->file('image')->store('images', 'public');

            // Update URL gambar di database
            $space->image_url = $path;
            $space->save();
        }

        return redirect()->back()->with('success', 'Image updated successfully.');
    }

    public function destroy($id)
    {
        $space = Space::findOrFail($id);
        $space->delete();

        return redirect()->route('users.dashboard');
    }
}
