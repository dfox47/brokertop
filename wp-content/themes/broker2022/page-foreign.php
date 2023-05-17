<?php
/*
* Template Name: Зарубежная недвижимость
* Template Post Type: post, page, product
*/
?>

<?php // link to dumm img
$dumm = '/wp-content/themes/broker2022/i/dumm.png'; ?>

<?php get_header(); ?>

<div class="wrap_bg">
	<h1>Жилые комплексы</h1>

	<div class="wrap">
		<div class="new_building_list owl-carousel js-owl-buildings">
			<?php $args = array(
				'posts_per_page'    => 40,
				'product_cat'       => 'zarubezhnaya-nedvizhimost'
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

						<img class="new_building_list__logo js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $logoLink; ?>" alt="" loading="lazy">

						<span class="new_building_list__desc">
								<?= $descNoImg; ?>

								<span class="new_building_links">
									<?php if ($pdfLink) { ?>
										<a class="new_building_links__item new_building__presentation" href="<?= $pdfLink; ?>" target="_blank"></a>
									<?php } ?>

									<?php if ($realtorPhone) { ?>
										<a class="new_building_links__item social_list__icon social_list__icon--whatsapp" href="//wa.me/<?= $realtorPhone; ?>" target="_blank" rel="noopener" title="whatsapp"></a>
									<?php } ?>

									<a class="new_building_links__item social_list__icon social_list__icon--telegram" href="//t.me/topbrokerestate" target="_blank" rel="noopener" title="telegram"></a>
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

									<img class="product_slider__img js-img-lazy" src="<?= $dumm; ?>" data-src="<?= $imageLink; ?>" alt="" loading="lazy">
								<?php } ?>
							</div>
						</div>

						<div class="new_building_popup_desc">
							<img class="js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $logoLink; ?>" alt="" loading="lazy">

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

<?php // content
the_content(); ?>

<?php get_footer(); ?>