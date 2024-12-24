@extends("layouts.app")

@section("content")
<div class="content">
    <h3>Dashboard</h3>

    <div class="box-container">
        <!-- Box Kosan -->
        <div class="dashboard-box" style="background-color: #ff4d4d;">
            <div class="box-title">
                <i class="fas fa-home"></i> <!-- Ikon Kosan -->
                <h4>Total Kosan</h4>
            </div>
            <div class="box-body">
                <p>{{ $totalKosan }} Kosan</p>
            </div>
            <div class="box-footer">
                <a href="{{ url('/kelola-kosan') }}">More &gt;&gt;</a>
            </div>
        </div>

        <!-- Box Pemilik -->
        <div class="dashboard-box" style="background-color: #4d94ff;">
            <div class="box-title">
                <i class="fas fa-users-cog"></i> <!-- Ikon Pemilik -->
                <h4>Total Pemilik</h4>
            </div>
            <div class="box-body">
                <p>{{ $pemilikCount }} Pemilik</p>
            </div>
            <div class="box-footer">
                <a href="{{ url('/user-management') }}">More &gt;&gt;</a>
            </div>
        </div>

        <!-- Box Penghuni -->
        <div class="dashboard-box" style="background-color: #ffcc00;">
            <div class="box-title">
                <i class="fas fa-user-friends"></i> <!-- Ikon Penghuni -->
                <h4>Total Penghuni</h4>
            </div>
            <div class="box-body">
                <p>{{ $penghuniCount }} Penghuni</p>
            </div>
            <div class="box-footer">
                <a href="{{ url('/user-management') }}">More &gt;&gt;</a>
            </div>
        </div>

        <!-- Box Transaksi -->
        <div class="dashboard-box" style="background-color: #ff9900;">
            <div class="box-title">
                <i class="fas fa-credit-card"></i> <!-- Ikon Transaksi -->
                <h4>Total Transaksi</h4>
            </div>
            <div class="box-body">
                <p>{{ $transaksiCount }} Transaksi</p>
            </div>
            <div class="box-footer">
                <a href="{{ url('/transaksi') }}">More &gt;&gt;</a>
            </div>
        </div>
    </div>
</div>
@endsection