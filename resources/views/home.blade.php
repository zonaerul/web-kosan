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
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <script src="{{asset("js/loading.js")}}"></script>
    <style>
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

        .slider-img {
            height: 300px;
            object-fit: cover;
        }

        .navbar-sticky {
            position: sticky;
            top: 0;
            z-index: 1020;
            /* Keeps the navbar on top */
            background-color: #f8f9fa;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Optional shadow */
        }

        a.link {
            color: black;
            text-decoration: none;
        }

        #gambar-kosan-container {
            width: 100%;
            position: relative;
        }

        .gambar-kosan {
            display: none;
        }

        .gambar-kosan img {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    @include("block.nav")

    <!-- Image Slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://static.mamikos.com/uploads/cache/data/style/2023-11-16/14RvxyER-540x720.jpg" class="d-block w-100 slider-img" alt="Foto 1">
            </div>
            <div class="carousel-item">
                <img src="https://static.mamikos.com/uploads/cache/data/style/2023-06-27/FNm5qZQp-540x720.jpg" class="d-block w-100 slider-img" alt="Foto 2">
            </div>
            <div class="carousel-item">
                <img src="https://static.mamikos.com/uploads/cache/data/style/2023-04-28/2a4PB8aN-540x720.jpg" class="d-block w-100 slider-img" alt="Foto 3">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Banner -->
    <div class="container mt-4">
        <div class="alert alert-info text-center" role="alert">
            <strong>Promo Spesial!</strong> Diskon menarik untuk kosan terpilih. Hubungi kami untuk informasi lebih lanjut.
        </div>
    </div>

    <!-- List Kosan -->
    <div class="container mt-4">
        <h3>Daftar Kosan Terbaru</h3>
        <!-- Container Kosan -->
        <div class="d-flex flex-wrap justify-content-start">
            @foreach ($kosan as $data)
            <a href="/kosan/view/{{$data->id}}" class="link text-decoration-none mx-2 mb-3">
                <div class="card" style="width: 18rem;">
                    @php
                    // Mendecode JSON string ke dalam array gambar
                    $images = json_decode($data->upload_file, true);
                    @endphp
                    @if($images && count($images) > 0)
                    <img src="{{ asset('storage/' . $images[0]) }}" class="card-img-top" alt="Foto Kosan"
                        onerror="this.onerror=null; this.src='{{ asset('image/error.png') }}';">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ \Illuminate\Support\Str::limit($data->nama_kosan, 30) }}</h5>
                        <p class="card-text">
                            <i class="fas fa-map-marker-alt"></i> {{ \Illuminate\Support\Str::limit($data->lokasi, 15) }}
                        </p>
                        <p class="card-text text-warning"><strong>{{$data->harga}}</strong> / {{$data->pembayaran}}</p>
                    </div>
                    <div class="card-footer text-center">
                        <small class="text-muted">
                            {{$data->category}} | {{ $data->kamar }} kamar |
                            @php
                            $fasilitas = json_decode($data->fasilitas, true);
                            @endphp
                            @if ($fasilitas)
                            @foreach ($fasilitas as $item)
                            {{ $item }}{{ !$loop->last ? ',' : '' }}
                            @endforeach
                            @else
                            <span>Tidak ada fasilitas</span>
                            @endif
                        </small>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Tombol Nomor Urut dan Navigasi -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <!-- Tombol Nomor Urut -->
            <div>
                @for ($i = 1; $i <= 4; $i++)
                    <button class="btn btn-outline-primary mx-1" style="width: 40px;">{{ $i }}</button>
                    @endfor
            </div>
            <!-- Tombol "Next" -->
            <button class="btn btn-outline-secondary ml-3">>> Next</button>
        </div>
    </div>




    <!-- Footer -->
    @include("block.footer")

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $('a[href="#footer"]').click(function(e) {
                e.preventDefault(); // Mencegah aksi default dari klik (tidak menuju ke #footer secara langsung)
                // Scroll ke bagian footer dengan efek smooth
                $('html, body').animate({
                    scrollTop: $('#footer').offset().top
                }, 1500); // Durasi scroll yang lebih panjang untuk efek smooth lebih terasa
            });
        });
    </script>
</body>

</html>