<?php
/**
 * Footer file for the Cuvita theme.

 * @package Cuvita
 */

?>

            <footer id="site-footer">
                <div class="section-inner">
                    <div>
                        <?php get_search_form(); ?>
                    </div>
                    <div class="footer-tag">
                        <h2>
                            <?php 
                            $footer_tagline = esc_attr(get_option('cuvita_footer_tagline'));
                            if ($footer_tagline) {
                                echo $footer_tagline;
                            } else {
                                bloginfo('description'); 
                            }
                            ?>
                        </h2>
                    </div>
                    <div class="footer-menu">
                        <nav class="footer-menu-nav">
                            <?php
                            if ( has_nav_menu( 'footer' ) ) {
                                wp_nav_menu(
                                    array(
                                        'menu_class'        => 'footer-menu',
                                        'depth'             => '1',
                                        'theme_location'    => 'footer',
                                    )
                                );
                            }
                            ?>
                        </nav>
                    </div>
                    <div class="footer-credits color__light_accent">
                        <p class="footer-copyright">
                            &copy;
                            <?php
                            echo date_i18n(
                                _x( 'Y', 'Year Date Format', 'cuvita' )
                            );
                            ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="color__light_accent"><?php bloginfo( 'name' ); ?></a>
                        </p>
                        <p class="powered-by-wordpress">
                            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'cuvita' ) ); ?>" class="color__light_accent">
                                <?php _e( 'Powered by WordPress', 'cuvita' ); ?>
                            </a>
                        </p>
                    </div>
                    <div class="footer-social">
                        <nav class="footer-social-nav">
                        <?php get_template_part('template-parts/footer/socialmedia'); ?>
                        <?php get_template_part('template-parts/footer/mail'); ?>
                        </nav>
                    </div>
                </div>
            </footer>
        </div>
        <?php wp_footer(); ?>

    </body>
</html>