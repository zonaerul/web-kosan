$(document).ready(function() {
    // Mengambil elemen input dan iframe
    const $linkMap = $("#link_map");
    const $mapPreviewIframe = $("#mapPreviewIframe");
    const $mapPreview = $(".mapPreview");

    // Event handler untuk perubahan input
    $linkMap.on("input", function() {
        // Mendapatkan nilai URL dari input
        const mapLink = $linkMap.val();

        // Mengecek apakah URL tersebut valid dan memiliki bagian yang tepat untuk Google Maps
        if (mapLink.includes("https://www.google.com/maps")) {
            // Update src iframe dengan URL yang diberikan
            $mapPreviewIframe.attr("src", mapLink);
            // Tampilkan elemen mapPreview jika URL valid
            $mapPreview.show();
        } else {
            // Jika URL tidak valid, kosongkan iframe dan sembunyikan preview
            $mapPreviewIframe.attr("src", "");
            $mapPreview.hide();
        }
    });

});
