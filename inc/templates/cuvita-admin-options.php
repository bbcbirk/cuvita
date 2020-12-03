<div class="wrap">
    <h1><?php _e('Cuvita General Settings', 'cuvita') ?></h1>

    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php settings_fields('cuvita-options-group'); ?>
        <?php do_settings_sections('cuvita_options'); ?>
        <?php submit_button(); ?>
    </form>
</div>