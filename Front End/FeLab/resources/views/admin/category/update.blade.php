@extends('admin.layout.master-admin')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Peralatan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.category-procesUpdate', $category['id']) }}" method="POST" id="create-category"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label for="name" class="form-label">Jenis Peralatan</label>
                        <input type="text" class="form-control" id="name" value="{{ $category['name'] }}"
                            name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.category') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
