<?php
/*
* Template Name: Новостройки
* Template Post Type: post, page, product
*/
?>

<?php // link to dumm img
$dumm = '/wp-content/themes/broker2022/i/dumm.png'; ?>

<?php get_header(); ?>

	<h1>Жилые комплексы</h1>

	<div class="wrap">
		<ul class="new_building_list owl-carouselX">
			<?php // subcategories of new buildings
			$categories = get_terms(array(
				'hide_empty'    => false,
				'parent'        => 2291,
				'taxonomy'      => 'product_cat'
			));

			foreach ($categories as $category) {
				$desc           = $category->description;
				$desc_no_img    = preg_replace('/(<)([img])(\w+)([^>]*>)/', '', $desc);
				$id             = $category->term_id;
				$image          = wp_get_attachment_url(get_term_meta($id, 'thumbnail_id', true));
				$link           = get_category_link($id);
				$name           = $category->name;

				preg_match('@src="([^"]+)"@', $desc, $match);

				$logo_link = array_pop($match); ?>

				<li class="new_building_list__item">
					<a class="new_building_list__link" href="<?= $link; ?>">
						<span class="new_building_list__img">
							<?php if ($image) { ?>
								<img class="js-img-scroll" src="<?php echo $dumm; ?>" data-src="<?=  $image; ?>" alt="">
							<?php } ?>
						</span>

						<span class="new_building_list__logo"><img src="<?= $logo_link; ?>" alt=""></span>

						<span class="new_building_list__desc"><?= $desc_no_img; ?></span>
					</a>
				</li>
			<?php } ?>
		</ul>
	</div>

<?php // content
the_content(); ?>

<?php get_footer(); ?>