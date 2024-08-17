<li class="px-2" style="padding-left: {{ $page->indentation * 20 }}px;">
    <a href="{{route('share.page.show', ['spaceId' => $spaceId, 'userId' => $userId, 'id' => $page->id])}}" class="group relative rounded-lg flex items-center gap-2.5 hover:bg-gray-700 px-2 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:bg-meta-4">
        {{ $page->title }}
    </a>
</li>
@if ($page->subpages->isNotEmpty())
@foreach ($page->subpages as $subpage)
@include('components.nav-page', ['page' => $subpage])
@endforeach
@endif