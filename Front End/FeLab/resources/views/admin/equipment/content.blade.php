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

<!-- Bagian Container dan DataTables -->
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">DataTables.Net</h3>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Tambah Peralatan</h4>
                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                            data-bs-target="#modalTambahEquipment">
                            <i class="fa fa-plus"></i> Add Row
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Gambar</th>
                                    <th>Deskripsi</th>
                                    <th style="width: 10%; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipments as $cat)
                                    <tr>
                                        <td>{{ $cat['name'] }}</td>
                                        <td>{{ $cat['category']['name'] ?? '-' }}</td>
                                        <td>
                                            @if ($cat['image'])
                                                <img src="{{ file_url($cat['image']) }}" alt="{{ $cat['name'] }}"
                                                    width="80">
                                            @else
                                                <span>Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>{{ $cat['description'] }}</td>
                                        <td>
                                            <div class="form-button-action d-flex align-items-center gap-1">
                                                <button type="button"
                                                    class="btn btn-link btn-primary btn-lg btn-edit-equipment"
                                                    data-id="{{ $cat['id'] }}" data-name="{{ $cat['name'] }}"
                                                    data-category="{{ $cat['category_id'] }}"
                                                    data-description="{{ $cat['description'] }}"
                                                    data-route="{{ route('admin.equipment-processUpdate', $cat['id']) }}"
                                                    data-bs-toggle="modal" data-bs-target="#modalUpdateEquipment"
                                                    title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <form id="delete-form-{{ $cat['id'] }}"
                                                    action="{{ route('admin.equipment-destroy', $cat['id']) }}"
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

<!-- Modal Tambah Equipment -->
@include('admin.equipment.modal_create')

<!-- Modal Update Equipment -->
@include('admin.equipment.modal_update')
