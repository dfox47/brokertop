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
		<div class="wrap">
			<?php // content
			the_content(); ?>

			<div class="new_building_list owl-carousel js-owl-buildings">
				<div class="new_building_list__group">
					<?php
					$args = array(
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
					$image          = get_the_post_thumbnail($id, 'large');
					$link           = get_permalink($id);
					$attributes     = $product->get_attributes();
					$realtorPhone   = preg_replace('/\D/', '', $product->get_attribute('pa_telefon-rieltora'));
					$pdfLink        = $product->get_attribute('pa_ssylka-na-prezentacziyu') ?: '/ajax_presentation.php?id=' . $id;

					preg_match('@src="([^"]+)"@', $desc, $match);
					$logoLink       = array_pop($match);
					?>

					<div class="new_building_list__item">
						<div class="new_building_list__link">
							<span class="new_building_list__img"><?php if ($image) echo $image; ?></span>

							<span class="new_building_list__logo"><img class="js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $logoLink; ?>" alt=""></span>

							<span class="new_building_list__desc">
								<?= $descNoImg; ?>

								<span class="new_building_links">
									<?php if ($pdfLink) { ?>
										<a class="new_building_links__item new_building__presentation" href="<?= $pdfLink; ?>" target="_blank"></a>
									<?php } ?>

									<?php if ($realtorPhone) { ?>
										<a class="new_building_links__item social_list__icon social_list__icon--whatsapp" href="//wa.me/<?= $realtorPhone; ?>" target="_blank" rel="noopener" title="whatsapp"></a>
									<?php }  ?>

									<a class="new_building_links__item social_list__icon social_list__icon--telegram" href="//t.me/top_broker_estate" target="_blank" rel="noopener" title="telegram"></a>
								</span>
							</span>
						</div>
					</div>

					<?php if ($index % 2 == 1) { ?>
				</div>
				<div class="new_building_list__group">
					<?php } ?>

					<?php $index++; ?>
					<?php endwhile; ?>

					<?php wp_reset_query(); ?>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>