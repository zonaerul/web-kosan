@extends("layouts.app")

@section("content")
<div class="content">
    <!-- Page Content -->
    <div class="container mt-4">
        <h2>Facilities</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Search and Add New Kosan -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="input-group w-200px">
                <span class="input-group-text" id="searchIcon">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" id="searchInput" class="form-control" placeholder="Cari admin">

            </div>
        </div>
        <div class="table-responsive">
            <table id="kosanTable" class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Kosan</th>
                        <th>Email</th>
                        <th>Fasilitas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fasilitas as $kosan)
                    <tr>
                        <td>
                            {{$kosan->nama_kosan}}
                        </td>
                    <td>{{ $kosan->email }}</td>
                    <td>
                        @php
                        $fasilitas = json_decode($kosan->fasilitas, true);
                        @endphp

                        @if ($fasilitas)
                        @foreach ($fasilitas as $item)
                        {{ $item }},
                        @endforeach
                        @else
                        <span>Tidak ada fasilitas</span>
                        @endif
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
</div>
</div>
</div>
@endsection