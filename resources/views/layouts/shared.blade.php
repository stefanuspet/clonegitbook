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
                    @if (Auth::check())
                    <a href="{{route('admin.dashboard')}}" class="pb-10 flex gap-x-3">
                        <svg
                            fill="currentColor"
                            class="w-6 h-6"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                        </svg>
                        Back To Dashboard
                    </a>

                    @endif
                    <!-- Menu Group -->
                    <div class="w-44">
                        @php
                        //get path spaceId
                        $spaceId = request()->route('spaceId');
                        $userId = request()->route('userId');
                        @endphp
                        <ul class="mb-1 flex flex-col gap-1.5">
                            @foreach ($pages as $page)
                            <li class="px-2">
                                <a href="{{route('share.page.show', ['spaceId' => $spaceId, 'userId' => $userId, 'id' => $page->id])}}" class="group relative rounded-lg flex items-center gap-2.5 hover:bg-gray-700 px-2 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:bg-meta-4">
                                    {{ $page->title }}
                                </a>
                            </li>
                            @if ($page->subpages->isNotEmpty())
                            @foreach ($page->subpages as $subpage)
                            @include('components.nav-page', ['page' => $subpage])
                            @endforeach
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </nav>
            </div>
        </aside>
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden scrollbar-hide bg-slate-700">
            <main>
                <div class="mx-auto max-w-screen-2xl px-16 py-5 text-white">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

</body>

</html>