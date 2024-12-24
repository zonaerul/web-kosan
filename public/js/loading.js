$(document).ready(function(){
    $(window).on('load', function() {
        setTimeout(function() {
            $('.overflow').fadeOut(); // Menghilangkan overlay dengan efek fade
        }, 1000); // 5000 ms = 5 detik
    });
});