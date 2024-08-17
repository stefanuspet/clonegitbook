@extends('layouts.admin')
@section('content')
<div class="px-10">
    <h1 class="text-2xl font-bold text-white">All Article</h1>
    <div class="relative overflow-x-auto py-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-center">
                    <th scope="col" class="px-6 py-3">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jenis Artikel
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jumlah Artikel
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($genresCount as $space )
                <tr class="bg-white text-center border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$loop->iteration}}
                    </th>
                    <td class="px-6 py-4">
                        {{$space->genre}}
                    </td>
                    <td class="px-6 py-4">
                        {{$space->total}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection