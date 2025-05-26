<!-- Modal Update Equipment -->
<div class="modal fade" id="modalUpdateEquipment" tabindex="-1" aria-labelledby="modalUpdateEquipmentLabel"
    aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="formUpdateEquipment" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUpdateEquipmentLabel">Update Data Peralatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="update_name" class="form-label">Nama Peralatan</label>
                        <input type="text" class="form-control" id="update_name" name="name" required>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="update_category_id" class="form-label">Kategori</label>
                        <select name="category_id" id="update_category_id" class="form-select" required>
                            <option value="" disabled>-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Gambar -->
                    <div class="mb-3">
                        <label for="update_image" class="form-label">Gambar (biarkan kosong jika tidak ingin diganti)</label>
                        <input type="file" class="form-control" id="update_image" name="image" accept="image/*">
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="update_description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="update_description" name="description" rows="3" required></textarea>
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
