@extends('layouts.admin')
@section('content')
<div class="px-10">
    <h1 class="text-2xl font-bold text-white">All Article</h1>
    <div class="grid grid-cols-4 gap-x-4 gap-y-5 px-4 py-5 h-full">
        @foreach($spaces as $item)
        <a href="{{route('share', ['spaceId' => $item->id, 'userId' => $item->user_id])}}" class="border bg-slate-500 border-slate-800 w-full h-44 rounded-lg overflow-hidden">
            <div class="w-full h-32">
                <img class="w-full h-full object-cover" src="{{ asset('storage/' .$item->image_url) }}" alt="{{ $item->title }}">
            </div>
            <h1 class="py-3 px-2 text-sm font-medium">{{ $item->title }}</h1>
            <p class="pt-3 px-2 text-sm font-medium">{{$item->genre}}</p>
        </a>
        @endforeach
    </div>
</div>
@endsection