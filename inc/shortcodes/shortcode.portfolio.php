<?php
 
// The Query
$args = array(
    'post_type' => 'cuvita-portfolio',
    'nopaging' => true,
);
$portfolio = new WP_Query( $args );
 

if ( $portfolio->have_posts() ) { 
    ?>
    <h1></h1>
    <div class="portfolio-container">
        <?php
        while ( $portfolio->have_posts() ) : $portfolio->the_post();
            ?>
            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <div class="post-container not-single">
                    <img 
                        src="<?php echo has_post_thumbnail() ? esc_url(the_post_thumbnail_url()) : esc_url(get_template_directory_uri() . '/assets/images/blog_default.jpg'); ?>" 
                        alt="<?php echo has_post_thumbnail() ? get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) : the_title(); ?>" 
                        class="post-thumbnail img-greyed">
                    <div class="post-content">
                        <?php
                        $tagline = get_post_meta(get_the_ID(), '_banner_tagline_value_key', true);
                        $tagline = wp_parse_args( $tagline, _cuvita_banner_tagline_defaults() );
                        ?>
                        <h3 class="post-tagline color__light_shade"><?php echo $tagline['tagline'] ? $tagline['tagline'] : ''; ?></h3>
                        <h2 class="post-title color__light_shade"><?php the_title(); ?></h2>
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="link-btn color__light_shade"><?php _e( 'See More', 'cuvita' ); ?></a>
                    </div>
                </div>
            </article>
            <?php
        endwhile;
        ?>
    </div>
    <?php
}

/* Restore original Post Data */
wp_reset_postdata();