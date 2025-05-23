<script src="{{ asset('assets-admin/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets-admin/js/core/popper.min.js') }}"></script>
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

        // Event saat dropdown berubah
        $('#pageDropdown').on('change', function() {
            const url = $(this).val();
            if (url) {
                // Hapus backdrop dan modal hide, karena backdrop dihapus
                // Jadi langsung load konten baru
                $('.main-panel').html('<div class="text-center my-5">Loading...</div>');
                window.history.pushState({}, '', url);

                // Load konten via AJAX
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('.main-panel').html(data);

                        // Inisialisasi modal atau fungsi lain jika ada
                        if (typeof initModalsAndBackdrop === 'function')
                            initModalsAndBackdrop();
                        if (typeof initCategoryModals === 'function') initCategoryModals();

                        if (url.includes('dashboard')) {
                            if (typeof initDashboard === 'function') initDashboard();
                            if (typeof initSparkline === 'function') initSparkline();
                        }
                    },
                    error: function() {
                        $('.main-panel').html(
                            '<div class="text-danger">Gagal memuat konten.</div>');
                    }
                });
            }
        });

        // Jika pertama load dan ada grafik, inisialisasi langsung
        if (document.getElementById('statisticsChart') && typeof initDashboard === 'function') {
            initDashboard();
        }
    });
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@yield('script')
