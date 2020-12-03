<?php
/**
 * @package cuvita
 * 
 * CUSTOM POST TYPES AND TAXONOMY
 */

$cuvita_activate_portfolio = esc_attr(get_option('cuvita_activate_portfolio'));
if (@$cuvita_activate_portfolio == 1) {
    add_action( 'init', 'cuvita_portfolio_cpt' );

    add_filter('manage_cuvita-portfolio_posts_columns', 'cuvita_set_portfolio_columns');
    add_action('manage_cuvita-portfolio_posts_custom_column', 'cuvita_portfolio_custom_column', 10, 2);

    add_action( 'add_meta_boxes', 'cuvita_add_portfolio_meta_box' );
    add_action( 'save_post', 'cuvita_save_project_settings_data', 1, 2 );
}
$cuvita_activate_contact = esc_attr(get_option('cuvita_activate_contact'));
if (@$cuvita_activate_contact == 1) {
    
    add_action('init', 'cuvita_contact_custom_post_type');

    add_filter('manage_cuvita-contact_posts_columns', 'cuvita_set_contact_columns');
    add_action('manage_cuvita-contact_posts_custom_column', 'cuvita_contact_custom_column', 10, 2);

    add_action('add_meta_boxes', 'cuvita_contact_add_meta_box');
    add_action('save_post', 'cuvita_save_contact_email_data');
}

$cuvita_activate_technologies = esc_attr(get_option('cuvita_activate_technologies'));
if (@$cuvita_activate_technologies == 1) {
    add_action( 'init', 'cuvita_taxonomy_skills' );
}

add_action( 'add_meta_boxes', 'cuvita_add_meta_box' );
add_action( 'save_post', 'cuvita_save_banner_tagline_data', 1, 2 );


/**
 * CPT
 */
function cuvita_portfolio_cpt() {

    $labels = array(
        'name'                      => __( 'Portfolio', 'cuvita' ),
        'singular_name'             => __( 'Project', 'cuvita' ),
        'add_new'                   => __( 'Add new', 'cuvita' ),
        'add_new_item'              => __( 'Add new project', 'cuvita' ),
        'edit_item'                 => __( 'Edit project', 'cuvita' ),
        'new_item'                  => __( 'New project', 'cuvita' ),
        'view_item'                 => __( 'Show project', 'cuvita' ),
        'view_items'                => __( 'Show projects', 'cuvita' ),
        'search_items'              => __( 'Search in portfolio', 'cuvita' ),
        'not_found'                 => __( 'No projects found.', 'cuvita' ),
        'not_found_in_trash'        => __( 'No projects found in trash.', 'cuvita' ),
        'parent_item_colon'         => __( 'Parent project', 'cuvita' ),
        'all_items'                 => __( 'All projects', 'cuvita' ),
        'archives'                  => __( 'Project Archives', 'cuvita' ),
        'attributes'                => __( 'Project Attributes', 'cuvita' ),
        'insert_into_item'          => __( 'Insert into project', 'cuvita' ),
        'uploaded_to_this_item'     => __( 'Uploaded to this project', 'cuvita' ),
        'featured_image'            => __( 'Project Banner Image', 'cuvita' ),
        'set_featured_image'        => __( 'Set banner image', 'cuvita' ),
        'remove_featured_image'     => __( 'Remove banner image', 'cuvita' ),
        'use_featured_image'        => __( 'Use as banner image', 'cuvita' ),
        'menu_name'                 => __( 'Portfolio', 'cuvita' ),
        'filter_items_list'         => __( 'Filter portfolio list', 'cuvita' ),
        'items_list_navigation'     => __( 'Portfolio list navigation', 'cuvita' ),
        'items_list'                => __( 'Portfolio list', 'cuvita' ),
        'name_admin_bar'            => __( 'Project', 'cuvita' ),
        'item_published'            => __( 'Project published.', 'cuvita' ),
        'item_published_privately'  => __( 'Project published privately.', 'cuvita' ),
        'item_reverted_to_draft'    => __( 'Project reverted to draft.', 'cuvita' ),
        'item_scheduled'            => __( 'Project scheduled.', 'cuvita' ),
        'item_updated'              => __( 'Project updated.', 'cuvita' ),
    );     
    $args = array(
        'label'                 => __( 'Portfolio', 'cuvita' ),
        'labels'                => $labels,
        'description'           => __( 'Portfolio CPT', 'cuvita' ),
        'public'                => true,
        'hierarchical'          => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_rest'          => true,
        'menu_position'         => 40,
        'menu_icon'             => 'dashicons-portfolio',
        'capability_type'       => 'post',
        'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'has_archive'           => true,
        'query_var'             => true,
        'can_export'            => true,
        'delete_with_user'      => false,
    );
    register_post_type('cuvita-portfolio', $args);
}

