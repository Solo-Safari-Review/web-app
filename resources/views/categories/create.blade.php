@extends('layouts.base')

@section('main')
<form id="create-form" action="{{ route('categories.store') }}" method="POST" class="w-full max-w-5xl mx-auto h-full flex flex-col justify-center gap-4 mt-24 mb-24 xl:mt-0 xl:mb-0 px-4 xl:px-0">
    @csrf
    <h1 class="font-bold text-[28px]">Buat Kategori</h1>
    <h2 class="text-lg">Detail Kategori</h2>
    <table class="text-left">
        <thead class="bg-[#907B60] text-white">
            <tr>
                <th class="px-6 py-3">Item</th>
                <th class="px-6 py-3">Keterangan</th>
            </tr>
        </thead>
        <tbody class="bg-[#E9D9C7]">
            <tr>
                <th class="px-6 py-3">Nama Kategori</th>
                <td class="px-6 py-3">
                    <input type="text" name="name" id="name" class="bg-[#E9D9C7] border-0 border-b border-[#907B60] px-4 py-2 focus:ring-0 w-full" autofocus>
                    @error('name')
                    <span class="text-red-500 text-sm px-4">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th class="px-6 py-3">Departemen</th>
                <td class="px-6 py-3">
                    <select name="department" class="border-0 border-b border-[#907B60] focus:ring-0 w-full">
                        @foreach ($departments as $department)
                            <option value="{{ \App\Helpers\HashidsHelper::encode($department->id) }}">{{ $department->name }}</option>
                        @endforeach
                </select>
                    @error('department')
                    <span class="text-red-500 text-sm px-4">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th class="px-6 py-3">Keterangan<br>(opsional)</th>
                <td class="px-6 py-3">
                    <input type="text" name="description" id="description" class="bg-[#E9D9C7] border-0 border-b border-[#907B60] px-4 py-2 focus:ring-0 w-full">
                </td>
            </tr>
        </tbody>
    </table>
    <div class="flex justify-center w-full">
        <button type="button" class="bg-[#4E1F00] text-white px-4 py-2 rounded-lg min-w-[324px] hover:bg-[#4E1F00]/80" onclick="confirm('create-form', 'Buat Kategori', 'Apakah Anda yakin data kategori sudah sesuai?')">Buat Kategori Baru</button>
    </div>
</form>
@endsection
