<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('assets-auth/style.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <div class="container">
        <h2>Log in</h2>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <input name="email" type="email" id="loginUsername" placeholder="user@example.com" required />
            <div class="password-wrapper">
                <input name="password" type="password" id="loginPassword" placeholder="Password" required />
                <span class="toggle-password" onclick="togglePassword()"></span>
            </div>
            <button type="submit">LOG IN</button>
        </form>
        <a href="#" class="forgot-password">Lupa Password</a>

        <div class="or-divider">ATAU</div>

        <!-- Google Login Button -->
        <div id="g_id_onload" data-client_id="YOUR_GOOGLE_CLIENT_ID" data-callback="handleGoogleLogin"
            data-auto_prompt="false"></div>
        <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline"
            data-text="signin_with" data-size="large" data-logo_alignment="left"></div>

        <div class="bottom-link">
            Baru di sini? <a href="register.html">Daftar</a>
        </div>
    </div>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <!-- Tambahkan SweetAlert2 dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#d33',
            });
        @endif
    </script>

</body>

</html>
