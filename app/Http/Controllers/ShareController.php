<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function index($spaceId, $userId)
    {
        $user = User::find($userId);
        $spaces = $user->spaces()->find($spaceId);
        // get pages with their subpages and sub-subpages where page space_id is equal to $spaceId
        $pages = $spaces->pages()->with('subpages')->whereNull('parent_id')->get();

        return view('layouts.shared', compact('spaces', 'pages'));
    }

    public function show($spaceId, $userId, $pageId)
    {
        $user = User::find($userId);
        $spaces = $user->spaces()->find($spaceId);
        $pages = $spaces->pages()->with('subpages')->whereNull('parent_id')->get();
        $detailPage = Page::find($pageId);
        // get allblog from detail page
        $block = $detailPage->blocks;

        $previousPage = $this->getPreviousPage($detailPage);
        $nextPage = $this->getNextPage($detailPage);

        return view('share', compact('spaces', 'pages', 'detailPage', 'block', 'previousPage', 'nextPage'));
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
    }
}
