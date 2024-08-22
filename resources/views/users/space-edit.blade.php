<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 0.5rem;
            width: max-content;
            background-color: #1e293b;
            z-index: 10000;
            /* Pastikan ini lebih tinggi dari elemen lain */
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        @if(Auth::user()->role == 'admin')
        <x-sidebar-admin :spaces=$spaces />
        @else
        <aside
            :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
            class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden text-white bg-[#292f36] border-r border-slate-600 duration-300 ease-linear bg-boxdark lg:static lg:translate-x-0"

            @click.outside="sidebarToggle = false">
            <!-- SIDEBAR HEADER -->
            <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
                <button
                    class="block lg:hidden"
                    @click.stop="sidebarToggle = !sidebarToggle">
                    <svg
                        class="fill-current"
                        width="20"
                        height="18"
                        viewBox="0 0 20 18"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                            fill="" />
                    </svg>
                </button>
            </div>
            <!-- SIDEBAR HEADER -->

            <div
                class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
                <!-- Sidebar Menu -->
                <nav
                    class="mt-5 px-4 py-4 lg:mt-9 lg:px-6">
                    <!-- Menu Group -->
                    <div class="w-44">
                        <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">MENU</h3>

                        <ul class="mb-6 flex flex-col gap-1.5">
                            <li class="px-2">
                                <a class="group relative rounded-lg flex items-center gap-2.5 hover:bg-gray-700 px-2 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:bg-meta-4"
                                    href="{{ route('users.dashboard') }}">
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.7499 2.9812H14.2874V2.36245C14.2874 2.02495 14.0062 1.71558 13.6405 1.71558C13.2749 1.71558 12.9937 1.99683 12.9937 2.36245V2.9812H4.97803V2.36245C4.97803 2.02495 4.69678 1.71558 4.33115 1.71558C3.96553 1.71558 3.68428 1.99683 3.68428 2.36245V2.9812H2.2499C1.29365 2.9812 0.478027 3.7687 0.478027 4.75308V14.5406C0.478027 15.4968 1.26553 16.3125 2.2499 16.3125H15.7499C16.7062 16.3125 17.5218 15.525 17.5218 14.5406V4.72495C17.5218 3.7687 16.7062 2.9812 15.7499 2.9812ZM1.77178 8.21245H4.1624V10.9968H1.77178V8.21245ZM5.42803 8.21245H8.38115V10.9968H5.42803V8.21245ZM8.38115 12.2625V15.0187H5.42803V12.2625H8.38115ZM9.64678 12.2625H12.5999V15.0187H9.64678V12.2625ZM9.64678 10.9968V8.21245H12.5999V10.9968H9.64678ZM13.8374 8.21245H16.228V10.9968H13.8374V8.21245ZM2.2499 4.24683H3.7124V4.83745C3.7124 5.17495 3.99365 5.48433 4.35928 5.48433C4.7249 5.48433 5.00615 5.20308 5.00615 4.83745V4.24683H13.0499V4.83745C13.0499 5.17495 13.3312 5.48433 13.6968 5.48433C14.0624 5.48433 14.3437 5.20308 14.3437 4.83745V4.24683H15.7499C16.0312 4.24683 16.2562 4.47183 16.2562 4.75308V6.94683H1.77178V4.75308C1.77178 4.47183 1.96865 4.24683 2.2499 4.24683ZM1.77178 14.5125V12.2343H4.1624V14.9906H2.2499C1.96865 15.0187 1.77178 14.7937 1.77178 14.5125ZM15.7499 15.0187H13.8374V12.2625H16.228V14.5406C16.2562 14.7937 16.0312 15.0187 15.7499 15.0187Z" fill="" />
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                            <li class="px-2">
                                <button type="button" class="flex items-center w-full p-2 text-base  transition duration-75 rounded-lg group  text-white hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example" id="dropdown-button">
                                    <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="currentColor" d="M96 0C43 0 0 43 0 96L0 416c0 53 43 96 96 96l288 0 32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64c17.7 0 32-14.3 32-32l0-320c0-17.7-14.3-32-32-32L384 0 96 0zm0 384l256 0 0 64L96 448c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16zm16 48l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                                    </svg>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Space</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                <ul id="dropdown-example" class="hidden py-2 space-y-2">
                                    <li>
                                        <form action="{{route('space.store')}}" method="POST">
                                            @csrf
                                            @method("POST")
                                            <button type="submit" class="flex gap-x-3 items-center w-full p-2  transition duration-75 rounded-lg pl-11 group  text-white hover:bg-gray-700">
                                                <span>Add Space</span>
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                    <path fill="currentColor" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </li>
                                    @foreach($spaces as $space)
                                    <li>
                                        <a href="{{ route('user.space.show', $space->id) }}" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-5 group text-white hover:bg-gray-700">
                                            <form action="{{ route('space.destroy', ['id' => $space->id]) }}" method="POST" class=" pr-5 flex items-center gap-x-3">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="">
                                                    <svg class="w-3 h-3 hover:text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                        <path fill="currentColor" d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <img class="w-5 h-5 mr-2 object-cover" src="{{ asset('storage/' .$space->image_url) }}" alt="{{ $space->title }}">

                                            {{ $space->title }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="px-2">
                                <form action="{{route('logout')}}" method="post" class="w-full">
                                    @csrf
                                    @method('POST')
                                    <button
                                        class="group w-full rounded-lg overflow-hidden hover:bg-gray-700 relative flex items-center gap-2.5 px-2 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:bg-meta-4"
                                        type="submit">
                                        <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                                        </svg>

                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </aside>
        @endif
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden bg-[#22272E]">
            <nav class="bg-[#22272E] w-full container mx-auto px-10 py-5 text-white border-b border-slate-600">

                <div class="text-md font-medium flex justify-between items-center">
                    <h1>Home / {{$detailSpace->title}}</h1>
                    @php
                    $iduser = Auth::user()->id;
                    $spaceid = request()->route('spaceId');
                    $host = request()->getHost();
                    $port = request()->getPort();
                    @endphp
                    <button id="copyButton" class="bg-slate-600 text-white flex gap-x-2 py-1 px-2 items-center rounded-md">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M307 34.8c-11.5 5.1-19 16.6-19 29.2l0 64-112 0C78.8 128 0 206.8 0 304C0 417.3 81.5 467.9 100.2 478.1c2.5 1.4 5.3 1.9 8.1 1.9c10.9 0 19.7-8.9 19.7-19.7c0-7.5-4.3-14.4-9.8-19.5C108.8 431.9 96 414.4 96 384c0-53 43-96 96-96l96 0 0 64c0 12.6 7.4 24.1 19 29.2s25 3 34.4-5.4l160-144c6.7-6.1 10.6-14.7 10.6-23.8s-3.8-17.7-10.6-23.8l-160-144c-9.4-8.5-22.9-10.6-34.4-5.4z" />
                        </svg>
                        <span>Share</span>
                    </button>
                    <script>
                        document.getElementById('copyButton').addEventListener('click', function() {
                            // Create a temporary input element
                            var tempInput = document.createElement('input');
                            // Set its value to the URL you want to copy
                            var userId = @json($iduser);
                            var spaceId = @json($spaceid);
                            var host = @json($host);
                            var port = @json($port);
                            var domain = (port != 80 && port != 443) ? host + ':' + port : host;
                            tempInput.value = 'http://' + domain + '/shared/' + spaceId + '/' + userId;
                            // Append it to the body
                            document.body.appendChild(tempInput);
                            // Select the text inside the input
                            tempInput.select();
                            // Copy the selected text
                            document.execCommand('copy');
                            // Remove the temporary input element
                            document.body.removeChild(tempInput);
                            // Optional: Show a message indicating the text was copied
                            alert('Text copied to clipboard: ' + tempInput.value);
                        });
                    </script>
                </div>
            </nav>
            <main class="h-full overflow-hidden">
                <div class="mx-auto h-full max-w-screen-2xl text-white flex flex-col relative">
                    <div class="px-10 flex gap-x-5 justify-between items-center py-5 border-b border-slate-500">
                        <div class="flex">
                            <img id="imagePreview" class="w-10 h-10 object-cover rounded-full cursor-pointer" src="{{ asset('storage/' . $detailSpace->image_url) }}" alt="{{ $detailSpace->title }}">
                            <!-- Form untuk meng-upload gambar -->
                            <form id="imageForm" action="{{ route('user.space.updateImage', ['id' => $detailSpace->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="file" id="imageInput" name="image" class="hidden">
                                <button type="submit" class="hidden">Submit</button>
                            </form>
                            <form action="{{ route('user.space.updateTitle', ['id' => $detailSpace->id]) }}" method="post">
                                @csrf
                                <input id="title" name="title" class="bg-[#22272E] focus:ring-transparent border-none text-xl font-bold w-full" type="text" value="{{ $detailSpace->title }}">
                                <button type="submit" class="hidden">Submit</button>
                            </form>
                        </div>
                        <form action="{{ route('user.space.updateGenre', ['id' => $detailSpace->id]) }}" method="post">
                            @csrf
                            <label for="genre" class="opacity-60">Jenis :</label>
                            <input id="genre" name="genre" class="bg-[#22272E] focus:ring-transparent border-none  opacity-60  w-fit text-left" type="text" value="{{ $detailSpace->genre }}">
                            <button type="submit" class="hidden">Submit</button>
                        </form>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const imagePreview = document.getElementById('imagePreview');
                            const imageInput = document.getElementById('imageInput');
                            const imageForm = document.getElementById('imageForm');

                            // Trigger file input click when image is clicked
                            imagePreview.addEventListener('click', function() {
                                imageInput.click();
                            });

                            // Handle file selection and auto-submit form
                            imageInput.addEventListener('change', function() {
                                if (this.files.length > 0) {
                                    imageForm.submit(); // Auto-submit the form when a file is selected
                                }
                            });
                        });
                    </script>
                    <div class="flex-1 flex overflow-hidden">
                        <div class="w-1/5 h-full overflow-auto border-r scrollbar-hide border-slate-500 pl-12 pt-10 relative">
                            @php
                            $spaceid = request()->route('spaceId');
                            @endphp
                            @foreach($pages as $page)
                            <div class="relative mb-2">
                                <div class="flex justify-between items-center group border-slate-500 hover:bg-[#2a3038]">
                                    <a href="{{ route('user.page.index', ['spaceId' => $spaceid, 'id' => $page->id]) }}" class="flex items-center  px-2 py-2 w-full   relative" style="padding-left: {{ $page->indentation * 20 }}px;">
                                        <p class="bg-[#22272E] px-2 border-0 p-0 focus:ring-transparent focus:border-none w-full group-hover:bg-[#2a3038]">{{$page->title}}</p>
                                    </a>
                                    <svg class="toggle-button w-3 h-3 pr-2 hidden group-hover:block cursor-pointer text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512" onclick="toggleDropdown(this)">
                                        <path fill="currentColor" d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z" />
                                    </svg>
                                </div>
                                <div class="dropdown-menu absolute right-0 z-0 top-full mt-2 w-fit rounded-md bg-slate-900 hidden">
                                    <form action="{{ route('page.addSubpage', ['id' => $page->id]) }}" method="POST" class="mt-2 px-2 py-2 flex items-center gap-x-3">
                                        @csrf
                                        @method('POST')
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                            <path fill="currentColor" d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM112 256l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                                        </svg>
                                        <button type="submit">Insert Subpage</button>
                                    </form>
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
                            @endforeach


                            <div class="w-full py-2 text-sm sticky bottom-0 bg-[#22272E] hover:bg-[#2a3038] group border-t border-slate-500">
                                <form action="{{ route('space.storeBlankPage', ['id' => $detailSpace->id]) }}" method="POST" class="inline w-full">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="px-2 py-3 h-fit flex gap-x-3 items-center text-white w-full group-hover:bg-[#2a3038] bg-[#22272E]">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="currentColor" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                                        </svg>
                                        <span>Add new page ...</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @if(Route::currentRouteName() == 'user.space.show')
                        <div class="flex justify-center w-4/5 h-full items-center">
                            <h1>Click page to edited</h1>
                        </div>
                        @else
                        @yield('content')
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.getElementById('dropdown-button');
            const dropdownMenu = document.getElementById('dropdown-example');

            dropdownButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });
        });
    </script>
    <script>
        function toggleDropdown(element) {
            const dropdown = element.closest('.relative').querySelector('.dropdown-menu');
            dropdown.classList.toggle('hidden');
        }

        // Close the dropdown if clicked outside
        document.addEventListener('click', function(event) {
            const isClickInside = event.target.closest('.relative');
            if (!isClickInside) {
                document.querySelectorAll('.dropdown-menu').forEach(function(dropdown) {
                    dropdown.classList.add('hidden');
                });
            }
        });
    </script>
    <script>
        function deletePage(pageId) {
            if (confirm('Are you sure you want to delete this page?')) {
                fetch(`/pages/${pageId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(response => {
                    if (response.ok) {
                        location.reload(); // or update the UI accordingly
                    } else {
                        alert('Failed to delete page.');
                    }
                });
            }
        }
    </script>


</body>

</html>