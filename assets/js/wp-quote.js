jQuery(document).ready(function($) {

    $(window).on('load', function() {
        $('.wp-block-quote').each(function(index){
            var spacer = $('<div></div>').addClass('wp-block-quote-container');
            $(this).wrap(spacer);
        });
    });

});