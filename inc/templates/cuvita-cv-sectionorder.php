<div class="wrap">
    <h1><?php _e('Cuvita Resume Order', 'cuvita') ?></h1>

    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php settings_fields('cuvita-options-cvorder-group'); ?>
        <?php do_settings_sections('cuvita_theme_cv_sectionorder'); ?>
        <?php submit_button(); ?>
    </form>
</div>