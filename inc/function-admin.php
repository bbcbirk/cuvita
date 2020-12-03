<?php
/**
 * @package cuvita
 * 
 * ADMIN PAGE
 */

add_action('admin_menu', 'cuvita_add_admin_page');
add_action('admin_init', 'cuvita_custom_settings');

$cuvita_activate_cv = esc_attr(get_option('cuvita_activate_cv'));
if (@$cuvita_activate_cv == 1) {
    add_action('admin_menu', 'cuvita_add_cv_page');
    add_action('admin_init', 'cuvita_cv_settings');
}


/**
 * Admin Pages
 */
function cuvita_add_admin_page() {

    add_admin_menu_separator(39);

    //Generate Cuvita Option Admin Page
    add_menu_page(__( 'Cuvita Theme Options', 'cuvita' ), 'Cuvita', 'manage_options', 'cuvita_options', 'cuvita_theme_options_page', get_template_directory_uri().'/assets/images/Cuvita_Logo_icon.svg', 42);

    //Generate Cuvita Option Admin Sub Pages
    add_submenu_page('cuvita_options', __( 'Cuvita Theme Options', 'cuvita' ), __( 'General', 'cuvita' ), 'manage_options', 'cuvita_options', 'cuvita_theme_options_page');
    add_submenu_page('cuvita_options', __( 'Cuvita Contact Info', 'cuvita' ), __( 'Contact Info', 'cuvita' ), 'manage_options', 'cuvita_options_contact', 'cuvita_theme_options_contact_page');
    
}

function cuvita_add_cv_page() {

    //Generate Cuvita CV Admin Page
    add_menu_page(__( 'Cuvita Theme Resume', 'cuvita' ), __( 'Resume', 'cuvita' ), 'manage_options', 'cuvita_cv', 'cuvita_theme_cv_page', 'dashicons-media-document', 41);

    //Generate Cuvita CV Admin Sub Pages
    add_submenu_page('cuvita_cv', __( 'Cuvita Resume', 'cuvita' ), __( 'Resume', 'cuvita' ), 'manage_options', 'cuvita_cv', 'cuvita_theme_cv_page');
    add_submenu_page('cuvita_cv', __( 'Cuvita Resume Section Order', 'cuvita' ), __( 'Section Order', 'cuvita' ), 'manage_options', 'cuvita_theme_cv_sectionorder', 'cuvita_theme_cv_sectionorder_page');
}



/**
 * Settings
 */
