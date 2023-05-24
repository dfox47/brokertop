<?php
/*
* Template Name: О компании
* Template Post Type: post, page, product
*/
?>

<?php get_header(); ?>

	<div class="wrap">
		<div class="js-about-title"></div>
	</div>

	<div class="wrap5">
		<div class="js-about-quote"></div>
	</div>

	<div class="about_examples">
		<div class="wrap5">
			<div class="wp-block-group__inner-container">
				<h2>Примеры успешных сделок Top Broker estate</h2>

				<figure class="js-projects-gallery projects_gallery is-layout-flex">
					<?php $args = array(
						'posts_per_page'    => 40,
						'product_cat'       => 'uspeshnye-sdelki'
					);

					$loop = new WP_Query($args);

					while ($loop->have_posts()) : $loop->the_post();
						global $product;

						$id             = $loop->post->ID;
						$desc           = $product->get_short_description();
						$descNoImg      = preg_replace('/(<)([img])(\w+)([^>]*>)/', '', $desc);
						$galleryImages  = $product->get_gallery_image_ids();
						$image          = get_the_post_thumbnail($id, 'large');
						$link           = get_permalink($id);
						$realtorPhone   = $product->get_attribute('pa_telefon-rieltora') ? preg_replace('/\D/', '', $product->get_attribute('pa_telefon-rieltora')) : '79778021616';
						$pdfLink        = $product->get_attribute('pa_ssylka-na-prezentacziyu') ?: '/ajax_presentation.php?id=' . $id;
						$objectAddress  = $product->get_attribute('pa_adres') ? $product->get_attribute('pa_adres') : '';

						preg_match('@src="([^"]+)"@', $desc, $match);
						$logoLink       = array_pop($match); ?>

						<div class="wp-block-image">
							<?php if ($image) echo $image; ?>

							<div class="about_objects_desc">
								<?= $descNoImg; ?>

								<?php if ($objectAddress !== '') { ?>
									<span class="projects_gallery__alt"><?= $objectAddress; ?></span>
								<?php } ?>
							</div>
						</div>
					<?php endwhile; ?>

					<?php wp_reset_query(); ?>
				</figure>
			</div>
		</div>
	</div>

<?php // content
the_content(); ?>

<?php get_footer(); ?>