<?php
/**
 * @package cuvita
 * 
 * THEME SUPPORT
 */

function cuvita_theme_support() {

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );
	add_image_size( 'cuvita-fullscreen', 1980, 9999 );

	add_theme_support( 'title-tag' );

	load_theme_textdomain( 'cuvita', get_template_directory() . '/lang' );

	add_theme_support( 'align-wide' );

	add_theme_support( 'responsive-embeds' );

	add_theme_support( 'html5', array( 'search-form' ) );

}
add_action( 'after_setup_theme', 'cuvita_theme_support' );

function cuvita_menus() {

	$locations = array(
		'primary'  => __( 'Desktop Horizontal Menu', 'cuvita' ),
		'mobile'   => __( 'Mobile Menu', 'cuvita' ),
		'footer'   => __( 'Footer Menu', 'cuvita' ),
	);
	register_nav_menus( $locations );
}
add_action( 'init', 'cuvita_menus' );