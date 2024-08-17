<!-- pages/subpage.blade.php -->

<div class="relative mb-2">
    <div class="flex justify-between items-center group border-slate-500 hover:bg-[#2a3038]">
        <a href="{{ route('user.page.index', ['spaceId' => $spaceid, 'id' => $page->id]) }}" class="flex items-center  px-2 py-2 w-full   relative" style="padding-left: {{ $page->indentation * 20 }}px;">
            <p class="bg-[#22272E] px-2 border-0 p-0 focus:ring-transparent focus:border-none w-full group-hover:bg-[#2a3038]">{{$page->title}}</p>
        </a>
        <svg class="toggle-button w-3 h-3 pr-2 hidden group-hover:block cursor-pointer text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512" onclick="toggleDropdown(this)">
            <path fill="currentColor" d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z" />
        </svg>
    </div>
    <div class="dropdown-menu absolute right-0 z-9999 top-full mt-2 w-fit rounded-md bg-slate-900 hidden">
        @if ($page->indentation < 2)

            <form action="{{ route('page.addSubpage', ['id' => $page->id]) }}" method="POST" class="mt-2 px-2 py-2 flex items-center gap-x-3">
            @csrf
            @method('POST')
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <path fill="currentColor" d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM112 256l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
            </svg>
            <button type="submit">Insert Subpage</button>
            </form>
            @endif
            <form action="{{ route('page.destroy', ['id' => $page->id]) }}" method="POST" class="mt-2 px-2 py-2 flex items-center gap-x-3">
                @csrf
                @method('DELETE')
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                </svg>
                <button type="submit">Delete</button>
            </form>
    </div>
</div>

@if ($page->subpages->isNotEmpty())
@foreach ($page->subpages as $subpage)
@include('pages.subpage', ['page' => $subpage])
@endforeach
@endif