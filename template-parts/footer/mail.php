<?php
    if (!empty(esc_attr(get_option('cuvita_email')))){
        ?><a href="mailto:<?php echo esc_attr(get_option('cuvita_email')); ?>" target="_blank" class="far fa-envelope"></a><?php
    }
?>