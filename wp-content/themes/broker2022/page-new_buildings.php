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
		<div class="new_building_list owl-carouselX js-owl-buildingsX">
			<div class="new_building_list__group">
				<?php
				$args = array(
					'posts_per_page'    => 40,
					'product_cat'       => 'novostrojki'
				);

				$loop = new WP_Query($args);

				while ($loop->have_posts()) : $loop->the_post();
					global $product;

					$desc           = $product->get_short_description();
					$descNoImg      = preg_replace('/(<)([img])(\w+)([^>]*>)/', '', $desc);
					$image          = get_the_post_thumbnail($loop->post->ID, 'large');
					$index          = 1;
					$link           = get_permalink($loop->post->ID);
					$attributes     = $product->get_attributes();

					$realtorPhone   = $product->get_attribute('pa_telefon-rieltora');

					preg_match('@src="([^"]+)"@', $desc, $match);
					$logoLink       = array_pop($match);
					?>

					<div class="new_building_list__item">
						<a class="new_building_list__link" href="<?= $link; ?>">
							<span class="new_building_list__img">
								<?php if ($image) echo $image; ?>
							</span>

							<span class="new_building_list__logo"><img class="js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $logoLink; ?>" alt=""></span>

							<span class="new_building_list__desc"><?= $descNoImg; ?></span>
						</a>
					</div>

					<?php $index++; ?>

					<?php if ($index % 2 == 1) { ?>
						</div>
						<div class="new_building_list__group">
					<?php } ?>
				<?php endwhile; ?>

				<?php wp_reset_query(); ?>
			</div>
		</div>
	</div>

<?php // content
the_content(); ?>

<?php get_footer(); ?>