function cuvita_custom_settings() {
    register_setting('cuvita-options-contact-group', 'cuvita_facebook_link');
    register_setting('cuvita-options-contact-group', 'cuvita_twitter_link');
    register_setting('cuvita-options-contact-group', 'cuvita_linkedin_link');
    register_setting('cuvita-options-contact-group', 'cuvita_youtube_link');
    register_setting('cuvita-options-contact-group', 'cuvita_instagram_link');
    register_setting('cuvita-options-contact-group', 'cuvita_pinterest_link');
    register_setting('cuvita-options-contact-group', 'cuvita_vimeo_link');
    register_setting('cuvita-options-contact-group', 'cuvita_tumblr_link');
    register_setting('cuvita-options-contact-group', 'cuvita_soundcloud_link');
    register_setting('cuvita-options-contact-group', 'cuvita_twitch_link');
    register_setting('cuvita-options-contact-group', 'cuvita_discord_link');
    register_setting('cuvita-options-contact-group', 'cuvita_etsy_link');
    register_setting('cuvita-options-contact-group', 'cuvita_email');
    
    register_setting('cuvita-options-group', 'cuvita_frontpage_banner');
    register_setting('cuvita-options-group', 'cuvita_logo');
    register_setting('cuvita-options-group', 'cuvita_frontpage_tagline');
    register_setting('cuvita-options-group', 'cuvita_frontpage_title');
    register_setting('cuvita-options-group', 'cuvita_footer_tagline');
    register_setting('cuvita-options-group', 'cuvita_activate_contact');
    register_setting('cuvita-options-group', 'cuvita_activate_cv');
    register_setting('cuvita-options-group', 'cuvita_activate_portfolio');
    register_setting('cuvita-options-group', 'cuvita_activate_technologies');

    add_settings_section('cuvita-contact-option', __('Contact Settings', 'cuvita' ), 'cuvita_contact_options', 'cuvita_options_contact');
    add_settings_section('cuvita-socialmedia-option', __('Social Media Settings', 'cuvita' ), 'cuvita_socialmedia_options', 'cuvita_options_contact');

    add_settings_section('cuvita-site-option', __('Site Settings', 'cuvita' ), 'cuvita_site_options', 'cuvita_options');
    add_settings_section('cuvita-activation-option', __('Activate Features', 'cuvita' ), 'cuvita_activation_options', 'cuvita_options');

    add_settings_field('cuvita-socialmedia-facebook-link', __('Facebook Link', 'cuvita' ), 'cuvita_socialmedia_facebook_link', 'cuvita_options_contact', 'cuvita-socialmedia-option');
    add_settings_field('cuvita-socialmedia-twitter-link', __('Twitter Link', 'cuvita' ), 'cuvita_socialmedia_twitter_link', 'cuvita_options_contact', 'cuvita-socialmedia-option');
    add_settings_field('cuvita-socialmedia-linkedin-link', __('LinkedIn Link', 'cuvita' ), 'cuvita_socialmedia_linkedin_link', 'cuvita_options_contact', 'cuvita-socialmedia-option');
    add_settings_field('cuvita-socialmedia-youtube-link', __('Youtube Link', 'cuvita' ), 'cuvita_socialmedia_youtube_link', 'cuvita_options_contact', 'cuvita-socialmedia-option');
    add_settings_field('cuvita-socialmedia-instagram-link', __('Instagram Link', 'cuvita' ), 'cuvita_socialmedia_instagram_link', 'cuvita_options_contact', 'cuvita-socialmedia-option');
    add_settings_field('cuvita-socialmedia-vimeo-link', __('Vimeo Link', 'cuvita' ), 'cuvita_socialmedia_vimeo_link', 'cuvita_options_contact', 'cuvita-socialmedia-option');
    add_settings_field('cuvita-socialmedia-soundcloud-link', __('SoundCloud Link', 'cuvita' ), 'cuvita_socialmedia_soundcloud_link', 'cuvita_options_contact', 'cuvita-socialmedia-option');
    add_settings_field('cuvita-socialmedia-twitch-link', __('Twitch Link', 'cuvita' ), 'cuvita_socialmedia_twitch_link', 'cuvita_options_contact', 'cuvita-socialmedia-option');
    add_settings_field('cuvita-socialmedia-discord-link', __('Discord Link', 'cuvita' ), 'cuvita_socialmedia_discord_link', 'cuvita_options_contact', 'cuvita-socialmedia-option');
    add_settings_field('cuvita-socialmedia-pinterest-link', __('Pinterest Link', 'cuvita' ), 'cuvita_socialmedia_pinterest_link', 'cuvita_options_contact', 'cuvita-socialmedia-option');
    add_settings_field('cuvita-socialmedia-tumblr-link', __('Tumblr Link', 'cuvita' ), 'cuvita_socialmedia_tumblr_link', 'cuvita_options_contact', 'cuvita-socialmedia-option');
    add_settings_field('cuvita-socialmedia-etsy-link', __('Etsy Link', 'cuvita' ), 'cuvita_socialmedia_etsy_link', 'cuvita_options_contact', 'cuvita-socialmedia-option');
    add_settings_field('cuvita-contact-email', __('E-mail Address', 'cuvita' ), 'cuvita_email', 'cuvita_options_contact', 'cuvita-contact-option');

    add_settings_field('cuvita-frontpage-banner', __('Frontpage Banner', 'cuvita' ), 'cuvita_frontpage_banner', 'cuvita_options', 'cuvita-site-option');
    add_settings_field('cuvita-logo', __('Logo', 'cuvita' ), 'cuvita_logo', 'cuvita_options', 'cuvita-site-option');
    add_settings_field('cuvita-frontpage-tagline', __('Frontpage Tagline', 'cuvita' ), 'cuvita_frontpage_tagline', 'cuvita_options', 'cuvita-site-option');
    add_settings_field('cuvita-frontpage-title', __('Frontpage Title', 'cuvita' ), 'cuvita_frontpage_title', 'cuvita_options', 'cuvita-site-option');
    add_settings_field('cuvita-footer-tagline', __('Footer Tagline', 'cuvita' ), 'cuvita_footer_tagline', 'cuvita_options', 'cuvita-site-option');
    add_settings_field('cuvita-activate-cv', __('Activate Resume', 'cuvita' ), 'cuvita_activate_cv', 'cuvita_options', 'cuvita-activation-option');
    add_settings_field('cuvita-activate-portfolio', __('Activate Portfolio', 'cuvita' ), 'cuvita_activate_portfolio', 'cuvita_options', 'cuvita-activation-option');
    add_settings_field('cuvita-activate-technologies', __('Activate Technology Tags', 'cuvita' ), 'cuvita_activate_technologies', 'cuvita_options', 'cuvita-activation-option');
    add_settings_field('cuvita-activate-contact', __('Activate Contact Form', 'cuvita' ), 'cuvita_activate_contact', 'cuvita_options', 'cuvita-activation-option');
}

