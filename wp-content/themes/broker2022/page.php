
<?php $currentUrl = $_SERVER['REQUEST_URI']; ?>

<?php get_header(); ?>

<?php if (!is_front_page()) { ?>
	<main class="main_content_wrap">
		<div class="main_content">
			<div class="wrap2">
				<?php // hide h1 at page About
				if ($currentUrl == '/o-kompanii/') {}
				// hide
				elseif ($currentUrl == '/novosti/') {}
				else { ?>
					<h1><?php single_post_title(); ?></h1>
				<?php } ?>

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
