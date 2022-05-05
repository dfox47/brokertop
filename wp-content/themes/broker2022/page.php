
<?php get_header(); ?>

<?php if (!is_front_page()) { ?>
	<main class="main_content_wrap">
		<div class="main_content">
			<div class="wrap2">
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
<?php } ?>

<?php get_footer(); ?>
