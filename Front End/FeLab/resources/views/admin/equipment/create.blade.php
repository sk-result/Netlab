@extends('admin.layout.master-admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Tambah Peralatan</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.equipment-store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Peralatan</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option selected disabled>Pilih Kategori</option>
                        @foreach ($categories as $category)
                        <option value="{{$category['id']}}">{{$category['name']}}</option>
                        @endforeach
                        
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input class="form-control" type="file" id="image" name="image" accept="image/*">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="description" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{route('admin.equipment')}}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

@endsection
