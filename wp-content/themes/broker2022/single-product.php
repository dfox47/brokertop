
<?php get_header(); ?>

<?php // attributes
global $product;
$gallery_images = $product->get_gallery_image_ids();

$productAttributes = [
	'pa_etazh',
	'pa_kolichestvo-komnat',
	'pa_material-doma',
	'pa_obshhaya-ploshhad',
	'pa_rajony',
	'pa_remont',
	'pa_stancziya-metro',
	'pa_vsego-etazhej'
]; ?>

<?php // filter
if (is_active_sidebar('woocommerce_filter')) { ?>
	<?php dynamic_sidebar('woocommerce_filter'); ?>
<?php } ?>

<main class="main_content_wrap">
	<div class="main_content">
		<div class="wrap2">
			<?php // content
			the_content(); ?>

			<?php // attributes
			foreach ($productAttributes as $productAttribute) {
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

	<ul class="product_gallery">
		<?php // gallery images
		foreach ($gallery_images as $gallery_image) {
			$image_link = str_replace('https://' . $_SERVER['SERVER_NAME'], '', wp_get_attachment_url($gallery_image)); ?>

			<li class="product_gallery__item"><img class="product_gallery__img" src="<?php echo $image_link; ?>" alt="" /></li>
		<?php } ?>
	</ul>
</main>

<?php get_footer(); ?>
