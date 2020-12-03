<?php
/**
 * @package cuvita
 * 
 * SHORTCODES
 */


$cuvita_activate_cv = esc_attr(get_option('cuvita_activate_cv'));
if (@$cuvita_activate_cv == 1) {
    add_shortcode( 'cuvita_CV', 'cuvita_shortcode_cv' );
}
$cuvita_activate_portfolio = esc_attr(get_option('cuvita_activate_portfolio'));
if (@$cuvita_activate_portfolio == 1) {
    add_shortcode( 'cuvita_Portfolio', 'cuvita_shortcode_portfolio' );
}
$cuvita_activate_contact = esc_attr(get_option('cuvita_activate_contact'));
if (@$cuvita_activate_contact == 1) {
    add_shortcode( 'cuvita_Contact', 'cuvita_shortcode_contact' );
}

function cuvita_shortcode_cv($atts) {
    extract( shortcode_atts( array(
        'sort_by_date' => 0
    ), $atts ) );

    ob_start();
    if($sort_by_date) {
        get_template_part('inc/shortcodes/shortcode.cv.orderedbydate');
    } else {
        get_template_part('inc/shortcodes/shortcode.cv');
    }
    return ob_get_clean(); 

}


function cuvita_shortcode_contact($atts) {
    ob_start();

    get_template_part('inc/shortcodes/shortcode.contact');

    return ob_get_clean(); 

}

function cuvita_shortcode_portfolio($atts) {
    extract( shortcode_atts( array(
        'latest' => 0
    ), $atts ) );

    ob_start();
    if($latest) {
        get_template_part('inc/shortcodes/shortcode.portfolio.latest');
    } else {
        get_template_part('inc/shortcodes/shortcode.portfolio');
    }
    return ob_get_clean(); 

}
