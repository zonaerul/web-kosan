<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kosan</title>
    <script src="{{asset("js/qrcode.min.js")}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <script src="{{asset("js/loading.js")}}"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .kosan-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .content {
            margin-bottom: 20px;
        }

        .boxhargaa {
            position: sticky;
            top: 50px;
            z-index: 100;
        }

        .box-harga {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-top: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .box-harga .coret {
            color: red;
            font-size: 1rem;
            margin-bottom: 15px;
            text-align: start;
            text-decoration: line-through;
        }

        .box-harga .harga-diskon {
            color: #28a745;
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: start;
        }

        .form-control,
        .btn-outline-success {
            margin-bottom: 10px;
        }

        .navbar-sticky {
            position: sticky;
            top: 0;
            z-index: 1020;
            background-color: #f8f9fa;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Set map size */
        #map {
            height: 400px;
            width: 100%;
            border-radius: 8px;
            margin-top: 20px;
        }

        /* Fade In Modal */
        .modal.fade .modal-dialog {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .modal.fade.show .modal-dialog {
            opacity: 1;
        }

        #qrcode {
            width: 200px;
            height: 200px;
        }


        .slider-img {
            height: 370px;
            /* Optional: Adds a bit of rounding for aesthetic effect */
        }
    </style>
</head>

<body>

    @include("block.nav")

    <div class="container my-4 mt-50"> <!-- Add container to center the carousel and add margin -->
        @php
        // Mendecode JSON string ke dalam array gambar
        $images = json_decode($kosan->upload_file, true);
        @endphp

        @if ($images && count($images) > 0)
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <!-- Carousel Indicators -->
            <ol class="carousel-indicators">
                @foreach ($images as $index => $image)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>

            <!-- Carousel Inner -->
            <div class="carousel-inner">
                @foreach ($images as $index => $image)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $image) }}" class="d-block w-100 slider-img" alt="Foto {{ $index + 1 }}">
                </div>
                @endforeach
            </div>

            <!-- Carousel Controls -->
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        @else
        <p>No images available for the carousel.</p>
        @endif

    </div>


    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8">
                <div class="content">
                    <h3>{{$kosan->nama_kosan}}</h3>
                    <p>{!! nl2br(e($kosan->deskripsi)) !!}</p>


                    <!-- fasilitas -->
                    <div class="container mt-4">
                        <h5>Fasilitas Kamar</h5>
                        @php
                        $fasilitas = json_decode($kosan->fasilitas, true);
                        @endphp

                        @if ($fasilitas)
                        @foreach ($fasilitas as $item)
                        {{$item}}, @endforeach
                        @else
                        <span>Tidak ada fasilitas</span>
                        @endif

                    </div>

                    <!-- Google Map -->
                    <iframe src="{{$kosan->map}}" frameborder="0" style="width:100%; height:400px;"></iframe>

                </div>
            </div>
            <div class="col-md-4 boxhargaa">
                <div class="box-harga">

                    @php
                    // Mengambil harga dan diskon
                    $harga = $kosan->harga;
                    @endphp

                    <!-- Menampilkan harga setelah diskon dengan format -->
                    <div class="harga-diskon">{{$harga}} ({{$kosan->pembayaran}})</div>
                    <input type="date" id="startDate" class="form-control" value="{{$kosan->tanggal_pembayaran}}" placeholder="Mulai Kos">

                    <button type="button" class="btn btn-outline-success btn-block">Tanya Pemilik</button>
                    <button type="button" class="btn btn-success btn-block mt-2 ajukansewa">Ajukan Sewa</button>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pembayaran -->
    <div class="modal fade" id="pembayaranModal" tabindex="-1" aria-labelledby="pembayaranModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pembayaranModalLabel">Pembayaran Sewa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formpembayaran" action="{{ route('form.pembayaran') }}" method="POST">
                    @csrf
                    @php
                    $id = request()->route('id');
                    @endphp
                    <input type="hidden" name="id_kosan" value="{{$id}}">
                    <div class="modal-body">
                        <!-- Form Pembayaran -->
                        <div class="form-group">
                            @php
                            $id = request()->route('id');
                            @endphp
                            <input type="hidden" name="id" value="{{$id}}">
                            <label for="bank">Pilih Bank</label>
                            <select id="bank" name="bank" class="form-control" required>
                                @foreach ($banks as $bank)
                                <option value="{{$bank->name}}"> {{$bank->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" id="nama" name="name" class="form-control" required placeholder="Masukkan Nama Anda">
                        </div>
                        <div class="form-group">
                            <label for="uangMuka">Tanggal Masuk Kos</label>
                            <input type="date" id="tanggalMulai" name="tanggal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="totalPembayaran">Total Pembayaran</label>

                            <!-- Menampilkan harga setelah diskon atau harga normal dengan ikon "Rp" -->
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="hidden" name="harga" value="{{str_replace('Rp', '', $kosan->harga)}}">
                                <input type="text" id="totalPembayaran" name="totalPembayaran" class="form-control"
                                    value="{{str_replace('Rp', '', $kosan->harga)}}" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="bayarBtn">Bayar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Menampilkan pesan error -->
    @if($errors->any())
    <div id="error-message" data-message="{{ $errors->first() }}"></div>
    @endif

    <!-- Menampilkan pesan sukses -->
    @if(session('success'))
    <div id="success-message" data-message="{{ session('success') }}"></div>
    @endif


    <div class="overflow">
        <span class="loader"></span>
    </div>

    @include("block.footer")

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            $(window).on('load', function() {
                setTimeout(function() {
                    $('.overflow').fadeOut(); // Menghilangkan overlay dengan efek fade
                }, 1000);
            });

            $('a[href="#footer"]').click(function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $('#footer').offset().top
                }, 1000);
            });

            var errorMessage = $('#error-message').data('message');
            if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: errorMessage,
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }

            // Cek apakah ada pesan sukses
            var successMessage = $('#success-message').data('message');
            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Pembayaran Berhasil!',
                    text: successMessage,
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }

            $("#startDate").on('change', function() {
                var selectedDate = $(this).val(); // Ambil nilai tanggal yang dipilih

                if (selectedDate) {
                    // Masukkan tanggal yang dipilih ke input hidden #tanggalMulai
                    $("#tanggalMulai").val(selectedDate);
                }
            });

            // Tambahkan event listener untuk tombol "Ajukan Sewa"
            $(".ajukansewa").click(function() {
                var startDate = $("#startDate").val();
                console.log(startDate);
                if (startDate == '') {
                    // Tampilkan toast alert SweetAlert jika startDate belum diisi
                    Swal.fire({
                        icon: 'error',
                        title: 'Silahkan pilih tanggal kos awal',
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                } else {
                    // Jika startDate sudah diisi, tampilkan modal pembayaran
                    $("#pembayaranModal").modal("show");
                }
            });
        });
    </script>

</body>

</html>