function cuvita_contact_custom_post_type() {
    $labels = array(
        'name'              => __( 'Messages', 'cuvita' ),
        'singular_name'     => __( 'Message', 'cuvita' ),
        'menu_name'         => __( 'Messages', 'cuvita' ),
        'name_admin_bar'    => __( 'Message', 'cuvita' ),
    );

    $args = array(
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'menu_position'     => 26,
        'menu_icon'         => 'dashicons-email-alt',
        'supports'          => array('title', 'editor', 'author'),
    );

    register_post_type('cuvita-contact', $args);
}

/**
 * CPT Columns
 */
function cuvita_set_portfolio_columns( $columns) {
    $newColumns = array();
    $newColumns['cb'] = $columns['cb'];
    $newColumns['img'] = '';
    $newColumns['title'] = $columns['title'];
    $newColumns['author'] = $columns['author'];
    $technologies = esc_attr(get_option('cuvita_activate_technologies'));
    if (@$technologies == 1) {
        $newColumns['techs'] = __( 'Tags / Technologies', 'cuvita' );
    } else {
        $newColumns['tags'] = $columns['tags'];
    }
    $newColumns['comments'] = $columns['comments'];
    $newColumns['date'] = $columns['date'];
    return $newColumns;
}
function cuvita_portfolio_custom_column($column, $post_id) {
    switch($column) {
        case 'img' :
            ?>
            <div class="post-container not-single">
                <img 
                    src="<?php echo has_post_thumbnail($post_id) ? esc_url(the_post_thumbnail_url($post_id)) : esc_url(get_template_directory_uri() . '/assets/images/blog_default.jpg'); ?>" 
                    alt="<?php echo has_post_thumbnail($post_id) ? get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true) : the_title(); ?>" 
                    class="post-thumbnail img-greyed">
                <div class="post-content">
                    <h2 class="post-title color__light_shade"><?php the_title(); ?></h2>
                    <a href="<?php echo esc_url(get_edit_post_link($post_id)); ?>" class="link-btn color__light_shade"><?php _e( 'See More', 'cuvita' ); ?></a>
                </div>
            </div>
            <?php
            break;
        case 'techs' :
            $tags = wp_get_post_terms($post_id, array('post_tag'));
            $techs = wp_get_post_terms($post_id, array('techs'));
            $posttype = get_post_type($post_id) == 'post' ? '': 'post_type='.get_post_type($post_id);
            if ($tags || $techs) {

                if($tags) {
                    for ($i=0; $i < count($tags); $i++) { 
                        ?>
                        <a 
                            href="<?php 
                            echo bloginfo('url') .'/wp-admin/edit.php?';
                            echo $posttype != '' ? $posttype.'&': '';
                            echo 'tag='.$tags[$i]->slug;
                            ?>">
                            <?php echo $tags[$i]->name; ?>
                        </a>
                        <?php
                        echo $i+1 == count($tags) ? '' : ', ';
                    }
                    if($techs) {
                        echo '<br/><hr/>';
                    }
                } 
                
                
                if($techs) {
                    for ($i=0; $i < count($techs); $i++) {
                        ?>
                        <a 
                            href="<?php 
                            echo bloginfo('url') .'/wp-admin/edit.php?';
                            echo $posttype != '' ? $posttype.'&': '';
                            echo 'techs='.$techs[$i]->slug;
                            ?>">
                            <?php echo $techs[$i]->name; ?>
                        </a>
                        <?php 
                        echo $i+1 == count($techs) ? '' : ', ';
                    }
                }

            } else {
                _e('&#8212;', 'cuvita');
            }
            
            break;
    }
}

