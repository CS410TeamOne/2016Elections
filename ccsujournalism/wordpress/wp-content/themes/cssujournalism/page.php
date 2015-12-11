<?php get_header(); ?>
<?php
// Fix menu overlap bug
$str = '';
if (is_admin_bar_showing()) {
    $str = "style='top:95px;'";
}
?>
<?php if (wp_is_mobile()) {
    ?>
    <div class="content-mobile">
        <?php
    } else {
        ?>
        <section class="left-bar" id="sidebar_left" <?php echo $str ?>><?php dynamic_sidebar('left'); ?></section>
        <section class="right-bar" id="sidebar_right" <?php echo $str ?>><?php dynamic_sidebar('right'); ?></section>
        <div class="content">
    <?php
}
?>

<?php while ( have_posts() ) : the_post();?>
    <div class="page-header"><h1><?php the_title() ?> </h1> </div>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ccsujournalism' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'ccsujournalism' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>

        <?php
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		endwhile;
		?>
</div>
<div class="container"></div>
<?php get_footer(); ?>