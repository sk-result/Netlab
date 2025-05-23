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

 <script>
     document.querySelectorAll('.swal-confirm').forEach(button => {
         button.addEventListener('click', function() {
             const categoryId = this.getAttribute('data-id');
             const categoryName = this.getAttribute('data-name');

             Swal.fire({
                 title: `Hapus kategori "${categoryName}"?`,
                 text: "Tindakan ini tidak dapat dibatalkan!",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#d33',
                 cancelButtonColor: '#3085d6',
                 confirmButtonText: 'Ya, hapus!',
                 cancelButtonText: 'Batal'
             }).then((result) => {
                 if (result.isConfirmed) {
                     document.getElementById(`delete-form-${categoryId}`).submit();
                 }
             });
         });
     });
 </script>

 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const openBtn = document.getElementById('btnOpenModal');
         const backdrop = document.getElementById('custom-backdrop');
         const modalEl = document.getElementById('modalTambahKategori');
         const modal = new bootstrap.Modal(modalEl, {
             backdrop: false
         });

         openBtn.addEventListener('click', (e) => {
             e.preventDefault(); // cegah default behavior tombol lama
             backdrop.style.display = 'block';
             setTimeout(() => backdrop.classList.add('show'), 10);
             modal.show();
         });

         modalEl.addEventListener('hidden.bs.modal', () => {
             backdrop.classList.remove('show');
             setTimeout(() => {
                 backdrop.style.display = 'none';
             }, 300);
         });

         const updateModalEl = document.getElementById('modalUpdateKategori');
         const updateModal = new bootstrap.Modal(updateModalEl, {
             backdrop: false
         });

         const updateForm = document.getElementById('formUpdateKategori');
         const updateInput = document.getElementById('update_name');

         document.querySelectorAll('.btn-edit').forEach(button => {
             button.addEventListener('click', function() {
                 const id = this.dataset.id;
                 const name = this.dataset.name;

                 updateInput.value = name;
                 
                 updateForm.action = `/admin/category/procesUpdate/${id}`; // sesuaikan route

                 backdrop.style.display = 'block';
                 setTimeout(() => {
                     backdrop.classList.add('show');
                 }, 10);

                 updateModal.show();
             });
         });

         updateModalEl.addEventListener('hidden.bs.modal', () => {
             backdrop.classList.remove('show');
             setTimeout(() => {
                 backdrop.style.display = 'none';
             }, 300);
         });
     });
 </script>
