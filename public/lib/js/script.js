jQuery(document).ready(function( $ ) {

    $(window).scroll(function() {
        $('.si').each(function() {
            var imagePos = $(this).offset().top;

            var topOfWindow = $(window).scrollTop();
            if (imagePos < topOfWindow + 400) {
                $(this).addClass("slideUp");
            }
        });
    });
    //$('#headerwrap h1').fadeIn(100);
    $('#headerwrap h1').slideDown('5000');
    $('#headerwrap h3').slideDown('8000');
    $('#headerwrap2 h1').slideDown('5000');
    $('#headerwrap2 h5').slideDown('8000');
    $('#toTTS').fadeIn(4000);
    $('#toSTT').fadeIn(4500);


});