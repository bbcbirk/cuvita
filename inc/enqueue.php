<?php
/**
 * @package cuvita
 * 
 * ENQUEUE
 */

 /**
  * Backend
  */
  function cuvita_admin_enqueue($hook) {
    $theme_version = wp_get_theme()->get( 'Version' );

    if ( 'post.php' == $hook || 'post-new.php' == $hook ) {
      wp_enqueue_script('gallery-metabox', get_template_directory_uri() . '/assets/js/gallery-metabox.js', array('jquery', 'jquery-ui-sortable'), $theme_version, true);
      wp_enqueue_media();
	}


	if ( 'toplevel_page_cuvita_cv' == $hook || 'cv_page_cuvita_theme_cv_sectionorder' == $hook || 'resume_page_cuvita_theme_cv_sectionorder' == $hook ) {
		wp_enqueue_script('wp-media', get_template_directory_uri() . '/assets/js/wp-media.js', array('jquery'), $theme_version, true);
		wp_enqueue_style('cuvita_cv', get_template_directory_uri() . '/assets/css/admin/cv.css', array(), $theme_version, 'all');
		wp_enqueue_media();
	}

	if ( 'toplevel_page_cuvita_options' == $hook ) {
		wp_enqueue_script('wp-media', get_template_directory_uri() . '/assets/js/wp-media.js', array('jquery'), $theme_version, true);
		wp_enqueue_media();
	}

	wp_enqueue_style('admin-style', get_template_directory_uri() . '/assets/css/admin/admin.css', array(), $theme_version);

}
add_action('admin_enqueue_scripts', 'cuvita_admin_enqueue');

/**
 * Frontend
 */
function cuvita_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script( 'mobile-menu', get_template_directory_uri() . '/assets/js/mobile-menu.js', array('jquery'), $theme_version, true );
	wp_enqueue_script( 'wp-cover-spacing', get_template_directory_uri() . '/assets/js/wp-cover-spacing.js', array('jquery'), $theme_version, false );
	wp_enqueue_script( 'wp-quote', get_template_directory_uri() . '/assets/js/wp-quote.js', array('jquery'), $theme_version, true );
	wp_enqueue_script( 'cuvita-contact-form', get_template_directory_uri() . '/assets/js/cuvita-contact-form.js', array('jquery'), $theme_version, true );
	
}
add_action( 'wp_enqueue_scripts', 'cuvita_register_scripts' );


function cuvita_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'cuvita-style', get_stylesheet_uri(), array(), $theme_version );
	wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'cuvita_register_styles' );