function cuvita_cv_settings() {
    register_setting('cuvita-options-cv-group', 'cuvita_education', array('sanitize_callback' => 'cuvita_education_sanitize_callback'));
    register_setting('cuvita-options-cv-group', 'cuvita_work', array('sanitize_callback' => 'cuvita_work_sanitize_callback'));
    register_setting('cuvita-options-cv-group', 'cuvita_other' , array('sanitize_callback' => 'cuvita_other_sanitize_callback'));
    register_setting('cuvita-options-cv-group', 'cuvita_cv_upload');

    register_setting('cuvita-options-cvorder-group', 'cuvita_cv_order');

    add_settings_section('cuvita-cv-required-option', __('Required', 'cuvita' ), 'cuvita_cv_required_options', 'cuvita_cv');
    add_settings_section('cuvita-cv-optional-option', __('Optional', 'cuvita' ), 'cuvita_cv_optional_options', 'cuvita_cv');

    add_settings_section('cuvita-cv-sectionorder-option', __('Sections', 'cuvita' ), 'cuvita_cv_sectionorder_options', 'cuvita_theme_cv_sectionorder');

    add_settings_field('cuvita-cv-work', __('Work Experience', 'cuvita' ), 'cuvita_cv_work', 'cuvita_cv', 'cuvita-cv-required-option');
    add_settings_field('cuvita-cv-education', __('Education', 'cuvita' ), 'cuvita_cv_education', 'cuvita_cv', 'cuvita-cv-required-option');
    add_settings_field('cuvita-cv-other-sections', __('Other Sections', 'cuvita' ), 'cuvita_cv_other_sections', 'cuvita_cv', 'cuvita-cv-optional-option');
    add_settings_field('cuvita-cv-upload', __('Resume Upload', 'cuvita' ), 'cuvita_cv_upload', 'cuvita_cv', 'cuvita-cv-optional-option');
    
    add_settings_field('cuvita-cv-sectionorder', __('Resume Order', 'cuvita' ), 'cuvita_cv_sectionorder', 'cuvita_theme_cv_sectionorder', 'cuvita-cv-sectionorder-option');
}


/**
 * Admin Page Callback
 */
function cuvita_theme_options_page() {
    require_once(get_template_directory() . '/inc/templates/cuvita-admin-options.php');
}

function cuvita_theme_options_contact_page() {
    require_once(get_template_directory() . '/inc/templates/cuvita-admin-options-contact.php');
}

