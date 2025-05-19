@extends('layouts.base')

@section('main')
<div class="flex flex-col gap-8 px-8 py-8 w-full">
    <x-search-bar></x-search-bar>

    <div class="flex flex-col gap-4 w-full">
        <span class="grow px-2 py-1 text-2xl font-semibold w-full">Daftar Departemen</span>
        <div class="flex flex-col w-full gap-2 py-2">
            @foreach ($departments as $department)
                <x-items.department-reviews-item :department="$department"></x-items.department-reviews-item>
            @endforeach
            {{ $departments->links() }}
        </div>
    </div>
</div>
@endsection
