
<?php get_header(); ?>

<?php // attributes
global $product;

$productAttributes = [
	'pa_kolichestvo-komnat',
	'pa_material-doma',
	'pa_obshhaya-ploshhad',
	'pa_rajony',
	'pa_remont',
	'pa_stancziya-metro'
]; ?>

<main class="main_content_wrap">
	<div class="main_content">
		<div class="wrap2">
			<h1><?php single_post_title(); ?></h1>

			<?php // content
			the_content(); ?>

			<?php foreach ($productAttributes as $productAttribute) {
				$value      = $product -> get_attribute($productAttribute);
				$label      = wc_attribute_label($productAttribute);

				if ($value) { ?>
					<div class="product_attr">
						<div class="product_attr__title"><?php echo $label; ?></div>
						<div class="product_attr__desc"><?php echo $value; ?></div>
					</div>
				<?php }
			} ?>

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
