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
                    <label for="name" class="form-label">Jenis Matkul</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

@endsection
