jQuery(function ($) {

    // Set all variables to be used in scope
    var frame,
        metaBox = $('#cuvita-site-options-banner'), // Your meta box id here
        addImgLink = metaBox.find('.upload-banner'),
        delImgLink = metaBox.find('.delete-banner'),
        imgContainer = $('#site-settings-preview').find('.featured-image'),
        imgIdInput = metaBox.find('.cuvita_frontpage_banner-id');

    // ADD IMAGE LINK
    addImgLink.on('click', function (event) {

        event.preventDefault();

        // If the media frame already exists, reopen it.
        if (frame) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Banner',
            button: {
                text: 'Use Banner'
            },
            multiple: false
        });


        // When an image is selected in the media frame...
        frame.on('select', function () {

            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();

            // Send the attachment URL to our custom image input field.
            imgContainer.attr('src', attachment.url);

            // Send the attachment id to our hidden input
            imgIdInput.val(attachment.id);

            // Hide the add image link
            addImgLink.addClass('hidden');

            // Unhide the remove image link
            delImgLink.removeClass('hidden');
        });

        // Finally, open the modal on click
        frame.open();
    });


    // DELETE IMAGE LINK
    delImgLink.on('click', function (event) {

        event.preventDefault();

        // Clear out the preview image
        imgContainer.attr('src', '').css('background-color', '#272b36');

        // Un-hide the add image link
        addImgLink.removeClass('hidden');

        // Hide the delete image link
        delImgLink.addClass('hidden');

        // Delete the image id from the hidden input
        imgIdInput.val('');

    });

    // Set all variables to be used in scope
    var logo_frame,
        logo_metaBox = $('#cuvita-site-options-logo'), // Your meta box id here
        logo_addImgLink = logo_metaBox.find('.upload-logo'),
        logo_delImgLink = logo_metaBox.find('.delete-logo'),
        logo_imgContainer = $('#site-settings-preview').find('.img-con'),
        logo_imgIdInput = logo_metaBox.find('.cuvita_logo-id');

    // ADD IMAGE LINK
    logo_addImgLink.on('click', function (event) {

        event.preventDefault();

        // If the media logo_frame already exists, reopen it.
        if (logo_frame) {
            logo_frame.open();
            return;
        }

        // Create a new media logo_frame
        logo_frame = wp.media({
            title: 'Select or Upload Logo',
            button: {
                text: 'Use Logo'
            },
            multiple: false
        });


        // When an image is selected in the media logo_frame...
        logo_frame.on('select', function () {

            // Get media attachment details from the logo_frame state
            var attachment = logo_frame.state().get('selection').first().toJSON();

            // Send the attachment URL to our custom image input field.
            logo_imgContainer.html('<img src="' + attachment.url + '" alt="" class="mobile-logo"/>');

            // Send the attachment id to our hidden input
            logo_imgIdInput.val(attachment.id);

            // Hide the add image link
            logo_addImgLink.addClass('hidden');

            // Unhide the remove image link
            logo_delImgLink.removeClass('hidden');
        });

        // Finally, open the modal on click
        logo_frame.open();
    });


    // DELETE IMAGE LINK
    logo_delImgLink.on('click', function (event) {

        event.preventDefault();

        // Clear out the preview image
        logo_imgContainer.html('');

        // Un-hide the add image link
        logo_addImgLink.removeClass('hidden');

        // Hide the delete image link
        logo_delImgLink.addClass('hidden');

        // Delete the image id from the hidden input
        logo_imgIdInput.val('');

    });


    // Set all variables to be used in scope
    var cv_frame,
        cv_metaBox = $('#cuvita-site-options-cuvita_cv_upload'), // Your meta box id here
        addCvLink = cv_metaBox.find('.upload-cv'),
        delCvLink = cv_metaBox.find('.delete-cv'),
        cvContainer = cv_metaBox.find('.cvname'),
        cvIdInput = cv_metaBox.find('.cuvita_cv_upload');

    // ADD IMAGE LINK
    addCvLink.on('click', function (event) {

        event.preventDefault();

        // If the media frame already exists, reopen it.
        if (cv_frame) {
            cv_frame.open();
            return;
        }

        // Create a new media frame
        cv_frame = wp.media({
            title: 'Select or Upload Resume',
            button: {
                text: 'Use File'
            },
            library: {
                // mime type. e.g. 'image', 'image/jpeg'
                type: ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessing' ],
            },
            multiple: false
        });


        // When an image is selected in the media frame...
        cv_frame.on('select', function () {

            // Get media attachment details from the frame state
            var attachment = cv_frame.state().get('selection').first().toJSON();

            // Send the attachment URL to our custom image input field.
            cvContainer.html(attachment.filename);

            // Send the attachment id to our hidden input
            cvIdInput.val(attachment.id);

            // Hide the add image link
            addCvLink.addClass('hidden');

            // Unhide the remove image link
            delCvLink.removeClass('hidden');
        });

        // Finally, open the modal on click
        cv_frame.open();
    });


    // DELETE IMAGE LINK
    delCvLink.on('click', function (event) {

        event.preventDefault();

        // Clear out the preview image
        cvContainer.html();

        // Un-hide the add image link
        addCvLink.removeClass('hidden');

        // Hide the delete image link
        delCvLink.addClass('hidden');

        // Delete the image id from the hidden input
        cvIdInput.val('');

    });

    $('#cuvita_frontpage_title').on('input', function(){
        $('h1.banner-title').html($(this).val());
    });

    $('#cuvita_frontpage_tagline').on('input', function(){
        $('h3.banner-tagline').html($(this).val());
    });

});