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
                <td class="px-6 py-3">
                    <input type="text" name="name" id="name" class="bg-[#E9D9C7] border-0 border-b border-[#907B60] px-4 py-2 focus:ring-0 w-full" value="{{ $topic->name }}" autofocus>
                    @error('name')
                    <span class="text-red-500 text-sm px-4">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th class="px-6 py-3">Kategori</th>
                <td class="px-6 py-3">
                    <select name="category" class="border-0 border-b border-[#907B60] focus:ring-0 w-full">
                        @foreach ($categories as $category)
                            <option value="{{ \App\Helpers\HashidsHelper::encode($category->id) }}" {{ $category->id == $topic->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <span class="text-red-500 text-sm px-4">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th class="px-6 py-3">Keterangan<br>(opsional)</th>
                <td class="px-6 py-3">
                    <input type="text" name="description" id="description" class="bg-[#E9D9C7] border-0 border-b border-[#907B60] px-4 py-2 focus:ring-0 w-full" value="{{ $topic->description }}">
                </td>
            </tr>
        </tbody>
    </table>
    <div class="flex justify-center w-full">
        <button type="button" class="bg-[#4E1F00] text-white px-4 py-2 rounded-lg min-w-[324px] hover:bg-[#4E1F00]/80" onclick="confirm('edit-form', 'Ubah Topik', 'Apakah Anda yakin untuk mengubah data topik ini?')">Ubah</button>
    </div>
</form>
@endsection
