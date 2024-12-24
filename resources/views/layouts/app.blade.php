<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filament-style CMS Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/inputmask/dist/min/inputmask/inputmask.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            background-color: #ffffff;
            height: 100vh;
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 2;
            padding-top: 60px;
            border-right: 2px solid #ddd;
            transition: all 0.3s ease;
        }

        .sidebar a {
            color: #333;
            padding: 12px 20px;
            text-decoration: none;
            display: block;
            font-size: 16px;
        }

        /* .sidebar a:hover {
            background-color: darkgrey;
            color: white;
        } */

        .sidebar .active {
            background-color: grey;
            color: #fff;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .navbar {
            z-index: 10;
            background-color: #ffffff;
            padding: 10px;
            position: sticky;
            top: 0px;
            border-bottom: 2px solid #ddd;
        }

        .navbar-brand {
            color: #333;
        }

        .navbar-toggler-icon {
            color: #333;
        }

        .toggle-sidebar {
            display: none;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .card-body {
            color: #333;
        }

        @media only screen and (max-width: 768px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.active {
                left: 0;
            }

            .content {
                margin-left: 0;
            }

            .toggle-sidebar {
                display: block;
                color: #007bff;
            }
        }


        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .w-200px {
            width: 300px;
        }

        .tox {
            max-width: 100%;
            /* Pastikan editor tidak melebihi lebar kontainer */
            overflow-x: auto;
            /* Izinkan scroll horizontal jika diperlukan */
        }

        textarea {
            width: 100%;
            /* Sesuaikan dengan kontainer */
            box-sizing: border-box;
            /* Sertakan padding dalam perhitungan lebar */
        }

        /* Modal Responsif */
        @media (max-width: 576px) {
            .modal-dialog {
                margin: 0;
                width: 100%;
                max-width: 100%;
            }

            .modal-content {
                border-radius: 0;
                /* Hilangkan border radius pada perangkat kecil */
            }
        }

        .tagPreview {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .tagPreview_edit {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .tag {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            font-size: 14px;
        }


        .tag .removeTag {
            margin-left: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .editor-container {
            display: flex;
            position: relative;
            font-family: monospace;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }

        .line-numbers {
            background-color: #f8f9fa;
            color: #6c757d;
            padding: 10px;
            text-align: right;
            border-right: 1px solid #ddd;
            user-select: none;
        }

        .line-numbers div {
            height: 1.5em;
            /* Match the line height of the textarea */
            line-height: 1.5em;
        }

        .editor {
            width: 100%;
            padding: 10px;
            border: none;
            resize: none;
            font-size: 14px;
            line-height: 1.5em;
            outline: none;
            overflow: auto;
        }

        /* edit editor */
        .editor-container_edit {
            display: flex;
            position: relative;
            font-family: monospace;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }

        .line-numbers_edit {
            background-color: #f8f9fa;
            color: #6c757d;
            padding: 10px;
            text-align: right;
            border-right: 1px solid #ddd;
            user-select: none;
        }

        .line-numbers_edit div {
            height: 1.5em;
            /* Match the line height of the textarea */
            line-height: 1.5em;
        }

        .editor_edit {
            width: 100%;
            padding: 10px;
            border: none;
            resize: none;
            font-size: 14px;
            line-height: 1.5em;
            outline: none;
            overflow: auto;
        }

        .preview_edit {
            margin-top: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            white-space: pre-wrap;
            /* Preserve whitespace and line breaks */
            font-family: monospace;
            line-height: 1.5em;
        }

        .preview {
            margin-top: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            white-space: pre-wrap;
            /* Preserve whitespace and line breaks */
            font-family: monospace;
            line-height: 1.5em;
        }

        .dashboard-box {
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            color: white;
            position: relative;
            width: calc(25.33% - 20px);
        }

        .box-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 5px;
            width: calc(100% - 20px);
        }

        .dashboard-box .box-title {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .dashboard-box .box-title i {
            font-size: 24px;
            margin-right: 10px;
        }

        .dashboard-box .box-title h4 {
            font-size: 18px;
            font-weight: bold;
        }

        .dashboard-box .box-body p {
            font-size: 16px;
        }

        .dashboard-box .box-footer {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        .dashboard-box .box-footer a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            border: 1px solid #fff;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .dashboard-box .box-footer a:hover {
            background-color: #fff;
            color: #333;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <!-- Dashboard -->
        @auth
        @if (Auth::user()->role == 'Admin')
        <a href="{{ url('/dashboard') }}" class="{{ Request::is('dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>
        @endif
        @endauth

        <a href="{{ url('/kelola-kosan') }}" class="{{ Request::is('kelola-kosan') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Kelola Kosan
        </a>

        <!-- User Management -->
        <a href="{{ url('/user-management') }}" class="{{ Request::is('user-management') ? 'active' : '' }}">
            <i class="fas fa-users-cog"></i> User Management
        </a>

        <!-- Manajemen Fasilitas -->
        <a href="{{ url('/penyewa') }}" class="{{ Request::is('facilities') ? 'active' : '' }}">
            <i class="fas fa-user"></i> Penyewa
        </a>

        @auth
        @if (Auth::user()->role == 'Admin')
        <a href="{{ url('/facilities') }}" class="{{ Request::is('dashboard') ? 'active' : '' }}">
            <i class="fas fa-box"></i> Fasilitas & layanan
        </a>
        @endif
        @endauth

        <!-- Manajemen Transaksi -->
        <a href="{{ url('/transaksi') }}" class="{{ Request::is('transaksi') ? 'active' : '' }}">
            <i class="fas fa-credit-card"></i> Manajemen Transaksi
        </a>

        <!-- Logout -->
        <a href="{{ url('/logout') }}">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>



    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler toggle-sidebar" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            @auth
            @if (Auth::user()->role == 'Admin')
            AdminPanel
            @else
            Kosan
            @endif
            @endauth
        </a>
    </nav>

    <div class="mt-2">
        @yield('content')
    </div>
    <script src="{{asset("js/editor.js")}}"></script>
    <script src="{{asset("js/map.js")}}"></script>
</body>

</html>