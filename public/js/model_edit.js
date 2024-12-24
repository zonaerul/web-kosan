$(document).ready(function () {
    // Ketika tombol edit diklik
    $("#editKosanButton").click(function () {
        var kosanId = $(this).attr("id-data"); // Mendapatkan ID dari tombol

        // Ambil data berdasarkan ID kosan (misalnya melalui AJAX)
        $.ajax({
            url: "/getKosan/" + kosanId, // Gantilah dengan URL yang sesuai untuk mengambil data kosan
            type: "GET",
            dataType: "json", // Pastikan data yang diterima dalam format JSON
            success: function (data) {
                // Mengecek apakah data valid
                if (data) {
                    // Isi data ke dalam modal dengan ID '_edit'
                    $("#kosan_edit").val(data.nama_kosan);
                    $("#harga_kosan_edit").val(data.harga);
                    $("#kamar_edit").val(data.kamar).change();
                    $("#pembayaran_edit").val(data.pembayaran).change();
                    $("#tanggal_pembayaran_edit").val(data.tanggal_pembayaran);
                    $("#editor_edit").val(data.deskripsi);
                    $("#lokasi_edit").val(data.lokasi);

                    $("#category_edit").val(data.category).change();

                    const $linkMapEdit = $("#link_map_edit");
                    const $mapPreviewIframeEdit = $("#mapPreviewIframe_edit");
                    const $mapPreviewEdit = $(".mapPreview_edit");

                    // Set value dari input link_map_edit
                    $linkMapEdit.val(data.map);

                    // Periksa jika URL valid
                    if (
                        $linkMapEdit
                            .val()
                            .includes("https://www.google.com/maps")
                    ) {
                        // Update src iframe dengan URL yang diberikan
                        $mapPreviewIframeEdit.attr("src", $linkMapEdit.val());
                        // Tampilkan elemen mapPreview jika URL valid
                        $mapPreviewEdit.show();
                    } else {
                        // Jika URL tidak valid, kosongkan iframe dan sembunyikan preview
                        $mapPreviewIframeEdit.attr("src", "");
                        $mapPreviewEdit.hide();
                    }

                    // Jika ada perubahan pada input, periksa lagi URL dan update iframe
                    $linkMapEdit.on("input", function () {
                        const link = $(this).val();
                        if (link.includes("https://www.google.com/maps")) {
                            // Update iframe dengan URL baru
                            $mapPreviewIframeEdit.attr("src", link);
                            $mapPreviewEdit.show();
                        } else {
                            // Jika URL tidak valid, kosongkan iframe dan sembunyikan preview
                            $mapPreviewIframeEdit.attr("src", "");
                            $mapPreviewEdit.hide();
                        }
                    });

                    // Menangani fasilitas yang berupa array JSON
                    var fasilitas = JSON.parse(data.fasilitas);
                    // Menampilkan fasilitas sebagai string yang dipisahkan koma
                    // $("#fasilitas_edit").val(fasilitas.join(", "));
                    displayTags(fasilitas);

                    // Menangani file upload yang berupa array JSON
                    var uploadFile = JSON.parse(data.upload_file);
                    console.log(uploadFile); // Menampilkan array file untuk debugging

                    // Menampilkan preview Map
                    $("#mapPreviewIframe_edit").attr("src", data.map).show();

                    // Menampilkan gambar-gambar yang ada dalam array
                    uploadFile.forEach(function (imagePath) {
                        var imgContainer = $("<div>")
                            .addClass("img-container")
                            .css("position", "relative")
                            .css("display", "inline-block")
                            .css("margin-right", "10px")
                            .css("margin-bottom", "10px");

                        var imgElement = $("<img>")
                            .attr("src", "storage/" + imagePath)
                            .css("width", "150px")
                            .css("height", "150px")
                            .css("margin-right", "10px")
                            .css("border-radius", "5px")
                            .css("object-position", "center")
                            .css("object-fit", "cover");

                        // Membuat ikon remove
                        var removeIcon = $("<div>")
                            .addClass("remove-icon")
                            .text("✖")
                            .css({
                                position: "absolute",
                                top: "50%",
                                left: "50%",
                                transform: "translate(-50%, -50%)",
                                color: "white",
                                "font-size": "20px",
                                "background-color": "rgba(0, 0, 0, 0.5)",
                                "border-radius": "50%",
                                width: "30px",
                                height: "30px",
                                display: "flex",
                                "justify-content": "center",
                                "align-items": "center",
                                cursor: "pointer",
                            });

                        // Menambahkan gambar dan ikon remove ke dalam kontainer
                        imgContainer.append(imgElement).append(removeIcon);

                        // Menambahkan gambar ke dalam kontainer
                        $("#gambar-container_edit").append(imgContainer);

                        // Menghapus gambar jika ikon remove diklik
                        removeIcon.on("click", function () {
                            imgContainer.remove();
                        });
                    });

                    // Menangani pemilihan gambar baru melalui input file
                    $("#gambar_edit").on("change", function (event) {
                        var files = event.target.files;
                        if (files.length > 0) {
                            // Menampilkan gambar yang dipilih pengguna
                            for (var i = 0; i < files.length; i++) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    var imgContainer = $("<div>")
                                        .addClass("img-container")
                                        .css("position", "relative")
                                        .css("display", "inline-block")
                                        .css("margin-right", "10px")
                                        .css("margin-bottom", "10px");

                                    var imgElement = $("<img>")
                                        .attr("src", e.target.result)
                                        .css("width", "150px")
                                        .css("height", "150px")
                                        .css("margin-right", "10px")
                                        .css("border-radius", "5px")
                                        .css("object-position", "center")
                                        .css("object-fit", "cover");

                                    // Membuat ikon remove
                                    var removeIcon = $("<div>")
                                        .addClass("remove-icon")
                                        .text("✖")
                                        .css({
                                            position: "absolute",
                                            top: "50%",
                                            left: "50%",
                                            transform: "translate(-50%, -50%)",
                                            color: "white",
                                            "font-size": "20px",
                                            "background-color":
                                                "rgba(0, 0, 0, 0.5)",
                                            "border-radius": "50%",
                                            width: "30px",
                                            height: "30px",
                                            display: "flex",
                                            "justify-content": "center",
                                            "align-items": "center",
                                            cursor: "pointer",
                                        });

                                    // Menambahkan gambar dan ikon remove ke dalam kontainer
                                    imgContainer
                                        .append(imgElement)
                                        .append(removeIcon);

                                    // Menambahkan gambar ke dalam kontainer
                                    $("#gambar-container_edit").append(
                                        imgContainer
                                    );

                                    removeIcon.on("click", function () {
                                        // Menghapus file terkait dari input
                                        var fileToRemove =
                                            imgContainer.data("file");
                                        var indexToRemove =
                                            Array.from(files).indexOf(
                                                fileToRemove
                                            );
                                        if (indexToRemove !== -1) {
                                            var dt = new DataTransfer();
                                            // Menyalin file-file yang tersisa
                                            for (
                                                var j = 0;
                                                j < files.length;
                                                j++
                                            ) {
                                                if (j !== indexToRemove) {
                                                    dt.items.add(files[j]);
                                                }
                                            }
                                            // Memperbarui input dengan file yang tersisa
                                            $("#gambar_edit")[0].files =
                                                dt.files;
                                        }

                                        // Menghapus gambar dari tampilan
                                        imgContainer.remove();

                                        // Mengecek jika tidak ada gambar yang tersisa
                                        if (
                                            $(
                                                "#gambar-container_edit"
                                            ).children().length === 0
                                        ) {
                                            // Jika tidak ada gambar, kosongkan input file
                                            $("#gambar_edit").val("");
                                        }
                                    });
                                };
                                reader.readAsDataURL(files[i]);
                            }
                        }
                    });

                    // Menampilkan modal
                    $("#editKosanModal").modal("show");
                } else {
                    alert("Data tidak valid!");
                }
            },
            error: function (xhr, status, error) {
                // Menangani kesalahan jika ada masalah dengan permintaan AJAX
                alert("Terjadi kesalahan: " + error);
            },
        });
    });

    // Fungsi untuk menampilkan tags berdasarkan fasilitas yang ada
    function displayTags(fasilitasArray) {
        // Clear previous tags
        $("#tagPreview_edit").empty();

        // Menambahkan fasilitas yang ada sebagai tag
        fasilitasArray.forEach(function (item) {
            var tagElement = $("<div>").addClass("tag").text(item);

            // Membuat tombol hapus untuk tag
            var removeButton = $("<span>")
                .addClass("remove-tag")
                .text("✖")
                .css({
                    cursor: "pointer",
                    marginLeft: "10px",
                    color: "white",
                });

            tagElement.append(removeButton);
            $("#tagPreview_edit").append(tagElement);

            // Menambahkan tag ke input hidden untuk dikirim
            updateHiddenInput_edit();
        });
    }

    // Menambahkan tag baru saat menekan tombol enter pada input fasilitas_edit
    $("#fasilitas_edit").on("keypress", function (event) {
        if (event.key === "Enter") {
            var input = $(this).val().trim();

            // Pastikan input tidak kosong
            if (input && input !== "") {
                var tagElement = $("<div>").addClass("tag").text(input);
                var removeButton = $("<span>")
                    .addClass("remove-tag")
                    .text("✖")
                    .css({
                        cursor: "pointer",
                        marginLeft: "10px",
                        color: "white",
                    });

                tagElement.append(removeButton);
                $("#tagPreview_edit").append(tagElement);
                $(this).val(""); // Kosongkan input setelah tag ditambahkan

                // Tangani klik pada tombol hapus
                removeButton.on("click", function () {
                    tagElement.remove();
                    updateHiddenInput_edit();
                });

                // Menambahkan tag ke input hidden untuk dikirim
                updateHiddenInput_edit();
            }

            event.preventDefault(); // Mencegah form submit atau reload ketika Enter ditekan
        }
    });

    // Fungsi untuk mengupdate input hidden dengan nilai fasilitas
    function updateHiddenInput_edit() {
        var tags = [];
        $("#tagPreview_edit .tag").each(function () {
            var tag = $(this).text().trim().replace("✖", ""); // Mengganti tanda silang dengan string kosong
            tags.push(tag);
        });
        $("input[name='fasilitas_edit']").val(JSON.stringify(tags)); // Menyimpan tag dalam format JSON array
    }

    $(document).on("click", ".remove-tag", function () {
        var tagElement = $(this).closest(".tag");
        tagElement.remove();
        updateHiddenInput_edit();
    });
});
