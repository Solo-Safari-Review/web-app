@extends('layouts.base')

@section('main')
<div class="flex flex-col gap-8 px-8 py-8 w-full">
    <x-search-bar></x-search-bar>

    @if (Auth::user()->hasRole('Admin Review'))
        @include('reviews.edit-admin-review')
    @elseif (Auth::user()->hasRole('Admin Departemen'))
        @include('reviews.edit-admin-department')
    @endif

</div>
@endsection
