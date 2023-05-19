<?php
/*
* Template Name: О компании
* Template Post Type: post, page, product
*/
?>

<?php // link to dumm img
$dumm = '/wp-content/themes/broker2022/i/dumm.png'; ?>

<?php get_header(); ?>

	<div class="wrap">
		<div class="js-about-title"></div>
	</div>

	<div class="js-about-quote"></div>

	<div class="about_examples">
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

					<div class="wp-block-image js-popup-show" data-popup="with_content">
						<?php if ($image) echo $image; ?>

						<div class="about_objects_desc">
							<?= $descNoImg; ?>

							<?php if ($objectAddress !== '') { ?>
								<span class="projects_gallery__alt"><?= $objectAddress; ?></span>
							<?php } ?>
						</div>

						<div class="hidden js-popup-content-put">
							<div class="product_slider">
								<div class="owl-carousel js-popup-owl-carousel">
									<?php // gallery images
									foreach ($galleryImages as $galleryImage) {
										// thumbnail | medium | large | full
										$imageLink = str_replace('https://' . $_SERVER['SERVER_NAME'], '', wp_get_attachment_url($galleryImage)); ?>

										<img class="product_slider__img js-img-lazy" src="<?= $dumm; ?>" data-src="<?= $imageLink; ?>" alt="" loading="lazy">
									<?php } ?>
								</div>
							</div>

							<div class="new_building_popup_desc">
								<div class="new_building_popup_desc__text"><?= $descNoImg; ?></div>
							</div>

							<span class="new_building_popup_links">
								<?php if ($pdfLink) { ?>
									<a class="new_building_popup_links__item new_building_popup_link__presentation" href="<?= $pdfLink; ?>" target="_blank">Скачать презентацию</a>
								<?php } ?>

								<div class="new_building_popup_links__social">
									<?php if ($realtorPhone) { ?>
										<a class="new_building_popup_links__item social_list__icon social_list__icon--whatsapp" href="//wa.me/<?= $realtorPhone; ?>" target="_blank" rel="noopener" title="whatsapp"></a>
									<?php } ?>

									<a class="new_building_popup_links__item social_list__icon social_list__icon--telegram" href="//t.me/topbrokerestate" target="_blank" rel="noopener" title="telegram"></a>
								</div>
							</span>
						</div>
					</div>
				<?php endwhile; ?>

				<?php wp_reset_query(); ?>
			</figure>
		</div>
	</div>

<?php // content
the_content(); ?>

<?php get_footer(); ?>