@props(['block', 'detailPage'])

<div class=" group relative">
    <form id="myForm-{{ $block->id }}" action="{{ route('pageblock.update', $block->id) }}" enctype="multipart/form-data" method="POST" class="px-16 py-0">
        @csrf
        @method('POST')
        @if ($block->content === null)
        @if($block->content_type !== 'image')
        <textarea
            name="content"
            class="bg-[#22272E] text-lg font-normal opacity-0 focus:opacity-100 px-4 hover:opacity-100 border-0 p-0 focus:ring-transparent focus:border-none w-full group-hover:bg-[#2a3038] resize-none  focus:bg-[#2a3038]"
            rows="1"
            placeholder="Enter your content here..."
            id="contentTextarea-{{ $block->id }}">{{ $block->content }}</textarea>
        @endif
        <!-- Tambahkan tombol submit jika diperlukan -->
        @if ($block->content_type === 'image')
        <input
            style="opacity: 0.8;"
            name="image"
            class="bg-[#22272E] text-lg font-normal border-0 px-4 py-0 focus:ring-transparent focus:border-none w-full group-hover:bg-[#2a3038]"
            type="file"
            id="fileInput-{{ $block->id }}">
        @endif
        @else
        @switch($block->content_type)
        @case('paragraph')
        <textarea
            style="opacity: 0.8;"
            name="content"
            class="bg-[#22272E] text-lg font-normal border-0 px-4 py-0 focus:ring-transparent focus:border-none w-full group-hover:bg-[#2a3038] resize-none focus:bg-[#2a3038]"
            rows="1"
            placeholder="Enter your content here..."
            id="contentTextarea-{{ $block->id }}">{{ $block->content }}</textarea>
        @break
        @case('heading1')
        <input
            style="opacity: 1;"
            name="content"
            class="bg-[#22272E] text-3xl font-bold border-0 px-4 py-4 focus:ring-transparent focus:border-none w-full group-hover:bg-[#2a3038] focus:bg-[#2a3038]"
            type="text"
            value="{{ $block->content }}"
            id="contentTextarea-{{ $block->id }}">
        @break
        @case('heading2')
        <input
            style="opacity: 1;"
            name="content"
            class="bg-[#22272E] text-2xl font-bold border-0 px-4 py-3 focus:ring-transparent focus:border-none w-full group-hover:bg-[#2a3038] focus:bg-[#2a3038]"
            type="text"
            value="{{ $block->content }}"
            id="contentTextarea-{{ $block->id }}">
        @break
        @case('heading3')
        <input
            style="opacity: 1;"
            name="content"
            class="bg-[#22272E] text-xl font-bold border-0 px-4 py- focus:ring-transparent focus:border-none w-full group-hover:bg-[#2a3038] focus:bg-[#2a3038]"
            type="text"
            value="{{ $block->content }}"
            id="contentTextarea-{{ $block->id }}">
        @break
        @case('image')
        <div class="w-1/2 h-auto mx-auto relative mt-5 mb-5 group/input">
            <div class="w-full h-full">
                <img src="{{ asset('storage/' . $block->content) }}" alt="image" class="w-full h-full object-cover">
            </div>
            <input
                style="opacity: 0;"
                name="image"
                class="bg-[#22272E] absolute z-10 top-0 inset-0 h-full  text-lg font-normal border-0 px-4 py-0 focus:ring-transparent focus:border-none w-full group-hover:bg-[#2a3038]"
                type="file"
                id="contentTextarea-{{ $block->id }}">
            <div class="hidden opacity-80 group-hover/input:flex w-full items-center border absolute z-0 inset-0 top-0 bg-slate-800 text-white px-2 py-1">
                <p class="text-center w-full">Change Image</p>
            </div>

        </div>
        @break
        @case('unorderedlist')
        <div class="flex pl-10">
            <li class="list-disc"></li>
            <textarea
                style="opacity: 0.8;"
                name="content"
                class="bg-[#22272E] text-lg font-normal border-0 px-0 py-0 focus:ring-transparent focus:border-none w-full group-hover:bg-[#2a3038] resize-none focus:bg-[#2a3038]"
                rows="1"
                placeholder="Enter your content here..."
                id="contentTextarea-{{ $block->id }}">{{ $block->content }}</textarea>
        </div>
        @break
        @endswitch
        @endif
        <button type="submit" class="hidden">Submit</button>
    </form>
    <button id="buttonaddblock-{{$block->id}}" class="absolute left-10 top-2 hidden group-hover:block">
        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path fill="currentColor" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
        </svg>
    </button>
    <div id="nice-{{$block->id}}" class="absolute bg-slate-800 left-16 -top-11 z-20 hidden">
        <div class="flex w-full h-full gap-x-0.5">
            <form action="{{ route('pageblock.store', $detailPage->id) }}" method="POST" class="px-4 hover:bg-slate-500 flex items-center gap-x-3">
                @csrf
                @method('POST')
                <input type="text" name="type" value="paragraph" hidden>
                <button type="submit" class="text-sm py-3">Paragraf</button>
            </form>

            <form action="{{ route('pageblock.store', $detailPage->id) }}" method="POST" class="px-4 hover:bg-slate-500 flex items-center gap-x-3">
                @csrf
                @method('POST')
                <input type="text" name="type" value="heading1" hidden>
                <button type="submit" class="text-sm py-3">Heading 1</button>
            </form>

            <form action="{{ route('pageblock.store', $detailPage->id) }}" method="POST" class="px-4 hover:bg-slate-500 flex items-center gap-x-3">
                @csrf
                @method('POST')
                <input type="text" name="type" value="heading2" hidden>
                <button type="submit" class="text-sm py-3">Heading 2</button>
            </form>

            <form action="{{ route('pageblock.store', $detailPage->id) }}" method="POST" class="px-4 hover:bg-slate-500 flex items-center gap-x-3">
                @csrf
                @method('POST')
                <input type="text" name="type" value="heading3" hidden>
                <button type="submit" class="text-sm py-3">Heading 3</button>
            </form>

            <form action="{{ route('pageblock.store', $detailPage->id) }}" method="POST" class="px-4 hover:bg-slate-500 flex items-center gap-x-3">
                @csrf
                @method('POST')
                <input type="text" name="type" value="image" hidden>
                <button type="submit" class="text-sm py-3">Image</button>
            </form>

            <form action="{{ route('pageblock.store', $detailPage->id) }}" method="POST" class="px-4 hover:bg-slate-500 flex items-center gap-x-3">
                @csrf
                @method('POST')
                <input type="text" name="type" value="unorderedlist" hidden>
                <button type="submit" class="text-sm py-3">Unordered List</button>
            </form>

            <form action="{{ route('pageblock.destroy', $block->id) }}" method="POST" class="px-4 hover:bg-slate-500 flex items-center gap-x-3">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dapatkan semua input file yang ada di halaman
        const fileInputs = document.querySelectorAll('input[type="file"]');

        fileInputs.forEach(input => {
            input.addEventListener('change', function() {
                // Dapatkan ID form dari input file
                const formId = this.id.replace('fileInput-', 'myForm-');
                // Submit form terkait
                document.getElementById(formId).submit();
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        // Dapatkan semua input file yang ada di halaman
        const fileInputs = document.querySelectorAll('input[type="file"]');

        fileInputs.forEach(input => {
            input.addEventListener('change', function() {
                // Dapatkan ID form dari input file
                const formId = this.id.replace('contentTextarea-', 'myForm-');
                // Submit form terkait
                document.getElementById(formId).submit();
            });
        });
    });
</script>