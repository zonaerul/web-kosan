@extends("layouts.app")

@section("content")
<div class="content">
    <!-- Page Content -->
    <div class="container mt-4">
        <h2>User Management</h2>
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

            <button class="btn btn-success" id="addusers">
                <i class="fas fa-plus"></i> New Account
            </button>
        </div>
        <h4>Akun Admin</h4>
        <div class="table-responsive">
            <table id="kosanTable" class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Number</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $admin => $data)
                    @if ($data->role == "Admin")
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->role}}</td>
                        <td>{{ $data->number }}</td>
                        <td>{{ $data->email }}</td>

                        <td>
                            <button type="button" class="btn btn-primary btn-sm" id="editUser" id-data="{{$data->id}}"><i class="fas fa-edit"></i></button>
                            <a href="./user/remove/{{ $data->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>

        </div>
        <br>
        <br>
        <!-- Search and Add New Kosan -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="input-group w-200px">
                <span class="input-group-text" id="searchIcon">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" id="searchInput" class="form-control" placeholder="Cari user">

            </div>

        </div>
        <h4>Akun User</h4>

        <!-- Tabel Kosan dengan Scroll Horizontal -->
        <div class="table-responsive">
            <table id="kosanTable" class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Number</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user => $data)
                    @if ($data->role != "Admin")
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->role}}</td>
                        <td>{{ $data->number }}</td>
                        <td>{{ $data->email }}</td>

                        <td>
                            <button type="button" class="btn btn-primary btn-sm" id="editUser" id-data="{{$data->id}}"><i class="fas fa-edit"></i></button>
                            <a href="./user/remove/{{ $data->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
</div>
@endsection