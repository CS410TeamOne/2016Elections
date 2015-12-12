<?php
if (post_password_required()) {
    return;
}
?>
<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <?php
        if (wp_is_mobile) {
            echo "<span class=\"glyphicon glyphicon-comment\"></span> " . get_comments_number() . "<hr/>";
        } else {
            echo "<h2 class=\"comments-title\">";
            echo "<span class=\"glyphicon glyphicon-comment\"></span>";
            printf(_nx('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'ccsuelections'), number_format_i18n(get_comments_number()), get_the_title());
        }
        ?>
    </h2>
    <ul>
        <?php
        wp_list_comments('callback=display_comments'); //gets the comments
        ?>
    </div>
    </ul>

<?php endif; ?>

<?php
if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
    <p><?php _e('Comments are closed.', 'ccsujournalism'); ?></p>
<?php endif; ?>
<hr/>
<?php comment_form(); ?>

</div>
