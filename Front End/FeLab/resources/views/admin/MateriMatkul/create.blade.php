@extends('admin.layout.master-admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Tambah Peralatan</h4>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Bab</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option selected disabled>Pilih Bab</option>
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option selected disabled>Pilih Kategori</option>
                        
                            <option value=""></option>
                        
                    </select>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">File</label>
                    <input class="form-control" type="file" id="file" name="image" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

@endsection
