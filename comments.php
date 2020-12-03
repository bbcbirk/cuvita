<?php

if ( post_password_required() )
    return;
?>

<hr class="divider-line">
<div id="comments" class="comments-area">

    <?php 
    comment_form(); 
 
    if ( have_comments() ) { 
        ?>
        <h2 class="comments-title">
            <?php
            printf( _nx( 'One thought on "%2$s"', '%1$s thoughts on "%2$s"', get_comments_number(), 'comments title', 'cuvita' ), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>' );
            ?>
        </h2>

        <hr>
        <ol class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 74,
                ) );
            ?>
        </ol>
 
        <?php
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
            ?>
            <nav class="navigation comment-navigation" role="navigation">
                <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'cuvita' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( _e( '&larr; Older Comments', 'cuvita' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( _e( 'Newer Comments &rarr;', 'cuvita' ) ); ?></div>
            </nav>
            <?php 
        } 
        
        if ( ! comments_open() && get_comments_number() ) { 
            ?>
            <p class="no-comments"><?php _e( 'Comments are closed.' , 'cuvita' ); ?></p>
            <?php 
        }
    }
    ?>
 
</div>