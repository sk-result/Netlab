<!DOCTYPE html>
<html lang="en">

@include('admin.layout.head')


<body>
    <div class="wrapper d-block">
        <!-- Header -->
        <header class="bg-white shadow-sm py-3  border-bottom">
            <div class="container d-flex flex-wrap justify-content-between align-items-center">
                <a href="{{ route('admin.dashboard') }}"
                    class="d-flex align-items-center text-dark text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#0d6efd" class="me-2"
                        viewBox="0 0 16 16">
                        <path
                            d="M8 0a8 8 0 1 0 8 8A8.01 8.01 0 0 0 8 0zM4 8a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm6 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-3.5 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5V12a2 2 0 1 1-2 0z" />
                    </svg>
                    <span class="fs-4 fw-bold">Admin Panel</span>
                </a>

                <div class="d-flex align-items-center">
                    <label for="pageDropdown" class="form-label me-2 mb-0 fw-semibold text-secondary">Navigasi:</label>
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
            </div>
        </header>

        <!-- Main Panel -->
        <div class="main-panel">
            @yield('content')
        </div>

        <!-- Custom Template Settings -->
        <div class="custom-template">
            <div class="title">Settings</div>
            <div class="custom-content">
                <div class="switcher">

                    <div class="switch-block">
                        <h4>Logo Header</h4>
                        <div class="btnSwitch">
                            @foreach (['dark', 'blue', 'purple', 'light-blue', 'green', 'orange', 'red', 'white', 'dark2', 'blue2', 'purple2', 'light-blue2', 'green2', 'orange2', 'red2'] as $color)
                                <button type="button"
                                    class="changeLogoHeaderColor {{ $loop->first ? 'selected' : '' }}"
                                    data-color="{{ $color }}"></button>
                            @endforeach
                        </div>
                    </div>

                    <div class="switch-block">
                        <h4>Navbar Header</h4>
                        <div class="btnSwitch">
                            @foreach (['dark', 'blue', 'purple', 'light-blue', 'green', 'orange', 'red', 'white', 'dark2', 'blue2', 'purple2', 'light-blue2', 'green2', 'orange2', 'red2'] as $color)
                                <button type="button"
                                    class="changeTopBarColor {{ $color == 'white' ? 'selected' : '' }}"
                                    data-color="{{ $color }}"></button>
                            @endforeach
                        </div>
                    </div>

                    <div class="switch-block">
                        <h4>Sidebar</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeSideBarColor" data-color="white"></button>
                            <button type="button" class="selected changeSideBarColor" data-color="dark"></button>
                            <button type="button" class="changeSideBarColor" data-color="dark2"></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('admin.layout.script')

</body>

</html>
