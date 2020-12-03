<?php
/**
 * Header file for the Cuvita theme.

 * @package Cuvita
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        
        <?php wp_body_open(); ?>
        <div id="site-container">
            <header id="site-header">
                <div class="mobile-header">
                    <div class="logo-container">
                        <?php
                        $logo = esc_attr(get_option('cuvita_logo'));
                        if ($logo) {
                            ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <img src="<?php echo wp_get_attachment_image_src($logo, 'full')[0]; ?>" alt="<?php echo get_post_meta($logo, '_wp_attachment_image_alt', TRUE); ?>" class="mobile-logo">
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                    <span id="mobile-open-menu-btn" class="open-btn">&#9776;</span>
                    <div id="mobile-overlay" class="mobile-overlay">
                        <span id="mobile-close-menu-btn" class="close-btn">&times;</span>
                        <div class="mobile-overlay-menu">
                            <nav class="mobile-overlay-nav">
                                <?php
                                if ( has_nav_menu( 'mobile' ) ) {
                                    wp_nav_menu(
                                        array(
                                            'menu_class'        => 'mobile-menu',
                                            'depth'             => '3',
                                            'theme_location'    => 'mobile',
                                        )
                                    );
                                }
                                ?>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="primary-header-container">
                    <div class="primary-header">
                        <div class="logo-container">
                            <?php
                            $logo = esc_attr(get_option('cuvita_logo'));
                            if ($logo) {
                                ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <img src="<?php echo wp_get_attachment_image_src($logo, 'full')[0]; ?>" alt="<?php echo get_post_meta($logo, '_wp_attachment_image_alt', TRUE); ?>" class="mobile-logo">
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="primary-menu container">
                            <nav class="primary-nav">
                                <?php
                                if ( has_nav_menu( 'primary' ) ) {
                                    wp_nav_menu(
                                        array(
                                            'menu_class'        => 'primary-menu',
                                            'depth'             => '3',
                                            'theme_location'    => 'primary',
                                        )
                                    );
                                }
                                ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>