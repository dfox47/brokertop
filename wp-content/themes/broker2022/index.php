
<?php get_header(); ?>

<main class="site-main">
	<?php if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
		}
	}
	else { ?>
		<div class="hidden">empty</div>

		<?php
		// If no content, include the "No posts found" template.
//			get_template_part( 'template-parts/content/content', 'none' );
	} ?>
</main>

<?php get_footer(); ?>
