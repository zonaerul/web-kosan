$(document).ready(function () {
    const $editor = $("#editor");
    const $lineNumbers = $(".line-numbers");

    // Fungsi untuk memperbarui line numbers
    function updateLineNumbers() {
        const lines = $editor.val().split("\n");
        $lineNumbers.empty();
        lines.forEach((line, index) => {
            $lineNumbers.append(`<div>${index + 1}</div>`);
        });
    }

    // Fungsi untuk memformat input di textarea
    $editor.on("input", function () {
        let text = $editor.val();

        // Mengganti tanda minus dengan bullet point (memformat input)
        const lines = text.split("\n").map(function (line) {
            if (line.trim().startsWith("-")) {
                return "• " + line.slice(1).trim(); // Mengganti '-' menjadi bullet point '•'
            }
            return line;
        });

        $editor.val(lines.join("\n"));

        // Update nomor baris
        updateLineNumbers();
    });

    // Panggil updateLineNumbers saat halaman dimuat
    updateLineNumbers();


    const $editor_edit = $("#editor_edit");
    const $lineNumbers_edit = $(".line-numbers_edit");

    // Fungsi untuk memperbarui line numbers
    function updateLineNumbersEdit() {
        const lines = $editor_edit.val().split("\n");
        $lineNumbers_edit.empty();
        lines.forEach((line, index) => {
            $lineNumbers_edit.append(`<div>${index + 1}</div>`);
        });
    }

    // Fungsi untuk memformat input di textarea
    $editor_edit.on("input", function () {
        let text = $editor_edit.val();

        // Mengganti tanda minus dengan bullet point (memformat input)
        const lines = text.split("\n").map(function (line) {
            if (line.trim().startsWith("-")) {
                return "• " + line.slice(1).trim(); // Mengganti '-' menjadi bullet point '•'
            }
            return line;
        });

        $editor_edit.val(lines.join("\n"));

        // Update nomor baris
        updateLineNumbersEdit();
    });

    // Panggil updateLineNumbers saat halaman dimuat
    updateLineNumbersEdit();
});
