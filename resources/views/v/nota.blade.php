<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembayaran Anda</title>
    <script src="{{ asset('js/qrcode.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .nota-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .nota-header, .nota-footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .nota-details {
            font-size: 1rem;
            line-height: 1.6;
        }
        .nota-details .row {
            margin-bottom: 10px;
        }
        .qr-code {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    @include("block.nav")

    <!-- Nota Pembayaran -->
    <div class="nota-container">
        <div class="nota-header">
            <h3>Nota Pembayaran</h3>
            <p>ID Pembayaran: #{{ $pembayaran->id }}</p>
        </div>

        <div class="nota-details">
            <div class="row">
                <div class="col-6"><strong>Nama Penyewa</strong></div>
                <div class="col-6">{{ $pembayaran->nama}}</div>
            </div>
            <div class="row">
                <div class="col-6"><strong>Tanggal Pembayaran</strong></div>
                <div class="col-6">{{ date('d M Y', strtotime($pembayaran->tanggal)) }}</div>
            </div>
            <div class="row">
                <div class="col-6"><strong>Bank</strong></div>
                <div class="col-6">{{ $pembayaran->bank }}</div>
            </div>
            <div class="row">
                <div class="col-6"><strong>Jumlah Pembayaran</strong></div>
                <div class="col-6">Rp {{ number_format($pembayaran->total_pembayaran, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- QR Code -->
        <div class="qr-code">
            <div id="qrcode"></div>
            <p>Scan untuk verifikasi pembayaran</p>
        </div>

        <div class="nota-footer">
            <p>Terima kasih telah melakukan pembayaran.</p>
            <p><small>Jika ada pertanyaan, hubungi layanan pelanggan kami.</small></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            // Inisialisasi QR Code
            var qrcode = new QRCode(document.getElementById("qrcode"), {
                text: "{{ $pembayaran->id }}",
                width: 128,
                height: 128,
                colorDark: "#000000",
                colorLight: "#ffffff",
            });
        });
    </script>
</body>
</html>
