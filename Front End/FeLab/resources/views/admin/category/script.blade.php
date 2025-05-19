{{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    //all data
    axios.get('http://localhost:8001/api/category')
        .then(response => {
            const categories = response.data.data || response
                .data; // Sesuaikan kalau response pakai data.data atau langsung data
            let html = '';
            categories.forEach(cat => {
                html += `<tr>
                <td>${cat.name}</td>
                <td><a href="#" onclick="showCategory(${cat.id})">Detail</a></td>
            </tr>`;
            });
            document.getElementById('categories').innerHTML = html;
        })
        .catch(error => {
            console.error('Error fetching categories:', error);
            document.getElementById('categories').innerHTML =
                '<tr><td colspan="2">Gagal memuat data kategori.</td></tr>';
        });


    //show category
    function showCategory(id) {
        axios.get(`http://localhost:8001/api/category/show/${id}`)
            .then(response => {
                const category = response.data;
                alert(`Kategori: ${category.name}\nID: ${category.id}`);
            })
            .catch(error => {
                alert('Kategori tidak ditemukan');
            });
    }

    //create
    document.getElementById('create-category').addEventListener('submit', function(e) {
        e.preventDefault();

        axios.post('http://localhost:8001/api/category/create', {
            name: document.getElementById('name').value
        }).then(response => {
            alert(response.data.message);
        }).catch(error => {
            console.error(error);
            alert('Gagal menambahkan kategori');
        });
    });

    // Buka modal edit
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            axios.get(`http://localhost:8001/api/category/show/${id}`)
                .then(res => {
                    const cat = res.data;
                    document.getElementById('editCategoryId').value = cat.id;
                    document.getElementById('editCategoryName').value = cat.name;
                    new bootstrap.Modal(document.getElementById('editCategoryModal')).show();
                });
        });
    });

    // Submit update form
    document.getElementById('editCategoryForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('editCategoryId').value;
        const name = document.getElementById('editCategoryName').value;
        axios.patch(`http://localhost:8001/api/category/update/${id}`, {
                name
            })
            .then(() => {
                alert('Kategori berhasil diupdate');
                location.reload();
            });
    });

    // Delete kategori
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            if (confirm('Yakin ingin menghapus kategori ini?')) {
                axios.delete(`http://localhost:8001/api/category/delete/${id}`)
                    .then(() => {
                        alert('Kategori berhasil dihapus');
                        location.reload();
                    });
            }
        });
    });
</script>
 --}}
@if (session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
