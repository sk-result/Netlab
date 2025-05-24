<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('assets-auth/style.css') }}" />
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body>
    <div class="container">
        <h2>Daftar</h2>
        <form method="post" action="{{route('register')}}">
            @csrf
            <input type="text" name="name" id="regName" placeholder="Username" required />
            <input type="email" name="email" id="regUsername" placeholder="user@example.com" class="rounded-input"
                required />
            <div class="password-wrapper">
                <input type="password" name="password" id="regPassword" placeholder="Password" required />
            </div>
            <button type="submit">DAFTAR</button>
        </form>
        <div class="or-divider">ATAU</div>

        <!-- Google Login Button -->
        <div id="g_id_onload" data-client_id="YOUR_GOOGLE_CLIENT_ID" data-callback="handleGoogleRegister"
            data-auto_prompt="false"></div>
        <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline"
            data-text="signin_with" data-size="large" data-logo_alignment="left"></div>

        <div class="bottom-link">
            Sudah punya akun? <a href="login.html">Login</a>
        </div>
    </div>
    <script></script>
</body>

</html>
