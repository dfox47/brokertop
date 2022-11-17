<?php
/*
* Template Name: News
* Template Post Type: post, page, product
*/
?>

<?php get_header(); ?>

	<main class="main_content_wrap">
		<div class="main_content">
			<div class="wrap2">
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