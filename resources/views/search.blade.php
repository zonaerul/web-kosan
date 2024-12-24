<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosan</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <style>
        .form-control {
            height: 45px;
        }

        .filter-section {
            margin-bottom: 20px;
        }

        /* Apply fonts */
        body {
            font-family: 'Roboto', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Lora', serif;
        }

        .navbar-sticky {
            position: sticky;
            top: 0;
            z-index: 1020;
            background-color: #f8f9fa;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Custom styles for the search form */
        .search-form {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .search-form label {
            font-weight: bold;
        }

        .search-form select, .search-form button {
            border-radius: 4px;
        }

        .search-form button {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .search-form button:hover {
            background-color: #0056b3;
        }

        /* Ensure the form is responsive */
        @media (max-width: 768px) {
            .form-control {
                width: 100%;
            }

            .search-form {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <div class="overflow">
        <span class="loader"></span>
    </div>

    <!-- Navbar -->
    @include("block.nav")

    <!-- Filter Section -->
    <div class="container filter-section">
        <h3 class="text-center mb-4">Filter Pencarian</h3>
        <form action="#" method="GET" class="search-form">
            <div class="row">
                <!-- Kategori -->
                <div class="col-md-3">
                    <label for="category">Kategori</label>
                    <select class="form-control" id="category" name="category">
                        <option value="kosan">Kosan</option>
                        <option value="apartemen">Apartemen</option>
                    </select>
                </div>
                <!-- Jenis Kelamin -->
                <div class="col-md-3">
                    <label for="gender">Jenis Kelamin</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="cewe">Cewek</option>
                        <option value="cowo">Cowok</option>
                        <option value="campur">Campur</option>
                    </select>
                </div>
                <!-- Rentang Harga -->
                <div class="col-md-3">
                    <label for="price">Harga</label>
                    <select class="form-control" id="price" name="price">
                        <option value="1">Rp 300.000 - Rp 1.000.000</option>
                        <option value="2">Rp 1.000.000 - Rp 2.000.000</option>
                        <option value="3">Rp 2.000.000 - Rp 5.000.000</option>
                        <option value="4">Rp 5.000.000+</option>
                    </select>
                </div>
                <!-- Lokasi -->
                <div class="col-md-3">
                    <label for="location">Lokasi</label>
                    <select class="form-control" id="location" name="location">
                        <option value="jakarta">Jakarta</option>
                        <option value="bandung">Bandung</option>
                        <option value="surabaya">Surabaya</option>
                        <option value="yogyakarta">Yogyakarta</option>
                    </select>
                </div>
                <!-- Tombol Search -->
                <div class="col-md-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Footer -->
    @include("block.footer")

    <script>
        $(document).ready(function() {
            // Menyembunyikan loading setelah halaman sepenuhnya dimuat
            $(window).on('load', function() {
                $('.overflow').fadeOut(); // Menghilangkan overlay
            });
        });
    </script>
</body>

</html>