function cuvita_set_contact_columns( $columns) {
    $newColumns = array();
    $newColumns['title'] = __('Full Name', 'cuvita');
    $newColumns['message'] = __('Message', 'cuvita');
    $newColumns['email'] = __('E-mail', 'cuvita');
    $newColumns['date'] = __('Date', 'cuvita');
    return $newColumns;
}

function cuvita_contact_custom_column($column, $post_id) {
    switch($column) {
        case 'message' :
            echo get_the_excerpt();
            break;

        case 'email' :
            $email = get_post_meta($post_id, '_contact_email_value_key', true);
            echo '<a href="mailto:' . $email . '">' . $email . '</a>';
            break;
    }
}


/**
 * Meta Boxes
 */
function cuvita_add_meta_box() {
    $screens = [ 'post', 'page' ];
    $portfolio = esc_attr(get_option('cuvita_activate_portfolio'));
    if (@$portfolio == 1) {
        array_push($screens, 'cuvita-portfolio');
    }
    foreach ( $screens as $screen ) {
        add_meta_box(
            'cuvita_banner_tagline',                
            __( 'Tagline', 'cuvita' ),     
            'cuvita_banner_tagline_html',  
            $screen,  
            'side',                          
        );
    }
}

function cuvita_add_portfolio_meta_box() {
    $screens = [ 'cuvita-portfolio' ];
    foreach ( $screens as $screen ) {
        add_meta_box(
            'cuvita_project_settings',                
            __( 'Project Meta Settings', 'cuvita' ),     
            'cuvita_project_settings_html',  
            $screen,                            
        );
    }
}

function cuvita_contact_add_meta_box() {
    add_meta_box('contact_email', __( 'User Email', 'cuvita' ), 'bandbooking_contact_email_callback', 'bandbooking-contact', 'side');
}


/**
 * Metabox Callback
 */
function _cuvita_project_settings_defaults() {
    return array(
        'web_link' => '',
        'gallery'  => '',
    );
}

