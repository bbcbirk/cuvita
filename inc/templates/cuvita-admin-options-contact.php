<div class="wrap">
    <h1><?php _e('Contact Info Settings', 'cuvita') ?></h1>

    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php settings_fields('cuvita-options-contact-group'); ?>
        <?php do_settings_sections('cuvita_options_contact'); ?>
        <?php submit_button(); ?>
    </form>
</div>
