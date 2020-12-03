jQuery(function ($) {

    var metaBox = $('#cuvita_project_settings.postbox'), // Your meta box id here
        addGalLink = metaBox.find('.upload-custom-gal'),
        delGalLink = metaBox.find('.delete-custom-gal'),
        btnBottomContainer = metaBox.find('.gallery_buttons_bottom'),
        galContainer = metaBox.find('.custom-gal-container'),
        galScInput = metaBox.find('.custom-gal-sc');


    addGalLink.on('click', function (e) {
        e.preventDefault();

        var $this = $(e.currentTarget);
        if (!$this.data('lockedAt') || +new Date() - $this.data('lockedAt') > 300) { // Doubleclick prevent.
            var gallerySc = galScInput.val() != '' ? galScInput.val() : '[gallery ]';

            wp.media.gallery.edit(gallerySc).on('update', function (frame) {

                //Shortcode Params
                var gal_order = 'order="' + frame.gallery.attributes.order + '" ',
                    gal_columns = 'columns="' + frame.gallery.attributes.columns + '" ',
                    gal_id = 'id="' + frame.gallery.attributes.id + '" ',
                    gal_size = 'size="' + frame.gallery.attributes.size + '" ',
                    gal_itemtag = 'itemtag="' + frame.gallery.attributes.itemtag + '" ',
                    gal_icontag = 'icontag="' + frame.gallery.attributes.icontag + '" ',
                    gal_captiontag = 'captiontag="' + frame.gallery.attributes.captiontag + '" ',
                    gal_link = 'link="' + frame.gallery.attributes.link + '" ';

                var id_array = [];
                $.each(frame.models, function (id, img) {
                    id_array.push(img.id);
                });
                var gal_ids = 'ids="' + id_array.join(",") + '" ';

                var sc = '[gallery ' +
                    gal_order +
                    gal_columns +
                    gal_id +
                    gal_size +
                    gal_itemtag +
                    gal_icontag +
                    gal_captiontag +
                    gal_link +
                    gal_ids +
                    ']';

                galScInput.val(sc);

                if (id_array.length <= 0) {
                    addGalLink.addClass('empty-gal');
                    delGalLink.addClass('empty-gal');
                    btnBottomContainer.addClass('empty-gal');
                } else {
                    addGalLink.removeClass('empty-gal');
                    delGalLink.removeClass('empty-gal');
                    btnBottomContainer.removeClass('empty-gal');
                }
                //Generate Preview
                generate_gallery(frame, galContainer);

            });
        }

        $this.data('lockedAt', +new Date());
    });

    delGalLink.on('click', function (e) {
        e.preventDefault();
        galScInput.val('');
        galContainer.html('');
        addGalLink.addClass('empty-gal');
        delGalLink.addClass('empty-gal');
        btnBottomContainer.addClass('empty-gal');
    });

    function generate_gallery(frame, container) {
        var gal = $('<div></div>').attr('id', 'gallery-new').addClass('gallery galleryid-' + frame.gallery.attributes.id + ' gallery-columns-' + frame.gallery.attributes.columns + ' gallery-size-' + frame.gallery.attributes.size);
        $.each(frame.models, function (index, item) {
            var gal_item = $('<' + frame.gallery.attributes.itemtag + '></' + frame.gallery.attributes.itemtag + '>').addClass('gallery-item');
            var icon = $('<' + frame.gallery.attributes.icontag + '></' + frame.gallery.attributes.icontag + '>').addClass('gallery-icon');
            var anchor = $('<a></a>').attr('href', item.attributes.link)
            var img = $('<img>').attr({
                'alt': item.attributes.alt,
                'loading': 'lazy',
                'aria-describedby': 'gallery-new-' + item.attributes.id
            }).addClass('attachment-' + frame.gallery.attributes.size + ' size-' + frame.gallery.attributes.size);
            var caption = $('<' + frame.gallery.attributes.captiontag + '></' + frame.gallery.attributes.captiontag + '>').addClass('wp-caption-text gallery-caption').attr('id', 'gallery-new-' + item.attributes.id).text(item.attributes.caption);
            switch (frame.gallery.attributes.size) {
                case 'full':
                    if (item.attributes.sizes.full) {
                        icon.addClass(item.attributes.sizes.full.orientation);
                        img.attr({
                            'src': item.attributes.sizes.full.url,
                            'width': item.attributes.sizes.full.width,
                            'height': item.attributes.sizes.full.height,
                            'sizes': '(max-width: ' + item.attributes.sizes.full.width + 'px) 100vw, ' + item.attributes.sizes.full.width + 'px'
                        });
                    } else {
                        icon.addClass(item.attributes.orientation);
                        img.attr({
                            'src': item.attributes.url,
                            'width': item.attributes.width,
                            'height': item.attributes.height,
                            'sizes': '(max-width: ' + item.attributes.width + 'px) 100vw, ' + item.attributes.width + 'px'
                        });
                    }

                    break;
                case 'large':
                    if (item.attributes.sizes.large) {
                        icon.addClass(item.attributes.sizes.large.orientation);
                        img.attr({
                            'src': item.attributes.sizes.large.url,
                            'width': item.attributes.sizes.large.width,
                            'height': item.attributes.sizes.large.height,
                            'sizes': '(max-width: ' + item.attributes.sizes.large.width + 'px) 100vw, ' + item.attributes.sizes.large.width + 'px'
                        });
                    } else {
                        icon.addClass(item.attributes.orientation);
                        img.attr({
                            'src': item.attributes.url,
                            'width': item.attributes.width,
                            'height': item.attributes.height,
                            'sizes': '(max-width: ' + item.attributes.width + 'px) 100vw, ' + item.attributes.width + 'px'
                        });
                    }

                    break;
                case 'medium':
                    if (item.attributes.sizes.medium) {
                        icon.addClass(item.attributes.sizes.medium.orientation);
                        img.attr({
                            'src': item.attributes.sizes.medium.url,
                            'width': item.attributes.sizes.medium.width,
                            'height': item.attributes.sizes.medium.height,
                            'sizes': '(max-width: ' + item.attributes.sizes.medium.width + 'px) 100vw, ' + item.attributes.sizes.medium.width + 'px'
                        });
                    } else {
                        icon.addClass(item.attributes.orientation);
                        img.attr({
                            'src': item.attributes.url,
                            'width': item.attributes.width,
                            'height': item.attributes.height,
                            'sizes': '(max-width: ' + item.attributes.width + 'px) 100vw, ' + item.attributes.width + 'px'
                        });
                    }
                    break;
                case 'thumbnail':
                    if (item.attributes.sizes.thumbnail) {
                        icon.addClass(item.attributes.sizes.thumbnail.orientation);
                        img.attr({
                            'src': item.attributes.sizes.thumbnail.url,
                            'width': item.attributes.sizes.thumbnail.width,
                            'height': item.attributes.sizes.thumbnail.height,
                            'sizes': '(max-width: ' + item.attributes.sizes.thumbnail.width + 'px) 100vw, ' + item.attributes.sizes.thumbnail.width + 'px'
                        });
                    } else {
                        icon.addClass(item.attributes.orientation);
                        img.attr({
                            'src': item.attributes.url,
                            'width': item.attributes.width,
                            'height': item.attributes.height,
                            'sizes': '(max-width: ' + item.attributes.width + 'px) 100vw, ' + item.attributes.width + 'px'
                        });
                    }
                    break;
                default:
                    icon.addClass(item.attributes.orientation);
                    img.attr({
                        'src': item.attributes.url,
                        'width': item.attributes.width,
                        'height': item.attributes.height,
                        'sizes': '(max-width: ' + item.attributes.width + 'px) 100vw, ' + item.attributes.width + 'px'
                    });
                    break;
            }
            anchor.append(img);
            icon.append(anchor);
            gal_item.append(icon);
            gal_item.append(caption);
            gal.append(gal_item);
            if ((index + 1) % frame.gallery.attributes.columns == 0) {
                gal.append($('<br style="clear: both">'));
            }
        });
        gal.append($('<br style="clear: both">'));

        container.html(gal);
    }

});