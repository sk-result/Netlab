<!DOCTYPE html>
<html lang="en">

@include('admin.layout.head')


<body>
    <div class="wrapper d-block">
        <!-- Header -->
        <header class="bg-white shadow-sm py-3  border-bottom">
            <div class="container d-flex flex-wrap justify-content-between align-items-center">
                <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-dark text-decoration-none">
                    <img src="{{ asset('assets-landing/img/favicon-32x32.png') }}" width="32" height="32"
                        class="me-2" alt="icon" style="margin-bottom: 10px">

                    <span class="fs-4 fw-bold">Admin</span>
                </a>
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <label for="pageDropdown"
                            class="form-label me-2 mb-0 fw-semibold text-secondary">Navigasi:</label>
                        <select
                            class="form-select form-select-sm w-auto px-3 py-2 rounded-pill border-0 shadow-sm stylish-dropdown"
                            id="pageDropdown">
                            <option value="">-- Pilih Halaman --</option>
                            <option value="{{ route('admin.dashboard') }}"
                                {{ request()->routeIs('admin.dashboard') ? 'selected' : '' }}>Dashboard</option>
                            <option value="{{ route('admin.category') }}"
                                {{ request()->routeIs('admin.category') ? 'selected' : '' }}>Category Tool</option>
                            <option value="{{ route('admin.categoryMatkul') }}"
                                {{ request()->routeIs('admin.categoryMatkul') ? 'selected' : '' }}>Category Mata Kuliah
                            </option>
                            <option value="{{ route('admin.equipment') }}"
                                {{ request()->routeIs('admin.equipment') ? 'selected' : '' }}>Equipment Tool</option>
                            <option value="{{ route('admin.MateriMatkul') }}"
                                {{ request()->routeIs('admin.MateriMatkul') ? 'selected' : '' }}>Materi Matkul</option>
                            <option value="{{ route('admin.about') }}"
                                {{ request()->routeIs('admin.about') ? 'selected' : '' }}>About</option>
                        </select>
                    </div>
                    <form action="" method="POST" class="ms-3">
                        @csrf
                        <button type="submit" class="btn btn-sm text-white rounded-pill shadow-sm fw-semibold"
                            style="background: linear-gradient(90deg, #ff6a00, #ee0979); border: none;">
                            <i class="note-icon-arrow-circle-left"></i> Logout
                        </button>

                    </form>
                </div>
            </div>
        </header>

        <!-- Main Panel -->
        <div class="main-panel">
            @yield('content')

        </div>
    </div>
    
    @include('admin.layout.script')

</body>

</html>
