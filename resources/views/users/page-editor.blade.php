@extends('users.space-edit')

@section('content')
<div class="w-4/5 py-5">
    <div class="h-full overflow-x-auto scrollbar-hide">
        @if ($detailPage->page_cover !== null)
        <form id="updatepagecover" action="{{ route('page.updateCover', ['id' => $detailPage->id]) }}" method="post" enctype="multipart/form-data" class="w-full px-20">
            @csrf
            <div class="w-full h-44 group relative cursor-pointer">
                <img class="w-full h-full object-cover" src="{{ asset('storage/' . $detailPage->page_cover) }}" alt="Cover Image">
                <input id="updatepagecoverinput" class="absolute z-10 cursor-pointer top-0 right-0 w-full inset-0 opacity-0 border" type="file" name="image">
                <div class="absolute z-0 hidden group-hover:flex group-hover:bg-slate-800 group-hover:bg-opacity-50 top-0 inset-0 w-full h-full items-center text-center">
                    <p class="w-full text-lg font-bold">Change Image</p>
                </div>
            </div>
        </form>

        <script>
            document.getElementById('updatepagecoverinput').addEventListener('change', function() {
                // Log the event to ensure the change event is being triggered
                console.log('File selected, submitting form...');

                // Submit the form
                document.getElementById('updatepagecover').submit();
            });
        </script>

        @endif
        <div class="flex relative group">
            @if (empty($detailPage->page_cover))
            <form action="{{ route('page.updateTitle', ['id' => $detailPage->id]) }}" method="POST" class="w-full pl-20 pr-32">
                @csrf
                <input name="title" class="bg-[#22272E] text-5xl font-bold border-0 p-0 focus:ring-transparent focus:border-none w-full group-hover:bg-[#2a3038]" type="text" value="{{ $detailPage->title }}">
                <button type="submit" class="hidden">Submit</button>
            </form>
            <form action="{{route('page.addCover', ['id'=>$detailPage->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <button type="submit" class="absolute items-center hidden group-hover:flex gap-x-3 right-4 top-4 bg-slate-500 px-2 py-1 rounded-sm">
                    <svg
                        fill="currentColor"
                        class="w-3 h-3"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M448 80c8.8 0 16 7.2 16 16l0 319.8-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3L48 96c0-8.8 7.2-16 16-16l384 0zM64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
                    </svg>
                    <p class="text-sm">Add image</p>
                </button>
            </form>
            @else
            <form action="{{ route('page.updateTitle', ['id' => $detailPage->id]) }}" method="POST" class="w-full pl-20 pr-32">
                @csrf
                <input name="title" class="bg-[#22272E] text-5xl font-bold border-0 p-0 focus:ring-transparent focus:border-none w-full group-hover:bg-[#2a3038]" type="text" value="{{ $detailPage->title }}">
                <button type="submit" class="hidden">Submit</button>
            </form>
            <form action="{{ route('page.deleteCover', ['id' => $detailPage->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="absolute items-center hidden group-hover:flex gap-x-3 right-4 top-4 bg-slate-500 px-2 py-1 rounded-sm">
                    <svg
                        fill="currentColor"
                        class="w-3 h-3"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M448 80c8.8 0 16 7.2 16 16l0 319.8-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3L48 96c0-8.8 7.2-16 16-16l384 0zM64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
                    </svg>
                    <p class="text-sm">Delete img</p>
                </button>
            </form>
            @endif
        </div>

        <form action="{{ route('page.updateDescription', ['id' => $detailPage->id]) }}" method="POST" class="w-full px-20">
            @csrf
            @method('POST')

            @if(empty($detailPage->description))
            <input style="opacity: 0.4;" name="description" class="bg-[#22272E] text-md border-0 p-0 focus:ring-transparent focus:border-none w-full group-hover:bg-[#2a3038] py-2" type="text" value="Page description (optional)">
            @else
            <input style="opacity: 0.4;" name="description" class="bg-[#22272E] text-md border-0 p-0 focus:ring-transparent focus:border-none w-full group-hover:bg-[#2a3038] py-2" type="text" value="{{ $detailPage->description }}">
            @endif
            <button type="submit" class="hidden">Submit</button>
        </form>

        <!-- to fetch Pageblock -->
        @foreach ($pageBlocks as $block)
        <x-fetch-page-block :block="$block" :detailPage="$detailPage" />
        @endforeach

        @if ($pageBlocks->isEmpty())
        <x-isempty-page-block :detailPage="$detailPage" />
        @endif
        @php
        $spaceid = request()->route('spaceId');
        @endphp
        <div class="pt-10 pb-5">
            <div class="flex gap-x-10 px-20">
                @if($previousPage)
                <a href="{{ route('user.page.index', ['spaceId' => $spaceid, 'id' => $previousPage->id]) }}" class="w-full h-full">
                    <div class=" h-full border flex justify-between rounded-md items-center px-10 py-5">
                        <svg
                            fill="currentColor"
                            class="w-6 h-6"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M459.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29l0-320c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4L288 214.3l0 41.7 0 41.7L459.5 440.6zM256 352l0-96 0-128 0-32c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160C4.2 237.5 0 246.5 0 256s4.2 18.5 11.5 24.6l192 160c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29l0-64z" />
                        </svg>
                        <p>previousPage {{$previousPage->title}}</p>
                    </div>
                </a>
                @endif
                @if($nextPage)
                <a href="{{ route('user.page.index', ['spaceId' => $spaceid, 'id' => $nextPage->id]) }}" class="w-full h-full">
                    <div class="w-full h-full border rounded-md flex justify-between items-center px-10 py-5">
                        <p>Next to {{$nextPage->title}}</p>
                        <svg
                            fill="currentColor"
                            class="w-6 h-6"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M52.5 440.6c-9.5 7.9-22.8 9.7-34.1 4.4S0 428.4 0 416L0 96C0 83.6 7.2 72.3 18.4 67s24.5-3.6 34.1 4.4L224 214.3l0 41.7 0 41.7L52.5 440.6zM256 352l0-96 0-128 0-32c0-12.4 7.2-23.7 18.4-29s24.5-3.6 34.1 4.4l192 160c7.3 6.1 11.5 15.1 11.5 24.6s-4.2 18.5-11.5 24.6l-192 160c-9.5 7.9-22.8 9.7-34.1 4.4s-18.4-16.6-18.4-29l0-64z" />
                        </svg>
                    </div>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textareas = document.querySelectorAll('[id^="contentTextarea-"]');

        textareas.forEach(textarea => {
            const blockId = textarea.id.split('-').pop();
            const form = document.getElementById(`myForm-${blockId}`);

            if (form) {
                console.log(`Attaching events to textarea ${textarea.id} and form ${form.id}`);

                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = this.scrollHeight + 'px';
                });

                textarea.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter' && !event.shiftKey) {
                        event.preventDefault();
                        form.requestSubmit();
                    }
                });

                textarea.style.height = 'auto';
                textarea.style.height = textarea.scrollHeight + 'px';
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Function to toggle dropdown visibility
        function toggleDropdown(button) {
            const id = button.id.split('-')[1];
            const dropdown = document.getElementById(`nice-${id}`);

            if (dropdown) {
                dropdown.classList.toggle('hidden');
                console.log('clicked', dropdown.classList);
            }
        }

        // Attach click event to all toggle buttons
        document.querySelectorAll('[id^="buttonaddblock-"]').forEach(button => {
            button.addEventListener('click', () => toggleDropdown(button));
        });

        // Close the dropdown if clicked outside
        document.addEventListener('click', (event) => {
            const isClickInside = event.target.closest('[id^="buttonaddblock-"]') || event.target.closest('.dropdown-menus');
            if (!isClickInside) {
                document.querySelectorAll('.dropdown-menus').forEach(dropdown => {
                    if (!dropdown.classList.contains('hidden')) {
                        dropdown.classList.add('hidden');
                    }
                });
            }
        });

        // Close the dropdown on Escape key press
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                document.querySelectorAll('.dropdown-menus').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            }
        });
    });
</script>
@endsection