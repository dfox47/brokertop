
<?php get_header(); ?>

<?php // thumb img url
$thumbUrl = '';

if (get_the_post_thumbnail_url()) {
	$thumbUrl = str_replace('https://' . $_SERVER['SERVER_NAME'], '', get_the_post_thumbnail_url());
} ?>

<main class="main_content_wrap">
	<div class="main_content">
		<div class="wrap2">
			<?php if (is_single() && $thumbUrl !== '') { ?>
				<img class="thumb_img" src="<?php echo $thumbUrl; ?>" alt="" />
			<?php } ?>

			<h1><?php single_post_title(); ?></h1>

			<?php // content
			the_content(); ?>

			<?php // posts
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
				}
			} ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
