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

        // Tidak perlu event hidden.bs.modal untuk backdrop lagi

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
                    const a =   updateInput.value;
                    if (a) {
                        updateForm.action = `/admin/categoryMatkul/update/${id}`;
                    }
                    if (a) {
                        updateForm.action = `/admin/category/update/${id}`;
                    }
                    updateModal.show();
                    return;
                }

                const deleteBtn = e.target.closest('.swal-confirm');
                if (!deleteBtn) return;

                e.preventDefault();

                const id = deleteBtn.dataset.id;
                const name = deleteBtn.dataset.name;
                // console.log('Target:', e.target);
                // console.log('Delete button found:', deleteBtn);

                if (!id || !name) {
                    console.warn("Data-id atau data-name tidak ditemukan di tombol delete.");
                    return;
                }
                // console.log(`delete-form-${id}`);   
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
                        try {
                            const form = document.getElementById(`delete-form-${id}`);
                            console.log("Form:", form);
                            form.submit();
                        } catch (error) {
                            console.error("Gagal submit:", error);
                        }
                    }
                });

                return;
            });
            modalEventBound = true;
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        initModalsAndBackdrop();
    });
</script>