function cuvita_project_settings_html($post) {
    wp_nonce_field('cuvita_save_project_settings_data', 'cuvita_project_settings_meta_box_nonce', true, true);

    $saved = get_post_meta($post->ID, '_project_settings_value_key', true);
    $defaults = _cuvita_project_settings_defaults();
    $value = wp_parse_args( $saved, $defaults );

    ?>
    <fieldset>
        <div>
            <p>
                <label for="_cuvita_project_settings_web_link">
                    <?php
                        _e( 'Web Link', 'cuvita' );
                    ?>
                </label>
                <input 
                    type="text"
                    name="_cuvita_project_settings[web_link]"
                    id="_cuvita_project_settings_web_link"
                    value="<?php echo esc_attr( $value['web_link'] ); ?>"
                >
            </p>
        </div>

        <div>
            <label for="_cuvita_project_settings_gallery_manage"><?php _e( 'Project Gallery', 'cuvita' ); ?></label>
            <p class="separator gallery_buttons" style="display: inline-block;">
                <input id="_cuvita_project_settings_gallery" type="hidden" class="custom-gal-sc" name="_cuvita_project_settings[gallery]" value="<?php echo esc_attr( $value['gallery'] ); ?>" />
                <input id="_cuvita_project_settings_gallery_manage" title="<?php _e( 'Manage gallery', 'cuvita' ); ?>" type="button" class="button upload-custom-gal <?php echo $value['gallery'] != '' ? '' : 'empty-gal'; ?>" value="<?php _e( 'Manage gallery', 'cuvita' ); ?>" />
                <input title="<?php _e( 'Empty gallery', 'cuvita' ); ?>" type="button" class="button delete-custom-gal <?php echo $value['gallery'] != '' ? '' : 'empty-gal'; ?>" value="<?php _e( 'Empty gallery', 'cuvita' ); ?>" />
            </p>
            <div class="separator custom-gal-container">
                <?php
                echo do_shortcode($value['gallery']);
                ?>
            </div>
            <p class="separator gallery_buttons gallery_buttons_bottom <?php echo $value['gallery'] != '' ? '' : 'empty-gal'; ?>">
                <input id="_cuvita_project_settings_gallery_manage" title="<?php _e( 'Manage gallery', 'cuvita' ); ?>" type="button" class="button upload-custom-gal <?php echo $value['gallery'] != '' ? '' : 'empty-gal'; ?>" value="<?php _e( 'Manage gallery', 'cuvita' ); ?>" />
                <input title="<?php _e( 'Empty gallery', 'cuvita' ); ?>" type="button" class="button delete-custom-gal <?php echo $value['gallery'] != '' ? '' : 'empty-gal'; ?>" value="<?php _e( 'Empty gallery', 'cuvita' ); ?>" />
            </p>
        </div>

    </fieldset>
    <?php
}

function _cuvita_banner_tagline_defaults() {
    return array(
        'tagline' => '',
        'show_downloadcv' => '',
    );
}
function cuvita_banner_tagline_html($post) {
    wp_nonce_field('cuvita_save_banner_tagline_data', 'cuvita_banner_tagline_meta_box_nonce', true, true);

    $saved = get_post_meta($post->ID, '_banner_tagline_value_key', true);
    $defaults = _cuvita_banner_tagline_defaults();
    $value = wp_parse_args( $saved, $defaults );

    ?>
    <fieldset>
        <div>
            <p>
                <input 
                    type="text"
                    name="_cuvita_banner_tagline[tagline]"
                    id="_cuvita_banner_tagline_tagline"
                    value="<?php echo esc_attr( $value['tagline'] ); ?>"
                >
            </p>
        </div>
        <div>
            <p>
                <?php
                $checked = esc_attr( $value['show_downloadcv'] ) == '1' ? 'checked' : '';
                ?>
                <label>
                    <input type="checkbox" name="_cuvita_banner_tagline[show_downloadcv]" id="_cuvita_banner_tagline_show_downloadcv" value="1" <?php echo $checked ?> >
                    &nbsp;
                    <?php _e('Show resume download link', 'cuvita'); ?>
                </label>
            </p>
        </div>
    </fieldset>
    <?php
}

function cuvita_contact_email_callback($post) {
    wp_nonce_field('cuvita_save_contact_email_data', 'cuvita_contact_email_meta_box_nonce');

    $value = get_post_meta($post->ID, '_contact_email_value_key', true);

    ?>
    <p>
        <label for="cuvita_contact_email_field"><?php _e( 'User Email Address:', 'cuvita' ); ?></label>
        <input type="email" id="cuvita_contact_email_field" name="cuvita_contact_email_field" value="<?php echo esc_attr($value); ?>" size="25" />
    </p>
    <?php
}



/**
 * Meta Save Data Callback
 */
