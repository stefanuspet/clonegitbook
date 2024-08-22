<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index($spaceid, $id)
    {
        // if (Auth::user()->role !== 'user') {
        //     abort(403, 'Unauthorized action.');
        // }

        $user = Auth::user();
        $spaces = $user->spaces()->get();
        $detailSpace = Space::find($spaceid);

        // Retrieve pages with their subpages and sub-subpages
        $pages = Page::with('subpages')->whereNull('parent_id')->where('space_id', $detailSpace->id)->get();
        $detailPage = Page::find($id);

        // jika detailspace has page
        if (!$detailPage) {
            return redirect()->route('user.space.show', $spaceid);
        } else {
            $pageBlocks = $detailPage->blocks;
        }


        // Get the previous page
        $previousPage = $this->getPreviousPage($detailPage);
        $nextPage = $this->getNextPage($detailPage);


        return view('users.page-editor', [
            'spaces' => $spaces,
            'detailSpace' => $detailSpace,
            'pages' => $pages,
            'detailPage' => $detailPage,
            'pageBlocks' => $pageBlocks,
            'previousPage' => $previousPage,
            'nextPage' => $nextPage
        ]);
    }

    private function getPreviousPage($page)
    {
        // Jika halaman memiliki parent, ambil sibling sebelumnya atau parent
        if ($page->parent_id) {
            $previousSibling = Page::where('parent_id', $page->parent_id)
                ->where('space_id', $page->space_id) // Menambahkan ruang
                ->where('order', '<', $page->order)
                ->orderBy('order', 'desc')
                ->first();

            // Jika tidak ada sibling sebelumnya, kembalikan parent
            return $previousSibling ?: Page::find($page->parent_id);
        }

        // Jika halaman tidak memiliki parent, ambil halaman sebelumnya di level yang sama
        return Page::whereNull('parent_id')
            ->where('space_id', $page->space_id) // Menambahkan ruang
            ->where('order', '<', $page->order)
            ->orderBy('order', 'desc')
            ->first();
    }


    private function getNextPage($page)
    {
        // Jika halaman memiliki subhalaman, ambil subhalaman pertama
        $firstSubPage = Page::where('parent_id', $page->id)
            ->where('space_id', $page->space_id) // Menambahkan ruang
            ->orderBy('order', 'asc')
            ->first();

        if ($firstSubPage) {
            return $firstSubPage;
        }

        // Jika halaman tidak memiliki subhalaman, ambil sibling berikutnya
        $nextSibling = Page::where('parent_id', $page->parent_id)
            ->where('space_id', $page->space_id) // Menambahkan ruang
            ->where('order', '>', $page->order)
            ->orderBy('order', 'asc')
            ->first();

        if ($nextSibling) {
            return $nextSibling;
        }

        if ($page->parent_id) {
            $parent = Page::find($page->parent_id);

            // Periksa jika parent memiliki sibling berikutnya
            $parentNextSibling = Page::where('parent_id', $parent->parent_id)
                ->where('space_id', $page->space_id) // Menambahkan ruang
                ->where('order', '>', $parent->order)
                ->orderBy('order', 'asc')
                ->first();

            if ($parentNextSibling) {
                return $parentNextSibling;
            }

            // Jika tidak ada sibling berikutnya dari parent, naik satu level lagi
            if ($parent->parent_id) {
                $grandParent = Page::find($parent->parent_id);

                // Periksa jika grandparent memiliki sibling berikutnya
                $grandParentNextSibling = Page::where('parent_id', $grandParent->parent_id)
                    ->where('space_id', $page->space_id) // Menambahkan ruang
                    ->where('order', '>', $grandParent->order)
                    ->orderBy('order', 'asc')
                    ->first();

                return $grandParentNextSibling;
            }
        }

        // Jika halaman tidak memiliki parent, ambil halaman berikutnya di level yang sama
        return Page::whereNull('parent_id')
            ->where('space_id', $page->space_id) // Menambahkan ruang
            ->where('order', '>', $page->order)
            ->orderBy('order', 'asc')
            ->first();
    }

    public function show($id)
    {
        // Ambil halaman berdasarkan ID
        $page = Page::findOrFail($id);

        // Tampilkan halaman
        return view('pages.show', compact('page'));
    }

    public function edit($id)
    {

        $page = Page::findOrFail($id);

        // Tampilkan form edit
        return view('users.page-editor', compact('page'));
    }

    public function storeBlankPage($id)
    {
        $space = Space::findOrFail($id);

        $newPage = new Page();
        $newPage->space_id = $space->id;
        $count = Page::where('space_id', $space->id)->count();
        $newPage->order = $count + 1;
        $newPage->title = 'Page' . ($count + 1);
        $newPage->save();

        return redirect()->back();
    }

    public function updateTitle(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $space = Page::findOrFail($id);
        $space->title = $validated['title'];
        $space->save();

        return  redirect()->back();
    }

    public function updatedescription(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $space = Page::findOrFail($id);
        $space->description = $validated['description'];
        $space->save();

        return  redirect()->back();
    }

    public function destroyPage($id)
    {
        $page = Page::find($id);

        if (!$page) {
            return redirect()->back();
        }

        // Hapus page
        $page->delete();

        return redirect()->back();
    }

    public function addSubpage(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            // Optionally, validate 'indentation' if it’s part of the request
        ]);

        $parentPage = Page::findOrFail($id);

        $subpage = new Page();
        $subpage->title = $request->input('title', 'subpage');
        $subpage->order = $parentPage->subpages->count() + 1;
        $subpage->parent_id = $parentPage->id;
        $subpage->space_id = $parentPage->space_id;
        $subpage->indentation = $parentPage->indentation + 1; // Example logic for setting indentation
        $subpage->save();

        return redirect()->back()->with('success', 'Subpage added successfully!');
    }

    public function addPageCover($id)
    {
        $page = Page::findOrFail($id);

        $defaultCover = 'images/page-cover/cover.jpeg';

        $page->page_cover = $defaultCover;
        $page->save();

        return redirect()->back()->with('success', 'Cover image added successfully!');
    }

    public function updatePageCover(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $page = Page::findOrFail($id);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/page-cover', 'public');
            $page->page_cover = $path;
            $page->save();
        }

        return redirect()->back()->with('success', 'Cover image updated successfully!');
    }

    public function destroyPageCover($id)
    {
        $page = Page::findOrFail($id);

        $page->page_cover = null;
        $page->save();

        return redirect()->back()->with('success', 'Cover image removed successfully!');
    }
}
