
<?php get_header(); ?>

<?php // attributes
global $product;
$koostis = $product->get_attribute( 'pa_kolichestvo-komnat' );

echo $koostis;
?>

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

<?php get_footer(); ?>
