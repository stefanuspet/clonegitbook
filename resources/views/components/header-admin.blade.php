<div class="bg-[#22272E] py-5 px-10 border-b border-slate-600 sticky top-0 z-50">
    @php
    $path = request()->path();
    @endphp
    <h1 class="text-lg text-white">
        @if ($path == 'admin-dashboard')
        Dashboard /
        @elseif ($path == 'admin-alluser')
        Dashboard / Users
        @elseif ($path == 'admin-profile')
        Dashboard / Profile
        @elseif ($path == 'admin-jenis')
        Dashboard / Jenis-artikel
        @endif
    </h1>
</div>