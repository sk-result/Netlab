<!-- Modal Tambah Equipment -->
<div class="modal fade" id="modalTambahEquipment" tabindex="-1" aria-labelledby="modalTambahEquipmentLabel"
    aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.equipment-store') }}" method="POST" enctype="multipart/form-data"
                id="formTambahEquipment">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahEquipmentLabel">Tambah Peralatan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Peralatan</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Gambar -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>

                    {{-- <div class="col-md-12">
                        <label for="editor" class="form-label">Upload Foto</label>
                        <textarea name="image" id="editor" rows="5" class=""></textarea>
                    </div> --}}

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                            placeholder="Tulis deskripsi peralatan..." required></textarea>
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
