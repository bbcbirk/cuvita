<?php
get_header();
?>
<main id="site-content">
    <section class="banner">
        <?php 
        $banner = esc_attr(get_option('cuvita_frontpage_banner'));
        $title = esc_attr(get_option('cuvita_frontpage_title'));
        $tagline = esc_attr(get_option('cuvita_frontpage_tagline'));
        ?>
        <?php
        if ($banner) {
            ?>
            <img src="<?php echo wp_get_attachment_image_src($banner, 'full')[0]; ?>" alt="<?php echo get_post_meta($banner, '_wp_attachment_image_alt', TRUE); ?>" class="featured-image img-greyed">
            <?php
        } else {
            ?>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/blog_default.jpg'); ?>" alt="<?php echo the_title(); ?>" class="featured-image img-greyed">
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
    </section>

    <section id="main-content" class="not-singular">
        <div class="width-container">
            <?php
            if ( have_posts() ) : 
                while ( have_posts() ) : the_post();
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
                <div class="pagination-container">
                <?php
                    echo paginate_links();
                ?>
                </div>
                <?php
            else :
                _e( 'Sorry, no posts matched your criteria.', 'cuvita' );
            endif;
            ?>
        </div>
    </section>
</main>


<?php
get_footer();
?>