<script src="{{ asset('assets-admin/js/core/jquery-3.7.1.min.js') }}"></script>
{{-- <script src="{{ asset('assets-admin/js/core/popper.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets-admin/js/core/bootstrap.min.js') }}"></script> --}}

<!-- jQuery Scrollbar -->
<script src="{{ asset('assets-admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('assets-admin/js/plugin/datatables/datatables.min.js') }}"></script>

<!-- Kaiadmin JS -->
<script src="{{ asset('assets-admin/js/kaiadmin.min.js') }}"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="{{ asset('assets-admin/js/setting-demo2.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('assets-admin/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('assets-admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ asset('assets-admin/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('assets-admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset('assets-admin/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ asset('assets-admin/js/plugin/jsvectormap/world.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('assets-admin/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="{{ asset('assets-admin/js/setting-demo.js') }}"></script>
<script src="{{ asset('assets-admin/js/demo.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- SWEET ALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif
{{-- SWEET ALERT --}}


<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editorElement = document.querySelector('#editor');
        if (editorElement) {
            initEditor();
        }

        const dropdown = document.getElementById('pageDropdown');

        new Choices(dropdown, {
            placeholder: false,
            placeholderValue: '-- Pilih Halaman --',
            searchEnabled: false,
            itemSelectText: '',
            shouldSort: false
        });

        const mainPanel = document.querySelector('.main-panel');
        if (mainPanel) mainPanel.classList.add('loaded');

    });

    // Saat dokumen siap
    $(document).ready(function() {
        $('#pageDropdown').on('change', function() {
            const url = $(this).val();
            if (url) {
                $('.main-panel').html('<div class="text-center my-5">Loading...</div>');
                window.history.pushState({}, '', url);
   

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('.main-panel').html(data);

                        console.log("✅ Konten berhasil dimuat:", url);
                        setTimeout(() => {
                            if (typeof initModalsAndBackdrop === 'function') {
                                console.log(
                                    '🔁 Panggil ulang initModalsAndBackdrop');
                                initModalsAndBackdrop();
                            }
                        }, 1);
                        initEditor();

                        if (typeof initCategoryModals === 'function') initCategoryModals();

                        if (url.includes('dashboard')) {
                            if (typeof initDashboard === 'function') initDashboard();
                            if (typeof initSparkline === 'function') initSparkline();
                        }
                        // console.log($('.main-panel').html());

                    },
                    error: function() {
                        $('.main-panel').empty().html(
                            '<div class="text-danger">Gagal memuat konten.</div>');
                    }
                });
            }
        });

        // Inisialisasi awal
        if (document.getElementById('statisticsChart') && typeof initDashboard === 'function') {
            initDashboard();
        }

        // Panggil sekali saat load awal
        initModalsAndBackdrop();
    });
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    let modalTambahMatkulInstance = null;
    let modalUpdateMatkulInstance = null;

    let modalTambahUmumInstance = null;
    let modalUpdateUmumInstance = null;

    let modalTambahDokumentasiInstance = null;
    let modalUpdateDokumentasiInstance = null;

    let modalTambahEquipmentInstance = null;
    let modalUpdateEquipmentInstance = null;

    function initModalsAndBackdrop() {
        // console.log('🔧 initModalsAndBackdrop dipanggil');
        // console.log('Inisialisasi modal dipanggil');


        const modalTambahMatkul = document.getElementById('modalTambahKategoriMatkul');
        const modalUpdateMatkul = document.getElementById('modalUpdateKategoriMatkul');
        const formUpdateMatkul = document.getElementById('formUpdateKategoriMatkul');
        const inputUpdateMatkul = document.querySelector('#modalUpdateKategoriMatkul #update_name');

        const modalTambahUmum = document.getElementById('modalTambahKategori');
        const modalUpdateUmum = document.getElementById('modalUpdateKategori');
        const formUpdateUmum = document.getElementById('formUpdateKategori');
        const inputUpdateUmum = document.querySelector('#modalUpdateKategori #update_name');

        const modalTambahDokumentasi = document.getElementById('modalTambahKategoriDokumentasi');
        const modalUpdateDokumentasi = document.getElementById('modalUpdateKategoriDokumentasi');
        const formUpdateDokumentasi = document.getElementById('formUpdateKategoriDokumentasi');
        const inputUpdateDokumentasi = document.querySelector('#modalUpdateKategoriDokumentasi #update_name');

        const modalTambahEquipment = document.getElementById('modalTambahEquipment');
        // console.log('modalTambahEquipment:', modalTambahEquipment);
        const modalUpdateEquipment = document.getElementById('modalUpdateEquipment');
        const formUpdateEquipment = document.getElementById('formUpdateEquipment');
        const inputUpdateNameEquipment = document.querySelector('#modalUpdateEquipment #update_name');
        const inputUpdateDeskripsiEquipment = document.querySelector('#modalUpdateEquipment #update_description');

        if (modalTambahMatkul) modalTambahMatkulInstance = new bootstrap.Modal(modalTambahMatkul, {
            backdrop: false
        });
        if (modalUpdateMatkul) modalUpdateMatkulInstance = new bootstrap.Modal(modalUpdateMatkul, {
            backdrop: false
        });

        if (modalTambahUmum) modalTambahUmumInstance = new bootstrap.Modal(modalTambahUmum, {
            backdrop: false
        });
        if (modalUpdateUmum) modalUpdateUmumInstance = new bootstrap.Modal(modalUpdateUmum, {
            backdrop: false
        });

        if (modalTambahDokumentasi) modalTambahDokumentasiInstance = new bootstrap.Modal(modalTambahDokumentasi, {
            backdrop: false
        });
        if (modalUpdateDokumentasi) modalUpdateDokumentasiInstance = new bootstrap.Modal(modalUpdateDokumentasi, {
            backdrop: false
        });

        if (modalTambahEquipment) modalTambahEquipmentInstance = new bootstrap.Modal(modalTambahEquipment, {
            backdrop: false
        });
        if (modalUpdateEquipment) modalUpdateEquipmentInstance = new bootstrap.Modal(modalUpdateEquipment, {
            backdrop: false
        });

        // Pasang event delegation satu kali saja
        // if (!initModalsAndBackdrop.eventListenerAdded) {
        document.addEventListener('click', function(e) {
            // Tambah kategori umum
            if (e.target.closest('#btnOpenModalKategori')) {
                e.preventDefault();
                if (modalTambahUmumInstance) modalTambahUmumInstance.show();
                return;
            }

            // Tambah kategori matkul
            if (e.target.closest('#btnOpenModalMatkul')) {
                e.preventDefault();
                if (modalTambahMatkulInstance) modalTambahMatkulInstance.show();
                return;
            }

            // Tambah kategori dokumentasi
            if (e.target.closest('#btnOpenModalKategoriDokumentasi')) {
                e.preventDefault();
                if (modalTambahDokumentasiInstance) modalTambahDokumentasiInstance.show();
                return;
            }

            // Tambah equipment
            if (e.target.closest('#btnOpenModalEquipment')) {
                e.preventDefault();
                if (modalTambahEquipmentInstance) modalTambahEquipmentInstance.show();
                return;
            }

            // Tombol edit
            const editBtn = e.target.closest('.btn-edit');
            if (editBtn) {
                e.preventDefault();
                const id = editBtn.dataset.id;
                const name = editBtn.dataset.name.trim();
                const type = editBtn.dataset.type;

                switch (type) {
                    case 'matkul':
                        inputUpdateMatkul.value = name;
                        formUpdateMatkul.action = `/admin/categoryMatkul/update/${id}`;
                        modalUpdateMatkulInstance.show();
                        break;
                    case 'umum':
                        inputUpdateUmum.value = name;
                        formUpdateUmum.action = `/admin/category/update/${id}`;
                        modalUpdateUmumInstance.show();
                        break;
                    case 'dokumentasi':
                        inputUpdateDokumentasi.value = name;
                        formUpdateDokumentasi.action = `/admin/categoryDokumentasi/update/${id}`;
                        modalUpdateDokumentasiInstance.show();
                        break;
                    case 'equipment':
                        inputUpdateNameEquipment.value = name;
                        inputUpdateDeskripsiEquipment.value = editBtn.dataset.description;
                        formUpdateEquipment.action = `/admin/equipment/update/${id}`;
                        modalUpdateEquipmentInstance.show();
                        break;
                }
                return;
            }

            // console.log(document.querySelectorAll('.btn-edit'));
            // Tombol hapus
            const deleteBtn = e.target.closest('.swal-confirm');
            if (deleteBtn) {
                e.preventDefault();
                const id = deleteBtn.dataset.id;
                const name = deleteBtn.dataset.name;

                Swal.fire({
                    title: `Yakin ingin menghapus kategori "${name}"?`,
                    text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById(`delete-form-${id}`);
                        if (form) form.submit();
                    }
                });
                return;
            }
        });

        // initModalsAndBackdrop.eventListenerAdded = true;
    }
    // }


    document.addEventListener('DOMContentLoaded', () => {
        initModalsAndBackdrop();
    });
</script>


@yield('script')
