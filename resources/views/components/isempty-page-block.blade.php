@props(['detailPage'])

<div class="py-2 group relative opacity-0 hover:opacity-100">
    <form action="{{ route('pageblock.store', $detailPage->id) }}" method="POST" class="px-20">
        @csrf
        @method('POST')
        <input type="text" name="type" value="paragraph" hidden>
        <input style="opacity: 0.8;" name="content" readonly class="bg-[#22272E] text-lg cursor-default  font-normal border-0 p-0 focus:ring-transparent focus:border-none w-full group-hover:bg-[#2a3038]" type="text" placeholder="Add content? Please choose from the options below">
        <button type="submit" class="hidden">Submit</button>
    </form>
    <div class="absolute bg-slate-800 left-16 top-10 ">
        <div class="flex gap-x-0.5">
            <form action="{{ route('pageblock.store', $detailPage->id) }}" method="POST" class="px-4 hover:bg-slate-500 py-2 flex items-center gap-x-3">
                @csrf
                @method('POST')
                <input type="text" name="type" value="paragraph" hidden>
                <button type="submit" class="text-sm">Paragraf</button>
            </form>

            <form action="{{ route('pageblock.store', $detailPage->id) }}" method="POST" class="px-4 hover:bg-slate-500 py-2 flex items-center gap-x-3">
                @csrf
                @method('POST')
                <input type="text" name="type" value="heading1" hidden>
                <button type="submit" class="text-sm">Heading 1</button>
            </form>

            <form action="{{ route('pageblock.store', $detailPage->id) }}" method="POST" class="px-4 hover:bg-slate-500 py-2 flex items-center gap-x-3">
                @csrf
                @method('POST')
                <input type="text" name="type" value="heading2" hidden>
                <button type="submit" class="text-sm">Heading 2</button>
            </form>

            <form action="{{ route('pageblock.store', $detailPage->id) }}" method="POST" class="px-4 hover:bg-slate-500 py-2 flex items-center gap-x-3">
                @csrf
                @method('POST')
                <input type="text" name="type" value="heading3" hidden>
                <button type="submit" class="text-sm">Heading 3</button>
            </form>

            <form action="{{ route('pageblock.store', $detailPage->id) }}" method="POST" class="px-4 hover:bg-slate-500 py-2 flex items-center gap-x-3">
                @csrf
                @method('POST')
                <input type="text" name="type" value="image" hidden>
                <button type="submit" class="text-sm">Image</button>
            </form>

            <form action="{{ route('pageblock.store', $detailPage->id) }}" method="POST" class="px-4 hover:bg-slate-500 py-2 flex items-center gap-x-3">
                @csrf
                @method('POST')
                <input type="text" name="type" value="unorderedlist" hidden>
                <button type="submit" class="text-sm">Unordered List</button>
            </form>
        </div>
    </div>
</div>