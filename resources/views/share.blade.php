@extends('layouts.shared')
@section('content')
<div class="w-full h-full">
    @if ($detailPage->page_cover !== null)
    <div class="w-full h-44 overflow-hidden">
        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $detailPage->page_cover)}}" alt="{{$detailPage->title}}">
    </div>
    @endif
    <div class="pb-10 pt-2">
        <h1 class="w-full text-4xl font-bold">{{$detailPage->title}}</h1>
        <p>{{$detailPage->description}} jano</p>
    </div>
    @foreach ($block as $item)
    @if ($item->content_type == 'paragraph')
    <div class="w-full h-full">
        <p class="text-justify">{{$item->content}}</p>
    </div>
    @elseif ($item->content_type == 'image')
    <div class="w-full mx-auto mt-10 flex justify-center">
        <img class="w-1/4 object-cover mb-4" src="{{ asset('storage/' . $item->content) }}" alt="{{ $item->content }}">
    </div>
    @elseif ($item->content_type == 'heading1')
    <div class="w-full h-full">
        <h1 class="text-3xl font-bold ">{{$item->content}}</h1>
    </div>
    @elseif ($item->content_type == 'heading2')
    <div class="w-full h-full">
        <h2 class="text-2xl font-bold">{{$item->content}}</h2>
    </div>
    @elseif ($item->content_type == 'heading3')
    <div class="w-full h-full">
        <h3 class="text-xl font-bold">{{$item->content}}</h3>
    </div>
    @elseif ($item->content_type == 'unorderedlist')
    <div class="w-full h-full">
        <ul class="pl-10">
            <li class="list-disc">{{$item->content}}</li>
        </ul>
        @endif
        @endforeach
    </div>
</div>
@php
$spaceId = request()->route('spaceId');
$userId = request()->route('userId');
@endphp
<div class="pt-10 pb-5 text-white">
    <div class="flex gap-x-10 px-20">
        @if($previousPage)
        <a href="{{ route('share.page.show', ['spaceId' => $spaceId, 'id' => $previousPage->id , 'userId' => $userId]) }}" class="w-full h-full">
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
        <a href="{{ route('share.page.show', ['spaceId' => $spaceId, 'id' => $nextPage->id , 'userId' => $userId]) }}" class="w-full h-full">
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
@endsection