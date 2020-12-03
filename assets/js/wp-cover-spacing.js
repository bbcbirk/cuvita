jQuery(document).ready(function($) {

    function resizespacer() {
        $('.spacer').each(function(index){
            $(this).height($(this).prev().outerHeight());
        });
    }

    $(window).on('load', function() {
        $('.alignwide, .alignfull').not('.wp-block-embed').each(function(index){
            var spacer = $('<div></div>').addClass('spacer');
            spacer.height($(this).outerHeight());
            spacer.insertAfter($(this));
        });
    });

    $( window ).resize(function() {
        resizespacer();
    });
});