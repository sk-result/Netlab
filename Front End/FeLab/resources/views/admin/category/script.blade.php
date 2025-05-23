<script>
    let modalEventBound = false;

    function initModalsAndBackdrop() {
        const modalTambahEl = document.getElementById('modalTambahKategori');
        const updateModalEl = document.getElementById('modalUpdateKategori');

        if (!modalTambahEl || !updateModalEl) return;

        const modalTambah = new bootstrap.Modal(modalTambahEl, {
            backdrop: false // tetap tanpa backdrop Bootstrap
        });
        const updateModal = new bootstrap.Modal(updateModalEl, {
            backdrop: false
        });


        const updateForm = document.getElementById('formUpdateKategori');
        const updateInput = document.getElementById('update_name');

        if (!modalEventBound) {
            document.addEventListener('click', function handler(e) {
                const openBtn = e.target.closest('#btnOpenModal');
                if (openBtn) {
                    e.preventDefault();
                    modalTambah.show();
                    return;
                }

                const editBtn = e.target.closest('.btn-edit');
                if (editBtn) {
                    const id = editBtn.dataset.id;
                    const name = editBtn.dataset.name;

                    updateInput.value = name;
                    updateForm.action = `/admin/category/update/${id}`;

                    updateModal.show();
                    return;
                }

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

            modalEventBound = true;
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        initModalsAndBackdrop();
    });
</script>
