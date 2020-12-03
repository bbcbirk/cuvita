<?php
/**
 * @package cuvita
 * 
 * AJAX
 */

 add_action('wp_ajax_nopriv_cuvita_save_user_contact_form', 'cuvita_save_user_contact_form');
 add_action('wp_ajax_cuvita_save_user_contact_form', 'cuvita_save_user_contact_form');

 function cuvita_save_user_contact_form() {
     $title = wp_strip_all_tags($_POST['name']);
     $email = wp_strip_all_tags($_POST['email']);
     $message = wp_strip_all_tags($_POST['message']);

     $args = array(
        'post_title'    => $title,
        'post_content'  => $message,
        'post_author'   => 1,
        'post_status'   => 'publish',
        'post_type'     => 'cuvita-contact',
        'meta_input'    => array(
            '_contact_email_value_key'  => $email
        )
     );

     wp_insert_post($args);

     die();
 }