function cuvita_save_project_settings_data($post_id, $post) {
    if ( ! isset( $_POST['cuvita_project_settings_meta_box_nonce'] ) ) {
        return;
    }
 
    if ( ! wp_verify_nonce( $_POST['cuvita_project_settings_meta_box_nonce'], 'cuvita_save_project_settings_data' ) ) {
        return;
    }
 
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
 
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
 
    if ( ! isset( $_POST['_cuvita_project_settings'] ) ) {
        return;
    }

    $sanitized = array();
    foreach ($_POST['_cuvita_project_settings'] as $key => $value) {
        $sanitized[$key] = sanitize_text_field( wp_unslash($value) );
    }
 
    update_post_meta($post->ID, '_project_settings_value_key', $sanitized);
}

function cuvita_save_banner_tagline_data($post_id, $post) {
    if ( ! isset( $_POST['cuvita_banner_tagline_meta_box_nonce'] ) ) {
        return;
    }
 
    if ( ! wp_verify_nonce( $_POST['cuvita_banner_tagline_meta_box_nonce'], 'cuvita_save_banner_tagline_data' ) ) {
        return;
    }
 
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
 
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
 
    if ( ! isset( $_POST['_cuvita_banner_tagline'] ) ) {
        return;
    }

    $sanitized = array();
    foreach ($_POST['_cuvita_banner_tagline'] as $key => $value) {
        $sanitized[$key] = sanitize_text_field( wp_unslash($value) );
    }
 
    update_post_meta($post->ID, '_banner_tagline_value_key', $sanitized);
}

function cuvita_save_contact_email_data($post_id) {
    if (!isset($_POST['cuvita_contact_email_meta_box_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['cuvita_contact_email_meta_box_nonce'], 'cuvita_save_contact_email_data')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if(!isset($_POST['cuvita_contact_email_field'])) {
        return;
    }

    $my_data = sanitize_text_field($_POST['cuvita_contact_email_field']);

    update_post_meta($post_id, '_contact_email_value_key', $my_data);
}


/**
 * Taxonomy
 */
function cuvita_taxonomy_skills() {
    $labels = array(
        'name'                          => __( 'Technologies', 'cuvita' ),
        'singular_name'                 => __( 'Technology', 'cuvita' ),
        'search_items'                  => __( 'Search technologies', 'cuvita' ),
        'all_items'                     => __( 'All technologies', 'cuvita' ),
        'edit_item'                     => __( 'Edit technology', 'cuvita' ),
        'view_item'                     => __( 'View technology', 'cuvita' ),
        'update_item'                   => __( 'Update technology', 'cuvita' ),
        'add_new_item'                  => __( 'Add new technology', 'cuvita' ),
        'new_item_name'                 => __( 'New technology name', 'cuvita' ),
        'separate_items_with_commas'    => __( 'Separate technologies with commas', 'cuvita' ),
        'add_or_remove_items'           => __( 'Add or remove technologies', 'cuvita' ),
        'choose_from_most_used'         => __( 'Choose from most used technologies', 'cuvita' ),
        'not_found'                     => __( 'No technologies found', 'cuvita' ),
        'no_terms'                      => __( 'No technologies', 'cuvita' ),
        'items_list_navigation'         => __( 'Technology list navigation', 'cuvita' ),
        'items_list'                    => __( 'Technology list', 'cuvita' ),
        'most_used'                     => __( 'Most used', 'cuvita' ),
        'back_to_items'                 => __( 'Back to technologies', 'cuvita' ),
        'menu_name'                     => __( 'Technologies', 'cuvita' ),
    );
    $args   = array(
        'labels'                => $labels,
        'description'           => __( 'Technologies used for projects, like WordPress or PHP', 'cuvita' ),
        'public'                => true,
        'publicly_queryable'    => $labels,
        'hierarchical'          => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_rest'          => true,
        'show_tagcloud'         => true,
        'show_in_quick_edit'    => true,
        'show_admin_column'     => false,
        'query_var'             => true,
    );

    $types = [ 'post' ];
    $portfolio = esc_attr(get_option('cuvita_activate_portfolio'));
    if (@$portfolio == 1) {
        array_push($types, 'cuvita-portfolio');
    }
    register_taxonomy( 'techs', $types, $args );
}