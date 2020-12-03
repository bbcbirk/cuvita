jQuery(document).ready( function($){

    /* contact form submission */
    $('#cuvitaContactForm').on('submit', function(e){
        
        e.preventDefault();

        var form = $(this),
            name = form.find('#name').val(),
            email = form.find('#email').val(),
            message = form.find('#message').val(),
            response_con = form.find('.response'),
            ajaxurl = form.data('url');

        if (name === '' || email === '' || message === '') {
            console.log('Required inputs are empty');
            return;
        }

        $.ajax({
            url : ajaxurl,
            type : 'post',
            data : {
                name : name,
                email : email,
                message : message,
                action: 'cuvita_save_user_contact_form'
            },
            error : function(response) {
                var alert = $('<p></p>').addClass('notice notice-danger').text(response);
                response_con.append(alert);
            },
            success : function(response) {
                var alert = $('<p></p>').addClass('notice notice-success').text('Message Sent!');
                response_con.append(alert);
            }
        });
    });
});