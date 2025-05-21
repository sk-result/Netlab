@extends('admin.layout.master-admin')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Peralatan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.equipment-processUpdate', $equipment['id']) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Peralatan</label>
                        <input type="text" class="form-control" id="name" name="name" required
                            value="{{ old('name', $equipment['name']) }}">
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option disabled>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category['id'] }}"
                                    {{ $category['id'] == $equipment['category_id'] ? 'selected' : '' }}>
                                    {{ $category['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*">
                        @if (!empty($equipment['image']))
                            <img src="{{ file_url($equipment['image']) }}" alt="Gambar" width="100"
                                class="mt-2">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="description" rows="3">{{ old('description', $equipment['description']) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.equipment') }}" class="btn btn-secondary">Kembali</a>
                </form>

            </div>
        </div>
    </div>
@endsection
