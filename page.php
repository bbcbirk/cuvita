<?php
get_header();
?>
<main id="site-content">

    <?php
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post();
            ?>
            <section class="banner">
                <img src="<?php echo has_post_thumbnail() ? esc_url(the_post_thumbnail_url()) : esc_url(get_template_directory_uri() . '/assets/images/blog_default.jpg'); ?>"
                    alt="<?php echo has_post_thumbnail() ? get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) : the_title(); ?>"
                    class="featured-image img-greyed">
                <div class="banner-content">
                    <?php
                    $saved = get_post_meta(get_the_ID(), '_banner_tagline_value_key', true);
                    $defaults = _cuvita_banner_tagline_defaults();
                    $value = wp_parse_args( $saved, $defaults );
                    ?>
                    <h3 class="banner-tagline color__light_shade"><?php echo esc_attr( $value['tagline'] ); ?></h3>
                    <h1 class="banner-title color__light_shade"><?php the_title(); ?></h1>
                    <?php 
                    if (esc_attr( $value['show_downloadcv'] ) && esc_attr( $value['show_downloadcv'] ) == '1') {
                        $cv = esc_attr(get_option('cuvita_cv_upload'));
                        if ($cv) {
                            ?>
                            <a href="<?php echo wp_get_attachment_url($cv); ?>" class="link-btn color__light_shade" style="margin-top: 1.5em" target="_blank"><?php _e('Download Resume', 'cuvita');?></a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </section>
            <section id="main-content">
                <div class="width-container">
                    <article <?php post_class(array('singular','clearfix')); ?> id="post-<?php the_ID(); ?>">
                        <?php
                        
                        the_content( __( 'Continue reading', 'cuvita' ) );

                        wp_link_pages(); 
                        
                        ?>
                    </article>
                </div>
            </section>
            <?php
            if ( comments_open() || get_comments_number() ) :
                ?>
                <section id="comment-content">
                    <div class="width-container">
                        <article>
                            <?php comments_template(); ?>
                        </article>
                    </div>  
                </section>
                <?php
            endif;
            ?>
            <?php
        endwhile;
    else :
        _e( 'Sorry, no posts matched your criteria.', 'cuvita' );
    endif;
    ?>

</main>


<?php
get_footer();
?>