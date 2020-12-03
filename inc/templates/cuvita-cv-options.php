<div class="wrap">
    <h1><?php _e('Cuvita Resume', 'cuvita') ?></h1>

    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php settings_fields('cuvita-options-cv-group'); ?>
        <?php do_settings_sections('cuvita_cv'); ?>
        <?php submit_button(); ?>
    </form>
</div>