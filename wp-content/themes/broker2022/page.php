
<?php get_header(); ?>

<main class="site-main">
	<h1><?php single_post_title(); ?></h1>

	<div class="" data-img="<?php echo get_the_post_thumbnail_url(); ?>">XXX</div>

	<?php // content
	the_content(); ?>

	<?php // posts
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
		}
	}
	else { ?>
		<div class="hidden">empty</div>
	<?php } ?>
</main>

<?php get_footer(); ?>
