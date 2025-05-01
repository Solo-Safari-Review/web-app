@extends('layouts.base')

@section('left-sidebar')

@endsection

@section('main')
<div class="flex flex-wrap gap-8 w-full items-center justify-center">
    <x-card-category label="Toilet" number="150"></x-card-category>
    <x-card-category label="Keamanan & Kebersihan" number="87"></x-card-category>
    <x-card-category label="Area Parkir" number="25"></x-card-category>
    <x-card-category label="Hewan" number="7"></x-card-category>
    <x-card-category label="Pegawai" number="5"></x-card-category>
    <x-action-button></x-action-button>
    <div class="flex flex-col gap-2">
        <div class="flex">
            <x-badge-status-review status="Belum diteruskan"></x-badge-status-review>
            <x-badge-status-review status="Sudah diteruskan"></x-badge-status-review>
        </div>
        <div class="flex">
            <x-badge-action-review status="Belum dikerjakan"></x-badge-action-review>
            <x-badge-action-review status="Dalam proses"></x-badge-action-review>
            <x-badge-action-review status="Selesai"></x-badge-action-review>
        </div>
        <div class="flex">
            <x-badge-answer-status status="Belum dijawab"></x-badge-answer-status>
            <x-badge-answer-status status="Sudah dijawab"></x-badge-answer-status>
        </div>
    </div>
</div>
@endsection

@section('footer')

@endsection