function cuvita_theme_cv_page() {
    require_once(get_template_directory() . '/inc/templates/cuvita-cv-options.php');
}
function cuvita_theme_cv_sectionorder_page() {
    require_once(get_template_directory() . '/inc/templates/cuvita-cv-sectionorder.php');
}


/**
 * Settings Section Callback
 */
function cuvita_socialmedia_options() {
    ?>
    <p>
        <?php _e('Cuvita offers you the ability to link to other social-media, where visitors can find you. Fields that are saved will be displayed in the footer of the site as an icon.', 'cuvita'); ?>
    </p>
    <?php
}

function cuvita_contact_options() {

}

function cuvita_site_options() {
    
    $banner = esc_attr(get_option('cuvita_frontpage_banner'));
    $title = esc_attr(get_option('cuvita_frontpage_title'));
    $tagline = esc_attr(get_option('cuvita_frontpage_tagline'));
    ?>
    <div id="site-settings-preview">
        <div class="primary-header">
            <div class="logo-container">
                <?php
                $logo = esc_attr(get_option('cuvita_logo'));
                if ($logo) {
                    ?>
                    <div class="img-con">
                        <img src="<?php echo wp_get_attachment_image_src($logo, 'full')[0]; ?>" alt="<?php echo get_post_meta($logo, '_wp_attachment_image_alt', TRUE); ?>" class="mobile-logo">
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="primary-menu container">
                
            </div>
        </div>


        <div class="banner">
            <?php
            if ($banner) {
                ?>
                <img src="<?php echo wp_get_attachment_image_src($banner, 'full')[0]; ?>" alt="<?php echo get_post_meta($banner, '_wp_attachment_image_alt', TRUE); ?>" class="featured-image img-greyed">
                <?php
            } else {
                ?>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/blog_default.jpg'); ?>" alt="" class="featured-image img-greyed">
                <?php
            }
            ?>
            <div class="banner-content">
                <?php
                if ($tagline) {
                    echo '<h3 class="banner-tagline color__light_shade">'.$tagline.'</h3>';
                }
                if ($title) {
                    echo '<h1 class="banner-title color__light_shade">'.$title.'</h1>';
                } else {
                    echo '<h1 class="banner-title color__light_shade">'.get_bloginfo('title').'</h1>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php

    ?>
    <p>
        <?php _e('Settings that will be shown on the site. Above is a preview.', 'cuvita'); ?>
    </p>
    <?php  
}

function cuvita_activation_options() {
    ?>
    <p>
        <?php _e('Activate and Deactivate Cuvita Built-in Features', 'cuvita'); ?>
    </p>
    <?php 
}


function cuvita_cv_required_options() {
    ?>
    <p>
        <?php _e('Work Experience and Education is essential to your resume. Add your experiences by pressing the buttons and drag the sections to rearrange the order.', 'cuvita'); ?>
    </p>
    <?php 
}

function cuvita_cv_optional_options() {
    ?>
    <p>
        <?php _e('Here you can add other sections you find nessersary for your resume, like languages. Add your section and undersections by pressing the buttons and drag the sections to rearrange the order.', 'cuvita'); ?>
    </p>
    <?php 
}

function cuvita_cv_sectionorder_options() {
    ?>
    <p>
        <?php _e('Rearrange the order of the sections in your resume. Use the shortcode', 'cuvita'); ?>
        &nbsp;<code>[cuvita_CV]</code>&nbsp;
        <?php _e('to display the resume, or use', 'cuvita'); ?>
        &nbsp;<code>[cuvita_CV sort_by_date='1']</code>&nbsp;
        <?php _e('to display the resume ordered by end-date.', 'cuvita'); ?>
    </p>
    <?php 
}

/**
 * Settings Field Callback
 */

function cuvita_socialmedia_facebook_link(){
    $value = esc_attr(get_option('cuvita_facebook_link'));
    ?><input type="url" id="cuvita_facebook_link" name="cuvita_facebook_link" value="<?php echo $value; ?>" placeholder="https://www.facebook.com/<?php _e('your.name', 'cuvita'); ?>" class="regular-text code"><?php
}

function cuvita_socialmedia_twitter_link(){
    $value = esc_attr(get_option('cuvita_twitter_link'));
    ?><input type="url" id="cuvita_twitter_link" name="cuvita_twitter_link" value="<?php echo $value; ?>" placeholder="https://twitter.com/<?php _e('yourhandle', 'cuvita'); ?>" class="regular-text code"><?php
}

function cuvita_socialmedia_linkedin_link(){
    $value = esc_attr(get_option('cuvita_linkedin_link'));
    ?><input type="url" id="cuvita_linkedin_link" name="cuvita_linkedin_link" value="<?php echo $value; ?>" placeholder="https://www.linkedin.com/in/<?php _e('your-name', 'cuvita'); ?>" class="regular-text code"><?php
}

function cuvita_socialmedia_youtube_link(){
    $value = esc_attr(get_option('cuvita_youtube_link'));
    ?><input type="url" id="cuvita_youtube_link" name="cuvita_youtube_link" value="<?php echo $value; ?>" placeholder="https://www.youtube.com/channel/<?php _e('yourid', 'cuvita'); ?>" class="regular-text code"><?php
}

function cuvita_socialmedia_instagram_link(){
    $value = esc_attr(get_option('cuvita_instagram_link'));
    ?><input type="url" id="cuvita_instagram_link" name="cuvita_instagram_link" value="<?php echo $value; ?>" placeholder="https://www.instagram.com/<?php _e('yourhandle', 'cuvita'); ?>" class="regular-text code"><?php
}

function cuvita_socialmedia_pinterest_link(){
    $value = esc_attr(get_option('cuvita_pinterest_link'));
    ?><input type="url" id="cuvita_pinterest_link" name="cuvita_pinterest_link" value="<?php echo $value; ?>" placeholder="https://www.pinterest.com/<?php _e('yourid', 'cuvita'); ?>" class="regular-text code"><?php
}

function cuvita_socialmedia_vimeo_link(){
    $value = esc_attr(get_option('cuvita_vimeo_link'));
    ?><input type="url" id="cuvita_vimeo_link" name="cuvita_vimeo_link" value="<?php echo $value; ?>" placeholder="https://vimeo.com/<?php _e('yourname', 'cuvita'); ?>" class="regular-text code"><?php
}

function cuvita_socialmedia_tumblr_link(){
    $value = esc_attr(get_option('cuvita_tumblr_link'));
    ?><input type="url" id="cuvita_tumblr_link" name="cuvita_tumblr_link" value="<?php echo $value; ?>" placeholder="https://<?php _e('yourhandle', 'cuvita'); ?>.tumblr.com/" class="regular-text code"><?php
}

function cuvita_socialmedia_soundcloud_link(){
    $value = esc_attr(get_option('cuvita_soundcloud_link'));
    ?><input type="url" id="cuvita_soundcloud_link" name="cuvita_soundcloud_link" value="<?php echo $value; ?>" placeholder="https://soundcloud.com/<?php _e('yourhandle', 'cuvita'); ?>" class="regular-text code"><?php
}

function cuvita_socialmedia_twitch_link(){
    $value = esc_attr(get_option('cuvita_twitch_link'));
    ?><input type="url" id="cuvita_twitch_link" name="cuvita_twitch_link" value="<?php echo $value; ?>" placeholder="https://www.twitch.tv/<?php _e('yourhandle', 'cuvita'); ?>" class="regular-text code"><?php
}

function cuvita_socialmedia_discord_link(){
    $value = esc_attr(get_option('cuvita_discord_link'));
    ?><input type="url" id="cuvita_discord_link" name="cuvita_discord_link" value="<?php echo $value; ?>" placeholder="https://discord.com/channels/<?php _e('channelid', 'cuvita'); ?>" class="regular-text code"><?php
}

function cuvita_socialmedia_etsy_link(){
    $value = esc_attr(get_option('cuvita_etsy_link'));
    ?><input type="url" id="cuvita_etsy_link" name="cuvita_etsy_link" value="<?php echo $value; ?>" placeholder="https://www.etsy.com/shop/<?php _e('yourhandle', 'cuvita'); ?>" class="regular-text code"><?php
}

function cuvita_email(){
    $value = esc_attr(get_option('cuvita_email'));
    ?>
        <input type="email" id="cuvita_email" name="cuvita_email" value="<?php echo $value; ?>" placeholder="<?php _e('yourname', 'cuvita'); ?>@cuvita.dk" class="regular-text ltr">
        <p class="description"><?php _e('This address is used to display a mailto link icon in the footer section of the webpage.', 'cuvita'); ?></p>
    <?php
}

function cuvita_frontpage_tagline() {
    $value = esc_attr(get_option('cuvita_frontpage_tagline'));
    ?>
        <input type="text" id="cuvita_frontpage_tagline" name="cuvita_frontpage_tagline" value="<?php echo $value; ?>" class="regular-text">
        <p class="description"><?php _e('The tagline is a great way to invite the reader to the page. Taglines are also available on post and pages.', 'cuvita'); ?></p>
    <?php
}

function cuvita_frontpage_title() {
    $value = esc_attr(get_option('cuvita_frontpage_title'));
    ?>
        <input type="text" id="cuvita_frontpage_title" name="cuvita_frontpage_title" value="<?php echo $value; ?>" class="regular-text">
        <p class="description"><?php _e('This title will be used on the blog listing page. If not set, the site title will be used instead.', 'cuvita'); ?></p>

    <?php
}

function cuvita_frontpage_banner() {
    $value = esc_attr(get_option('cuvita_frontpage_banner'));
    ?>
    <div id="cuvita-site-options-banner">
        <input type="button" id="cuvita_frontpage_banner" value="<?php _e('Manage banner', 'cuvita'); ?>" title="<?php _e('Manage banner', 'cuvita'); ?>" class="button upload-banner <?php echo $value == '' ? '' : 'hidden'; ?>"">
        <input type="button" value="<?php _e('Empty banner', 'cuvita'); ?>" title="<?php _e('Empty banner', 'cuvita'); ?>" class="button delete-banner <?php echo $value != '' ? '' : 'hidden'; ?>"">
        <input type="hidden" name="cuvita_frontpage_banner" class="cuvita_frontpage_banner-id" value="<?php echo $value; ?>">
        <p class="description"><?php _e('This banner will be used on the blog listing page. If not set, a default image will be used instead.', 'cuvita'); ?></p>
    </div>
    <?php
}

function cuvita_logo() {
    $value = esc_attr(get_option('cuvita_logo'));
    ?>
    <div id="cuvita-site-options-logo">
        <input type="button" id="cuvita_logo" value="<?php _e('Manage Logo', 'cuvita'); ?>" title="<?php _e('Manage Logo', 'cuvita'); ?>" class="button upload-logo <?php echo $value == '' ? '' : 'hidden'; ?>"">
        <input type="button" value="<?php _e('Empty Logo', 'cuvita'); ?>" title="<?php _e('Empty Logo', 'cuvita'); ?>" class="button delete-logo <?php echo $value != '' ? '' : 'hidden'; ?>"">
        <input type="hidden" name="cuvita_logo" class="cuvita_logo-id" value="<?php echo $value; ?>">
        <div></div>
    </div>
    <?php
}

function cuvita_footer_tagline() {
    $value = esc_attr(get_option('cuvita_footer_tagline'));
    ?>
        <input type="text" id="cuvita_footer_tagline" name="cuvita_footer_tagline" value="<?php echo $value; ?>" placeholder="<?php _e('Get the job done your way.', 'cuvita'); ?>" class="regular-text">
        <p class="description">
            <?php _e('Use a few words to describe the what the site is about. This will be displayed in the sites footer section.', 'cuvita'); ?>
            &nbsp;
            <a href="<?php echo get_admin_url(null, '/options-general.php'); ?>">
                <?php _e('If not set it will display the Tagline from the General Settings section.', 'cuvita'); ?>
            </a>
        </p>
    <?php
}

function cuvita_activate_contact() {
    $value = esc_attr(get_option('cuvita_activate_contact'));
    $checked = (@$value == 1 ? 'checked' : '');
    ?>
        <label>
            <input type="checkbox" name="cuvita_activate_contact" id="cuvita_activate_contact" value="1" <?php echo $checked ?> >
            &nbsp;
            <?php _e('Create a Message Board and use shortcode', 'cuvita'); ?>
            &nbsp;<code>[cuvita_Contact]</code>&nbsp;
            <?php _e('to display a contact form on your page or post.', 'cuvita'); ?>
        </label>
    <?php
}

function cuvita_activate_cv() {
    $value = esc_attr(get_option('cuvita_activate_cv'));
    $checked = (@$value == 1 ? 'checked' : '');
    ?>
        <label>
            <input type="checkbox" name="cuvita_activate_cv" id="cuvita_activate_cv" value="1" <?php echo $checked ?> >
            &nbsp;
            <?php _e('Create a Resume Form and use shortcode', 'cuvita'); ?>
            &nbsp;<code>[cuvita_Contact]</code>&nbsp;
            <?php _e('to display the resume, or use', 'cuvita'); ?>
            &nbsp;<code>[cuvita_CV sort_by_date='1']</code>&nbsp;
            <?php _e('to display the resume ordered by end-date.', 'cuvita'); ?>
        </label>
    <?php
}

function cuvita_activate_portfolio() {
    $value = esc_attr(get_option('cuvita_activate_portfolio'));
    $checked = (@$value == 1 ? 'checked' : '');
    ?>
        <label>
            <input type="checkbox" name="cuvita_activate_portfolio" id="cuvita_activate_portfolio" value="1" <?php echo $checked ?> >
            &nbsp;
            <?php _e('Create a Portfolio Post Type and use shortcode', 'cuvita'); ?>
            &nbsp;<code>[cuvita_Portfolio]</code>&nbsp;
            <?php _e('to display the projects, or use', 'cuvita'); ?>
            &nbsp;<code>[cuvita_Portfolio latest='1']</code>&nbsp;
            <?php _e('to display the latest 3.', 'cuvita'); ?>
        </label>
    <?php
}

function cuvita_activate_technologies() {
    $value = esc_attr(get_option('cuvita_activate_technologies'));
    $checked = (@$value == 1 ? 'checked' : '');
    ?>
        <label>
            <input type="checkbox" name="cuvita_activate_technologies" id="cuvita_activate_technologies" value="1" <?php echo $checked ?> >
            &nbsp;
            <?php _e('Adding a technology taxonomy.', 'cuvita'); ?>
        </label>
    <?php
}

function cuvita_cv_education() {
    require_once(get_template_directory() . '/inc/templates/fields/cuvita_cv_education.php');
}

function cuvita_cv_work() {
    require_once(get_template_directory() . '/inc/templates/fields/cuvita_cv_work.php');
}

function cuvita_cv_other_sections() {
    require_once(get_template_directory() . '/inc/templates/fields/cuvita_cv_other.php');
}

function cuvita_cv_upload() {
    $value = esc_attr(get_option('cuvita_cv_upload'));
    ?>
    <div id="cuvita-site-options-cuvita_cv_upload">
        <input type="button" id="cuvita_frontpage_banner" value="<?php _e('Manage Resume', 'cuvita'); ?>" title="<?php _e('Manage Resume', 'cuvita'); ?>" class="button upload-cv <?php echo $value == '' ? '' : 'hidden'; ?>"">
        <input type="button" value="<?php _e('Remove Resume', 'cuvita'); ?>" title="<?php _e('Remove Resume', 'cuvita'); ?>" class="button delete-cv <?php echo $value != '' ? '' : 'hidden'; ?>"">
        <input type="hidden" name="cuvita_cv_upload" class="cuvita_cv_upload" value="<?php echo $value; ?>">
        <p class="cvname" style="display: inline-block;">
            <?php echo get_the_title($value); ?>
        </p>
        <p class="description"><?php _e('Upload your resume, so visitors can download it. Enable download button on post and pages.', 'cuvita'); ?></p>
    </div>
    <?php
}

function cuvita_cv_sectionorder() {
    require_once(get_template_directory() . '/inc/templates/fields/cuvita_cv_sections.php');
}

/**
 * Settings Field Sanitization Callback
 */

function cuvita_education_sanitize_callback( $input ) {

    if (!empty($input)) {
        $sectionOrder = get_option('cuvita_cv_order', array());

        $savedIds = array();
        if (!empty($sectionOrder)) {
            foreach ($sectionOrder as $section => $arr) {
                foreach ($arr as $key => $value) {
                    if ($key == 'section_id') {
                        array_push($savedIds, $value);
                    }
                }
            }
        }

        if(!in_array('2', $savedIds)) {

            $new_section = array(
                'section_id'    =>  '2',
                'title'         =>  __('Education', 'cuvita'),
                'other'         =>  'false',
            );
            array_push($sectionOrder, $new_section);
            
        }

        update_option('cuvita_cv_order', $sectionOrder);
    }

    return $input;
}

function cuvita_work_sanitize_callback( $input ) {

    if (!empty($input)) {
        $sectionOrder = get_option('cuvita_cv_order', array());

        $savedIds = array();
        if (!empty($sectionOrder)) {
            foreach ($sectionOrder as $section => $arr) {
                foreach ($arr as $key => $value) {
                    if ($key == 'section_id') {
                        array_push($savedIds, $value);
                    }
                }
            }
        }

        if(!in_array('1', $savedIds)) {

            $new_section = array(
                'section_id'    =>  '1',
                'title'         =>  __('Work Experience', 'cuvita'),
                'other'         =>  'false',
            );
            array_push($sectionOrder, $new_section);
            
        }

        update_option('cuvita_cv_order', $sectionOrder);
    }

    return $input;
}

function cuvita_other_sanitize_callback( $input ) {

    if (!empty($input)) {
        $outer_arr_default = array(
            'id'                =>  '',
            'hide_onsite'       =>  '',
            'title'             =>  '',
            'under_sections'    =>  '',
        );

        $sectionOrder = get_option('cuvita_cv_order', array());

        $savedIds = array();
        if (!empty($sectionOrder)) {
            foreach ($sectionOrder as $section => $arr) {
                foreach ($arr as $key => $value) {
                    if ($key == 'section_id') {
                        array_push($savedIds, $value);
                    }
                }
            }
        }
        
        $sectionIds = array();
        foreach ($input as $key => $value) {
            $section =  !empty($value) ? array_merge($outer_arr_default, $value) : $outer_arr_default;
            array_push($sectionIds,  esc_attr($section['id']) !== '' ? esc_attr($section['id']) : '');

            if(!in_array($section['id'], $savedIds) && esc_attr($section['hide_onsite'] != 1)) {

                $new_section = array(
                    'section_id'    =>  esc_attr($section['id']) !== '' ? esc_attr($section['id']) : '',
                    'title'         =>  esc_attr($section['title']) !== '' ? esc_attr($section['title']) : 'NaN',
                    'other'         =>  'true',
                );
                array_push($sectionOrder, $new_section);
                array_push($sectionIds,  esc_attr($section['id']) !== '' ? esc_attr($section['id']) : '');

            } else if(in_array($section['id'], $savedIds) && esc_attr($section['hide_onsite'] == 1)) {
                foreach ($sectionOrder as $key => $value) {
                    if ($value['section_id'] == $section['id']) {
                        unset($sectionOrder[$key]);
                    }
                }
            }
        }

        foreach ($sectionOrder as $key => $value) {
            if (!in_array($value['section_id'], $sectionIds) && $value['section_id'] != '1' && $value['section_id'] != '2') {
                unset($sectionOrder[$key]);
            }
        }

        update_option('cuvita_cv_order', $sectionOrder);
    }

    return $input;
}