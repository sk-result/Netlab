<style>
    .modal-content {
        border: 2px solid #dee2e6;
        /* warna abu-abu Bootstrap */
        border-radius: 8px;
        /* opsional untuk tampilan lebih halus */
        box-shadow: 0px 6px 25px 0px rgba(0, 0, 0, .5);
        /* opsional untuk kedalaman */
    }
</style>


<div class="container mt-4">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Category</h3>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title">Add Row</h4>
                    <!-- Tombol buka modal -->
                    <button type="button" id="btnOpenModal" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i> Add Row
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th style="width: 10%; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $cat)
                                    <tr>
                                        <td>{{ $cat['name'] }}</td>
                                        <td>
                                            <div class="form-button-action d-flex align-items-center gap-1">
                                                <button type="button" class="btn btn-link btn-primary btn-lg btn-edit"
                                                    data-id="{{ $cat['id'] }}" data-name="{{ $cat['name'] }}"
                                                    title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <form id="delete-form-{{ $cat['id'] }}"
                                                    action="{{ route('admin.categoryMatkul-destroy', $cat['id']) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-link btn-danger btn-lg swal-confirm"
                                                        data-id="{{ $cat['id'] }}" data-name="{{ $cat['name'] }}">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel"
    aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog" style="z-index: 1050;">
        <div class="modal-content">
            <form action="{{ route('admin.categoryMatkul-store') }}" method="POST" enctype="multipart/form-data"
                id="formTambahKategori">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahKategoriLabel">Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Jenis Peralatan</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update Kategori -->
<div class="modal fade" id="modalUpdateKategori" tabindex="-1" aria-labelledby="modalUpdateKategoriLabel"
    aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog">
        <div style="z-index: 1050;" class="modal-content">
            <form method="POST" id="formUpdateKategori">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUpdateKategoriLabel">Update Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="update_name" class="form-label">Jenis Peralatan</label>
                        <input type="text" class="form-control" id="update_name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
