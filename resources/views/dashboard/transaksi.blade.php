@extends("layouts.app")

@section("content")
<div class="content">
    <!-- Page Content -->
    <div class="container mt-4">
        <h2>Transaksi</h2>
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
                <input type="text" id="searchInput" class="form-control" placeholder="Cari transaksi">

            </div>
        </div>
        <div class="table-responsive">
            <table id="kosanTable" class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>id</th>
                        <th>id kosan</th>
                        <th>code</th>
                        <th>email</th>
                        <th>nama</th>
                        <th>bank</th>
                        <th>user_id</th>
                        <th>total</th>
                        <th>status</th>
                        <th>tanggal</th>
                        <th>aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $data)
                    <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->id_kosan }}</td>
                    <td>{{ $data->code }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->bank }}</td>
                    <td>{{ $data->user_id }}</td>
                    <td>{{ $data->total }}</td>
                    <td style="color: {{ $data->status == 'paid' ? 'green' : ($data->status == 'padding' ? 'orange' : 'red') }};">{{ $data->status }}</td>
                    <td>{{ $data->tanggal }}</td>
                    <td>
                        <a href="{{ url('/transactions/view/'.$data->id) }}" class="btn btn-info">View</a>
                        <a href="{{ url('/transactions/edit/'.$data->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('/transactions/delete/'.$data->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this transaction?')">Delete</a>
                        <a href="{{ url('/transactions/markaspaid/'.$data->id) }}" class="btn btn-success">Mark as Paid</a>
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