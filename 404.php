<?php
get_header();
?>
<main id="site-content">
    <section class="banner">
        <img src="https://static-37.sinclairstoryline.com/resources/media/9c82c7a0-0963-4b57-a4a8-bc4a9cf5d0b0-large16x9_GettyImages1134307248.jpg?1587503201714" alt="" class="featured-image img-greyed">
        <div class="banner-content">
            <h3 class="banner-tagline color__light_shade">404</h3>
            <h1 class="banner-title color__light_shade"><?php _e('Not Found', 'cuvita'); ?></h1>
        </div>
    </section>

    <section id="main-content">
        <div class="width-container">
            <h2><?php _e('This is somewhat embarrassing, isn’t it?', 'cuvita' ); ?></h2>
			<p><?php _e('It looks like nothing was found at this location. Maybe try a search?', 'cuvita'); ?></p>
        </div>
    </section>
</main>


<?php
get_footer();
?>