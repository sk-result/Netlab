@extends('admin.layout.master-admin')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Edit Materi</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.MateriMatkul-processUpdate', $materi['id']) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $materi['name'] }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="bab" class="form-label">Bab</label>
                        <select class="form-select" id="bab" name="bab" required>
                            <option disabled>Pilih Bab</option>
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" {{ $materi['bab'] == $i ? 'selected' : '' }}>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="description" rows="3">{{ $materi['description'] }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option disabled>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category['id'] }}"
                                    {{ $materi['category_id'] == $category['id'] ? 'selected' : '' }}>
                                    {{ $category['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">File (PDF)</label>
                        <input class="form-control" type="file" id="file" name="file_pdf" accept="application/pdf">
                        @if ($materi['file_pdf'])
                            <small class="text-muted">File saat ini: <a href="{{ file_url($materi['file_pdf']) }}"
                                    target="_blank">Lihat PDF</a></small>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.MateriMatkul') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
