<div class="flex gap-1 items-center">
    <input type="checkbox" id='select-all' class="w-[18px] h-[18px] me-4 text-[#907B60] bg-gray-100 border-gray-300 focus:ring-[#907B60]">
    <span>Pilih semua</span>
</div>
<button type="button" id="delete-selected-all" class="text-center px-6 py-1 rounded-lg bg-[#FFE4B7] border-1 border-gray-300">Hapus {{ $item }} Terpilih</button>
<x-confirm-delete item="{{ $item }}"></x-confirm-delete>

@push('scripts')
<script>
    $(function () {
        $('#select-all').click(function () {
            if ($(this).is(':checked')) {
                $('input[type="checkbox"]').prop('checked', true);
            } else {
                $('input[type="checkbox"]').prop('checked', false);
            }
        });

        $('#delete-selected-all').click(function () {
            if ($('input[type="checkbox"]:checked').length > 0) {
                return $('#confirm-delete').show();
            } else {
                return false;
            }
        });
    });
</script>
@endpush
