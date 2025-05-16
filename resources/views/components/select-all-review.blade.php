@if ($item == "confirmAccounts")
<div class="flex gap-1 items-center text-sm">
    <input type="checkbox" id='select-all-review' class="w-[18px] h-[18px] me-2 text-[#907B60] bg-gray-100 border-gray-300 focus:ring-[#907B60]">
    <span>Pilih semua</span>
</div>
<button type="button" id="confirm-selected-all" class="text-center text-sm px-6 py-1 rounded-lg bg-[#FFE4B7] border-1 border-gray-300">
    Konfirmasi Akun
</button>
<button type="button" id="delete-selected-all" class="text-center text-sm px-6 py-1 rounded-lg bg-[#FF8080] text-white border-1 border-gray-300">
    Hapus Akun
</button>
@push('scripts')
<script>
    $(function () {
        $('#select-all-review').click(function () {
            if ($(this).is(':checked')) {
                $('input[type="checkbox"]').prop('checked', true);
            } else {
                $('input[type="checkbox"]').prop('checked', false);
            }
        });

        $('#delete-selected-all').click(function () {
            if ($('input[type="checkbox"]:checked').length > 0) {
                const existingMethodInput = $('#selected-form').find('input[name="_method"]');
                if (existingMethodInput) {
                    existingMethodInput.remove();
                }

                const methodInput = document.createElement('input');
                methodInput.setAttribute('type', 'hidden');
                methodInput.setAttribute('name', '_method');
                methodInput.setAttribute('value', 'DELETE');

                $('#selected-form').attr('action', "{{ route('confirm-accounts.destroy-some') }}").append(methodInput);

                return confirmDelete('selected-form', 'Hapus Akun', 'Apakah anda yakin ingin menghapus seluruh akun yang dipilih?');
            } else {
                return false;
            }
        });
        $('#confirm-selected-all').click(function () {
            if ($('input[type="checkbox"]:checked').length > 0) {
                const existingMethodInput = $('#selected-form').find('input[name="_method"]');
                if (existingMethodInput) {
                    existingMethodInput.remove();
                }

                const methodInput = document.createElement('input');
                methodInput.setAttribute('type', 'hidden');
                methodInput.setAttribute('name', '_method');
                methodInput.setAttribute('value', 'PUT');

                $('#selected-form').attr('action', "{{ route('confirm-accounts.confirm-some') }}").append(methodInput);

                return confirm('selected-form', 'Konfirmasi Akun', 'Apakah anda yakin ingin mengkonfirmasi seluruh akun yang dipilih?');
            } else {
                return false;
            }
        });
    });
</script>
@endpush

@else
<div class="flex gap-1 items-center text-sm">
    <input type="checkbox" id='select-all-review' class="w-[18px] h-[18px] me-4 text-[#907B60] bg-gray-100 border-gray-300 focus:ring-[#907B60]">
    <span>Pilih semua</span>
</div>
<button type="button" id="delete-selected-all" class="text-center text-sm px-6 py-1 rounded-lg bg-[#FFE4B7] border-1 border-gray-300">
    @if ($item == "Sampah")
    Hapus Selamanya
    @else
    Hapus {{ $item }} Terpilih
    @endif
</button>

@push('scripts')
<script>
    $(function () {
        $('#select-all-review').click(function () {
            if ($(this).is(':checked')) {
                $('input[type="checkbox"]').prop('checked', true);
            } else {
                $('input[type="checkbox"]').prop('checked', false);
            }
        });

        $('#delete-selected-all').click(function () {
            if ($('input[type="checkbox"]:checked').length > 0) {
                return confirmDeleteReview('deleteSomeForm');
            } else {
                return false;
            }
        });
    });
</script>
@endpush
@endif

