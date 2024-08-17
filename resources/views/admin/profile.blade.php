@extends('layouts.admin')
@section('content')
<div class="px-10">
    <h1 class="text-2xl font-bold text-white">Profile Admin</h1>
    <div class="p-4 sm:p-8 mt-5 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>
    <div class="p-4 sm:p-8 mt-5 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>
</div>
@endsection