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
</head>

<body class="font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
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
                    class="mt-5 px-4 py-4 lg:mt-9 lg:px-6"
                    x-data="{selected: $persist('Dashboard')}">
                    <!-- Menu Group -->
                    <div class="w-44">
                        <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">MENU</h3>

                        <ul class="mb-6 flex flex-col gap-1.5">
                            <!-- Menu Item Calendar -->
                            <li class="px-2">
                                <a class="group relative rounded-lg flex items-center gap-2.5 hover:bg-gray-700 px-2 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:bg-meta-4"
                                    href="{{ route('users.dashboard') }}"
                                    @click="selected = (selected === 'Calendar' ? '' : 'Calendar')"
                                    :class="{ 'bg-graydark bg-meta-4': (selected === 'Calendar') && (page === 'calendar') }">
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.7499 2.9812H14.2874V2.36245C14.2874 2.02495 14.0062 1.71558 13.6405 1.71558C13.2749 1.71558 12.9937 1.99683 12.9937 2.36245V2.9812H4.97803V2.36245C4.97803 2.02495 4.69678 1.71558 4.33115 1.71558C3.96553 1.71558 3.68428 1.99683 3.68428 2.36245V2.9812H2.2499C1.29365 2.9812 0.478027 3.7687 0.478027 4.75308V14.5406C0.478027 15.4968 1.26553 16.3125 2.2499 16.3125H15.7499C16.7062 16.3125 17.5218 15.525 17.5218 14.5406V4.72495C17.5218 3.7687 16.7062 2.9812 15.7499 2.9812ZM1.77178 8.21245H4.1624V10.9968H1.77178V8.21245ZM5.42803 8.21245H8.38115V10.9968H5.42803V8.21245ZM8.38115 12.2625V15.0187H5.42803V12.2625H8.38115ZM9.64678 12.2625H12.5999V15.0187H9.64678V12.2625ZM9.64678 10.9968V8.21245H12.5999V10.9968H9.64678ZM13.8374 8.21245H16.228V10.9968H13.8374V8.21245ZM2.2499 4.24683H3.7124V4.83745C3.7124 5.17495 3.99365 5.48433 4.35928 5.48433C4.7249 5.48433 5.00615 5.20308 5.00615 4.83745V4.24683H13.0499V4.83745C13.0499 5.17495 13.3312 5.48433 13.6968 5.48433C14.0624 5.48433 14.3437 5.20308 14.3437 4.83745V4.24683H15.7499C16.0312 4.24683 16.2562 4.47183 16.2562 4.75308V6.94683H1.77178V4.75308C1.77178 4.47183 1.96865 4.24683 2.2499 4.24683ZM1.77178 14.5125V12.2343H4.1624V14.9906H2.2499C1.96865 15.0187 1.77178 14.7937 1.77178 14.5125ZM15.7499 15.0187H13.8374V12.2625H16.228V14.5406C16.2562 14.7937 16.0312 15.0187 15.7499 15.0187Z" fill="" />
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                            <!-- Menu Item Calendar -->

                            <!-- Menu Item Profile -->
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
                                    @endforeach
                                </ul>
                            </li>
                            <li class="px-2">
                                <form action="{{route('logout')}}" method="post" class="w-full">
                                    @csrf
                                    @method('POST')
                                    <button
                                        class="group w-full rounded-lg overflow-hidden hover:bg-gray-700 relative flex items-center gap-2.5 px-2 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:bg-meta-4"
                                        type="submit"
                                        @click="selected = (selected === 'Calendar' ? '':'Calendar')"
                                        :class="{ 'bg-graydark bg-meta-4': (selected === 'Calendar') && (page === 'calendar') }">
                                        <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
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
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden bg-[#22272E]">
            <nav class="bg-[#22272E] w-full container mx-auto px-10 py-5 text-white border-b border-slate-600">
                <div class="text-md font-medium flex justify-between items-center">
                    <h1>Home</h1>
                </div>
            </nav>
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10 text-white">
                    <h1 class="text-2xl font-bold">My Article</h1>
                    <div class="grid grid-cols-4 gap-x-4 gap-y-5 px-4 py-5 h-full">
                        @foreach($spaces as $item)
                        <a href="{{route('share', ['spaceId' => $item->id, 'userId' => $item->user_id])}}" class="border bg-slate-500 border-slate-800 w-full h-52 rounded-lg overflow-hidden">
                            <div class="w-full h-32">
                                <img class="w-full h-full object-cover" src="{{ asset('storage/' .$item->image_url) }}" alt="{{ $item->title }}">
                            </div>
                            <h1 class="pt-3 px-2 text-lg font-medium">{{ $item->title }}</h1>
                            <p class="pt-3 px-2 text-sm font-medium">{{$item->genre}}</p>
                        </a>
                        @endforeach
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

</body>

</html>