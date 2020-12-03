<?php
/**
 * Function file for the Cuvita theme.
 *
 * @package Cuvita
 */


require get_template_directory() . '/inc/function-admin.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/theme-support.php';
require get_template_directory() . '/inc/custom-post-type.php';
require get_template_directory() . '/inc/function-helper.php';
require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/ajax.php';
//require get_template_directory() . '/inc/generate-pdf.php'; NOT READY

function cuvita_setup () {
	flush_rewrite_rules();
}
add_action('after_switch_theme', 'cuvita_setup');

