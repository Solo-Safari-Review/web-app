@extends('layouts.base')

@section('left-sidebar')

@endsection

@section('main')
<div class="flex flex-wrap gap-8 w-full align-middle justify-center">
    <x-card-category label="Toilet" number="150"></x-card-category>
    <x-card-category label="Keamanan & Kebersihan" number="87"></x-card-category>
    <x-card-category label="Area Parkir" number="25"></x-card-category>
    <x-card-category label="Hewan" number="7"></x-card-category>
    <x-card-category label="Pegawai" number="5"></x-card-category>
</div>
@endsection

@section('footer')

@endsection
