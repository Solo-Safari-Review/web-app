@extends('layouts.base')

@section('main')
<form id="edit-form" action="{{ route('topics.update', \App\Helpers\HashidsHelper::encode($topic->id)) }}" method="POST" class="w-full max-w-5xl mx-auto h-full flex flex-col justify-center gap-4 mt-24 mb-24 xl:mt-0 xl:mb-0 px-4 xl:px-0">
    @csrf
    @method('PUT')
    <h1 class="font-bold text-[28px]">Edit Topik</h1>
    <h2 class="text-lg">Detail Topik</h2>
    <table class="text-left">
        <thead class="bg-[#907B60] text-white">
            <tr>
                <th class="px-6 py-3">Item</th>
                <th class="px-6 py-3">Keterangan</th>
            </tr>
        </thead>
        <tbody class="bg-[#E9D9C7]">
            <tr>
                <th class="px-6 py-3">Nama Topik</th>
                <td class="px-6 py-3">{{ $topic->name }}</td>
            </tr>
            <tr>
                <th class="px-6 py-3">Kategori</th>
                <td class="px-6 py-3"></td>
            </tr>
            <tr>
                <th class="px-6 py-3">Keterangan</th>
                <td class="px-6 py-3"></td>
            </tr>
        </tbody>
    </table>
    <div class="flex justify-center w-full">
        <button type="button" class="bg-[#4E1F00] text-white px-4 py-2 rounded-lg min-w-[324px] hover:bg-[#4E1F00]/80" onclick="confirm('edit-form', 'Ubah Topik', 'Apakah Anda yakin untuk mengubah data topik ini?')">Ubah</button>
    </div>
</form>
@endsection
