jQuery(document).ready(function($) {

    $('#mobile-open-menu-btn').on('click', function(){
        $('#mobile-overlay').addClass('active');
    });

    $('#mobile-close-menu-btn').on('click', function(){
        $('#mobile-overlay').removeClass('active');
    });

    $('.menu-item.menu-item-has-children').on('click', '> .droparrow', function(){
        $(this).closest('.menu-item.menu-item-has-children').toggleClass('open');
    })

    $('.mobile-menu .menu-item.menu-item-has-children').each(function(index){
        var droparrow = $('<span></span>').addClass('droparrow');
        $(this).prepend(droparrow);
    });

});