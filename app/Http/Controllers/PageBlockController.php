<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageBlockController extends Controller
{
    public function storePageBlock(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $newPageBlock = new PageBlock();
        $newPageBlock->page_id = $page->id;
        $newPageBlock->content_type = $request->type;
        $newPageBlock->content = $request->content;
        $newPageBlock->order = $page->blocks->count() + 1;
        $newPageBlock->save();

        return redirect()->back();
    }

    public function updatePageBlock(Request $request, $id)
    {
        $request->validate([
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,HEIC|max:2048',
        ]);

        $pageBlock = PageBlock::findOrFail($id);
        // store image
        try {
            // Jika ada file gambar yang diunggah
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($pageBlock->content && Storage::exists($pageBlock->content)) {
                    Storage::delete($pageBlock->content);
                }

                // Simpan gambar baru
                $path = $request->file('image')->store('images/pageblock', 'public');
                $pageBlock->content = $path;
            } else {
                // Jika tidak ada file gambar, perbarui konten teks
                $pageBlock->content = $request->content;
            }

            $pageBlock->save();
        } catch (\Exception $e) {
            // Tangani kesalahan dengan mengirimkan pesan debug
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui blok halaman: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Blok halaman berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pageBlock = PageBlock::findOrFail($id);
        $pageBlock->delete();

        return redirect()->back();
    }
}
