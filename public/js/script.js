$(document).ready(function () {
    console.log("Script.js is connected!"); // Cek di konsol

    $(".image-container").each(function() {
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

        // Menambahkan ikon silang ke dalam div gambar
        $(this).append(removeIcon);

        // Event handler untuk menghapus gambar
        removeIcon.on("click", function () {
            $(this).parent().remove(); // Menghapus div gambar dan ikon
        });
    });
    $("#gambar").on("change", function () {
        // Mengambil file yang dipilih
        var files = this.files;

        // Kosongkan kontainer gambar sebelum menampilkan gambar baru
        $("#gambar-container").empty();

        // Loop untuk setiap file yang dipilih
        $.each(files, function (index, file) {
            var reader = new FileReader();

            // Setelah file dibaca, tampilkan gambar di container
            reader.onload = function (e) {
                // Membuat elemen div sebagai kontainer untuk gambar dan ikon remove
                var imgContainer = $("<div>")
                    .addClass("img-container")
                    .css("position", "relative")
                    .css("display", "inline-block")
                    .css("margin-right", "10px")
                    .css("margin-bottom", "10px");

                // Membuat elemen img baru
                var imgElement = $("<img>")
                    .attr("src", e.target.result)
                    .css("width", "150px")
                    .css("height", "150px")
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

                // Menambahkan kontainer gambar ke dalam #gambar-container
                $("#gambar-container").append(imgContainer);

                // Fungsi untuk menghapus gambar ketika ikon remove diklik
                removeIcon.on("click", function () {
                    // Menghapus file terkait dari input
                    var indexToRemove = Array.from(files).indexOf(file);
                    if (indexToRemove !== -1) {
                        var dt = new DataTransfer();
                        // Menyalin file-file yang tersisa
                        for (var i = 0; i < files.length; i++) {
                            if (i !== indexToRemove) {
                                dt.items.add(files[i]);
                            }
                        }
                        // Memperbarui input dengan file yang tersisa
                        $("#gambar")[0].files = dt.files;
                    }

                    // Menghapus gambar dari tampilan
                    imgContainer.remove();

                    // Mengecek jika tidak ada gambar yang tersisa
                    if ($("#gambar-container").children().length === 0) {
                        // Jika tidak ada gambar, kosongkan input file
                        $("#gambar").val("");
                    }
                });
            };

            // Membaca file sebagai URL data
            reader.readAsDataURL(file);
        });
    });

    $("#addKosanButton").on("click", function () {
        $("#modelAdd").modal("show");
    });

    $("#harga_kosan").on("input", function () {
        var harga = $(this).val().replace(/\D/g, "");
        var hargaRupiah = new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
        }).format(harga);
        $(this).val(hargaRupiah.replace(/,00$/, ""));
    });
    $(document).ready(function () {
        // Event untuk menambahkan tag ketika tombol ditekan (misalnya, Enter)
        $("#fasilitas").on("keypress", function (event) {
            // Periksa jika tombol yang ditekan adalah Enter
            if (event.key === "Enter") {
                var input = $(this).val().trim();
    
                // Pastikan input tidak kosong
                if (input && input !== "") {
                    // Membuat elemen tag baru
                    var tagElement = $("<div>").addClass("tag").text(input);
                    
                    // Membuat tombol hapus untuk tag
                    var removeButton = $("<span>").addClass("remove-tag").text("✖").css({
                        "cursor": "pointer",
                        "margin-left": "10px",
                        "color": "white"
                    });
    
                    // Menambahkan tombol hapus ke dalam tag
                    tagElement.append(removeButton);
    
                    // Menambahkan tag ke dalam elemen preview (misalnya, tagPreview)
                    $(".tagPreview").append(tagElement);
    
                    // Kosongkan input setelah tag ditambahkan
                    $(this).val("");
    
                    // Tangani klik pada tombol hapus
                    removeButton.on("click", function () {
                        // Menghapus tag ketika tombol hapus diklik
                        tagElement.remove();
                        updateHiddenInput();
                    });
    
                    // Menambahkan tag ke input hidden untuk dikirim
                    updateHiddenInput();
                }
    
                // Mencegah form submit atau reload ketika Enter ditekan
                event.preventDefault();
            }
        });
    
        // Fungsi untuk memperbarui nilai input hidden dengan tag yang ada dalam format JSON array
        function updateHiddenInput() {
            var tags = [];
            $(".tag").each(function() {
                // Menghilangkan tanda silang dari teks tag
                var tag = $(this).text().trim().replace('✖', ''); // Mengganti tanda silang dengan string kosong
                tags.push(tag);
            });
            
            // Menyimpan tag dalam format JSON array ke dalam input hidden
            $("input[name='fasilitas']").val(JSON.stringify(tags));
        }
        
    });
    
});
