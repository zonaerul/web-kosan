<!-- Modal Edit Kosan -->
<!-- Modal Edit Kosan -->
<div class="modal fade" id="editKosanModal" tabindex="-1" role="dialog" aria-labelledby="editKosanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down" role="document">
        <div class="modal-content">
            <form id="editKosanForm_edit">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKosanModalLabel">Edit Kosan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="gambar_edit">Foto Kosan</label>
                        <input type="file" name="file[]" id="gambar_edit" class="form-control" multiple accept="image/*">
                        <div id="gambar-container_edit"></div>
                    </div>

                    <div class="form-group">
                        <label for="khusus_edit">Khusu</label>
                        <select name="category" class="form-control" id="category_edit">
                            <option value="cewe">Cewe</option>
                            <option value="cowo">Cowo</option>
                            <option value="campur">Campur</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kosan_edit">Nama Kosan</label>
                            <input type="text" class="form-control" id="kosan_edit" name="kosan" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="harga_kosan_edit">Harga</label>
                            <input type="text" class="form-control" id="harga_kosan_edit" name="harga_kosan" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kamar_edit">Kamar</label>
                            <select class="form-control" id="kamar_edit" name="kamar" required>
                                <option value="1">1 Orang</option>
                                <option value="2">2 Orang</option>
                                <option value="3">3 Orang</option>
                                <option value="4">4 Orang</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="pembayaran_edit">Pembayaran</label>
                            <select class="form-control" id="pembayaran_edit" name="pembayaran" required>
                                <option value="tahun">Tahun</option>
                                <option value="bulan" selected>Bulan</option>
                                <option value="minggu">Minggu</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fasilitas_edit">Fasilitas</label>
                            <input type="text" id="fasilitas_edit" placeholder="Masukkan fasilitas" class="form-control" focus />
                            <input type="hidden" name="fasilitas_edit" id="fasilitasHidden_edit">
                            <div class="tagPreview_edit mt-2" id="tagPreview_edit"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="tanggal_pembayaran_edit">Tanggal Pembayaran</label>
                            <input type="date" class="form-control" id="tanggal_pembayaran_edit" name="tanggal_pembayaran" required>
                        </div>
                    </div>

                    <label for="deskripsi_edit">Deskripsi Kosan</label>
                    <div class="editor-container_edit">
                        <div class="line-numbers_edit"></div>
                        <textarea id="editor_edit" name="deskripsi" class="editor_edit" rows="10"></textarea>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="lokasi_edit">Lokasi Kosan</label>
                            <input type="text" name="lokasi" id="lokasi_edit" class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="link_map_edit">Map</label>
                            <input type="text" name="link_map" id="link_map_edit" class="form-control" placeholder="Masukkan link map">
                        </div>
                    </div>

                    <div class="mapPreview_edit" style="display: none;"> <!-- Sembunyikan preview secara default -->
                        <iframe src="" frameborder="0" id="mapPreviewIframe_edit" style="width: 100%; height: 400px;"></iframe>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" id="submitKosanButton_edit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{asset("js/model_edit.js")}}"></script>