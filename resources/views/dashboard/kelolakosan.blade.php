@extends("layouts.app")

@section("content")
<div class="content">


        <!-- Page Content -->
        <div class="container mt-4">
            <h2>Kelola Kosan</h2>
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
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari kosan...">

                </div>

                <button class="btn btn-success" id="addKosanButton">
                    <i class="fas fa-plus"></i> New Kosan
                </button>
            </div>

            <!-- Tabel Kosan dengan Scroll Horizontal -->
            <div class="table-responsive">
                <table id="kosanTable" class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kosan</th>
                            <th>Harga</th>
                            <th>Lokasi</th>
                            <th>Kamar</th>
                            <th>Khusus</th>
                            <th>Fasilitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kosan as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->nama_kosan }}</td>
                            <td>{{ $data->harga}}</td>
                            <td>{{ $data->lokasi }}</td>
                            <td>{{ $data->kamar }} Orang</td>
                            <td>{{ ucfirst($data->category) }}</td>
                            <td>
                                @php
                                $fasilitas = json_decode($data->fasilitas, true);
                                @endphp

                                @if ($fasilitas)
                                @foreach ($fasilitas as $item)
                                {{ $item }},
                                @endforeach
                                @else
                                <span>Tidak ada fasilitas</span>
                                @endif

                            </td>

                            <td>
                                <input type="hidden" class="kosan-id" value="{{$data->id}}">
                                <input type="hidden" class="deskripsi" value="{{$data->deskripsi}}">
                                <input type="hidden" class="whatsapp" value="{{$data->nomer_whatsapp}}">
                                <input type="hidden" class="tanggal" value="{{$data->tanggal}}">
                                <input type="hidden" class="map" value="{{$data->map}}">
                                <button type="button" class="btn btn-primary btn-sm" id="editKosanButton" id-data="{{$data->id}}"><i class="fas fa-edit"></i></button>
                                <a href="./kelolakosan/remove/{{ $data->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="modelAdd" tabindex="-1" aria-labelledby="modelAddLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelAddLabel">New Kosan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formNewKosan" action="{{ route('addkosan') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="gambar">Foto Kosan</label>
                            <input type="file" name="file[]" id="gambar" class="form-control" multiple accept="image/*">
                            <div id="gambar-container"></div>
                        </div>

                        <div class="form-group">
                            <label for="khusus">Khusu</label>
                            <select name="category" class="form-control">
                                <option value="cewe">Cewe</option>
                                <option value="cowo">Cowo</option>
                                <option value="campur">Campur</option>
                            </select>
                        </div>

                        <!-- Form Fields (Kolom 1) -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="kosan">Nama Kosan</label>
                                <input type="text" class="form-control" id="kosan" name="kosan" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="harga_kosan">Harga</label>
                                <input type="text" class="form-control" id="harga_kosan" name="harga_kosan" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="kamar">Kamar</label>
                                <select class="form-control" id="kamar" name="kamar" required>
                                    <option value="1">1 Orang</option>
                                    <option value="2">2 Orang</option>
                                    <option value="3">3 Orang</option>
                                    <option value="4">4 Orang</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="pembayaran">Pembayaran</label>
                                <select class="form-control" id="pembayaran" name="pembayaran" required>
                                    <option value="tahun">Tahun</option>
                                    <option value="bulan" selected>Bulan</option>
                                    <option value="minggu">Minggu</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fasilitas">Fasilitas</label>
                                <input type="text" id="fasilitas" placeholder="Masukkan fasilitas" class="form-control" focus />
                                <input type="hidden" name="fasilitas" id="fasilitasHidden">
                                <div class="tagPreview mt-2"></div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
                                <input type="date" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran" required>
                            </div>
                        </div>

                        <!-- deskripsi -->
                        <label for="deskripsi">Deskripsi Kosan</label>
                        <div class="editor-container">
                            <div class="line-numbers"></div>
                            <textarea id="editor" name="deskripsi" class="editor" rows="10"></textarea>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="lokasi">Lokasi Kosan</label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="link_map">Map</label>
                                <input type="text" name="link_map" id="link_map" class="form-control" placeholder="Masukkan link map">
                            </div>
                        </div>


                        <div class="mapPreview" style="display: none;"> <!-- Sembunyikan preview secara default -->
                            <iframe src="" frameborder="0" id="mapPreviewIframe" style="width: 100%; height: 400px;"></iframe>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="submitKosanButton">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- model edit -->
 @include("dashboard.edit")
@endsection