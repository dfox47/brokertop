<?php
/*
* Template Name: Новостройки
* Template Post Type: post, page, product
*/
?>

<?php get_header(); ?>

	<div class="wrap_bg">
		<h1>Жилые комплексы Москвы</h1>

		<div class="wrap">
			<div class="new_building_list owl-carousel js-owl-buildings">
				<?php $args = array(
					'posts_per_page'    => 40,
					'product_cat'       => 'novostrojki'
				);

				$loop = new WP_Query($args);
				$index = 0;

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

					preg_match('@src="([^"]+)"@', $desc, $match);
					$logoLink       = array_pop($match); ?>

					<?php if ($index % 2 !== 1) { ?>
						<div class="new_building_list__group">
					<?php } ?>

					<div class="new_building_list__item js-buildings-item js-popup-show" data-popup="with_content">
						<div class="new_building_list__link">
							<span class="new_building_list__img"><?php if ($image) echo $image; ?></span>

							<span class="new_building_list__logo js-img-scroll" data-src="<?= $logoLink; ?>"></span>

							<span class="new_building_list__desc">
								<?= $descNoImg; ?>

								<span class="new_building_links">
									<?php if ($pdfLink) { ?>
										<a class="new_building_links__item new_building__presentation social_list__icon social_list__icon--dark js-pdf-link" href="<?= $pdfLink; ?>" target="_blank" title="Презентация"></a>
									<?php } ?>

									<?php if ($realtorPhone) { ?>
										<a class="new_building_links__item social_list__icon social_list__icon--dark social_list__icon--whatsapp" href="//wa.me/<?= $realtorPhone; ?>" target="_blank" rel="noopener" title="whatsapp"></a>
									<?php }  ?>

									<a class="new_building_links__item social_list__icon social_list__icon--dark social_list__icon--telegram" href="//t.me/topbrokerestate" target="_blank" rel="noopener" title="telegram"></a>
								</span>
							</span>
						</div>

						<div class="hidden js-popup-content-put">
							<div class="product_slider">
								<div class="owl-carousel js-popup-owl-carousel">
									<?php // gallery images
									foreach ($galleryImages as $galleryImage) {
										// thumbnail | medium | large | full
										$imageLink = str_replace('https://' . $_SERVER['SERVER_NAME'], '', wp_get_attachment_url($galleryImage)); ?>

										<img class="product_slider__img js-img-scroll" src="<?= $imageLink; ?>" data-src="<?= $imageLink; ?>" alt="">
									<?php } ?>
								</div>
							</div>

							<div class="new_building_popup_desc">
								<span class="js-img-scroll" data-src="<?= $logoLink; ?>"></span>

								<div class="new_building_popup_desc__text"><?= $descNoImg; ?></div>
							</div>

							<span class="new_building_popup_links">
								<?php if ($pdfLink) { ?>
									<a class="new_building_popup_links__item new_building_popup_link__presentation js-pdf-link" href="<?= $pdfLink; ?>" target="_blank">Скачать презентацию</a>
								<?php } ?>

								<div class="new_building_popup_links__social">
									<?php if ($realtorPhone) { ?>
										<a class="new_building_popup_links__item social_list__icon social_list__icon--whatsapp" href="//wa.me/<?= $realtorPhone; ?>" target="_blank" rel="noopener" title="whatsapp"></a>
									<?php } ?>

									<a class="new_building_popup_links__item social_list__icon social_list__icon--telegram" href="//t.me/+79778021616" target="_blank" rel="noopener" title="telegram"></a>
								</div>
							</span>
						</div>
					</div>

					<?php if ($index % 2 == 1) { ?>
						</div>
					<?php } ?>

					<?php $index++; ?>
				<?php endwhile; ?>

				<?php if ($index % 2 !== 1) { ?>
			</div>
			<?php } ?>

			<?php wp_reset_query(); ?>
		</div>
	</div>
	</div>
	</div>

<?php the_content(); ?>

<?php get_footer(); ?>