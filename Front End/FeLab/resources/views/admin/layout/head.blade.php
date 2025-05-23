<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin Netlab</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('assets-landing/img/favicon-32x32.png') }}" type="image/x-icon" />

    <!-- Google Fonts langsung -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-..." crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"> --}}

    <!-- Tetap Lokal -->
    <link rel="stylesheet" href="{{ asset('assets-admin/css/fonts.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/kaiadmin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/demo.css') }}">
</head>

@yield('head')
