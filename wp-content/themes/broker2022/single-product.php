<?php get_header(); ?>

<?php // attributes
global $product;
$gallery_images     = $product->get_gallery_image_ids();
$attributes         = $product->get_attributes();

$productAttrNotShow = [
	'pa_adres',
	'pa_etazh',
	'pa_foto-rieltora',
	'pa_google-api-x',
	'pa_google-api-y',
	'pa_imya-rieltora',
	'pa_klass',
	'pa_kolichestvo-komnat',
	'pa_obshhaya-ploshhad',
	'pa_ssylka-na-prezentacziyu',
	'pa_telefon-rieltora',
	'pa_tip-nedvizhimosti',
	'pa_vid-iz-okon',
	'pa_vsego-etazhej'
]; ?>

<?php // object attributes
$objectClass        = $product->get_attribute('pa_klass');
$objectFloor        = $product->get_attribute('pa_etazh');
$objectFloorTotal   = $product->get_attribute('pa_vsego-etazhej');
$objectId           = $product->get_id();
$objectNumber       = $product->get_attribute('pa_nomer-obekta');
$objectRooms        = $product->get_attribute('pa_kolichestvo-komnat');
$objectSquare       = $product->get_attribute('pa_obshhaya-ploshhad');
$objectType         = $product->get_attribute('pa_tip-nedvizhimosti');
$objectView         = $product->get_attribute('pa_vid-iz-okon');
$pdfLink            = $product->get_attribute('pa_ssylka-na-prezentacziyu') ?: '/ajax_presentation.php?id=' . $objectId;
$price              = $product->get_price();
$realtorName        = $product->get_attribute('pa_imya-rieltora');
$realtorPhone       = $product->get_attribute('pa_telefon-rieltora');
$realtorPhoto       = $product->get_attribute('pa_foto-rieltora');

// get broker image URL [START]
$terms = get_terms('pa_imya-rieltora', array(
	'hide_empty' => false,
	'object_ids' => $objectId
));

$termDesc = "";

foreach ($terms as $term) {
	$termDesc = $term->description;
}

preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $termDesc, $match);

$brokerImgUrl = $match[0][0];
// get broker image URL [END] ?>



<main class="main_content_wrap" data-object-id="<?= $objectId; ?>">
	<div class="main_content">
		<div class="wrap3">
			<div class="product_info_wrap">
				<div class="product_apt_info">
					<div class="product_info">
						<?php // Тип квартиры
						if ($objectType) { ?>
							<div class="product_info__item product_info__item--full-width-mobile">
								<div class="product_info__title"><?= wc_attribute_label('pa_tip-nedvizhimosti'); ?></div>

								<div class="product_info__value">
									<?php if ($objectType == 'flat_and_room') { ?>
										Жилая
									<?php }
									else if ($objectType == 'commerce') { ?>
										Коммерческая
									<?php }
									else if ($objectType == 'house_dacha_cottage') { ?>
										Дом
									<?php }
									else {
										echo $objectType;
									} ?>
								</div>
							</div>
						<?php } ?>
			
						<?php // Количество комнат
						if ($objectRooms) { ?>
							<div class="product_info__item product_info__item--cols">
								<div class="product_info__value product_info__value--xl"><?= $objectRooms; ?></div>
								<div class="product_info__title">Количество<br />комнат</div>
							</div>
						<?php } ?>

						<?php // Этаж
						if ($objectFloor) { ?>
							<div class="product_info__item product_info__item--cols">
								<div class="product_info__value product_info__value--xl"><?= $objectFloor; ?></div>

								<?php // Этажность
								if ($objectFloorTotal) { ?>
									<div class="product_info_floor">
										<div class="product_info_floor__from">/ <?= $objectFloorTotal; ?></div>
										<div class="product_info__title">Этажность</div>
									</div>
								<?php } ?>
							</div>
						<?php } ?>

						<?php // Общая площадь
						if ($objectSquare) { ?>
							<div class="product_info__item product_info__item--start">
								<div class="product_info__title"><?= wc_attribute_label('pa_obshhaya-ploshhad'); ?></div>
								<div class="product_info__value"><?= $objectSquare; ?> <small>м</small><sup>2</sup></div>
							</div>
						<?php } ?>
						<?php // Стоимость
						if ($price) { ?>
							<div class="product_info__item product_info__item--start">
								<div class="product_info__title">Стоимость</div>
								<div class="product_info__value product_info__value--bold"><?= number_format($price,0,'',' '); ?>&nbsp;<?php $attribute_value = $product->get_attribute( 'pa_valyuta' ); echo $attribute_value;?></div>
							</div>
						<?php } ?>
					</div>
						
					<div class="product_desc">
						<?php // content
						the_content(); ?>
					</div>

					<div class="product_info product_info--start">
						<?php // Вид из окон
						if ($objectView) { ?>
							<div class="product_info__item product_info__item--start">
								<div class="product_info__title product_info__title--short"><?= $objectView; ?></div>
							</div>
						<?php } ?>

						<?php // Класс
						if ($objectClass) { ?>
							<div class="product_info__item product_info__item--start">
								<div class="product_info__title"><?= wc_attribute_label('pa_klass'); ?></div>

								<div class="product_info__value">
									<?php if ($objectClass == 'flat') { ?>
										Апартамент
									<?php }
									elseif ($objectClass == 'elite') { ?>
										Элитное жильё
									<?php }
									elseif ($objectClass == 'apartments') { ?>
										Апартаменты
									<?php }
									else {
										echo $objectClass;
									} ?>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>

				<div class="product_realtor">
					<?php // Объект №
					if ($objectNumber) { ?>
						<div class="product_info__title">Объект № <?= $objectNumber; ?></div>
					<?php } ?>

					<?php // Имя риэлтора
					if ($realtorName) { ?>
						<div class="product_realtor__name"><?= $realtorName; ?></div>
					<?php } ?>

					<?php // Фото риэлтора
					if ($brokerImgUrl) { ?>
						<span class="product_realtor__img js-img-scroll" data-src="<?= $brokerImgUrl; ?>" title="<?= $realtorName; ?>"></span>
					<?php }
					else { ?>
						<span class="product_realtor__img_default js-img-scroll" data-src="/wp-content/themes/broker2022/i/logo_dark.svg" title="Topbroker"></span>
					<?php } ?>

					<?php // Телефон риэлтора
					if ($realtorPhone) { ?>
						<a class="product_realtor__phone" href="tel:<?= str_replace(' ', '', $realtorPhone); ?>" target="_blank"><?= $realtorPhone; ?></a>
					<?php }
					else { ?>
						<a class="product_realtor__phone" href="tel:+79778021616" target="_blank">+7(977) 802-16-16</a>
					<?php } ?>

					<a class="product_realtor__phone js-popup-show" href="javascript:void(0);" data-popup="feedback">Заказать просмотр</a>

					<a class="product_realtor__presentation" href="<?= $pdfLink; ?>" target="_blank">Скачать презентацию</a>
				</div>
			</div>

			<div class="product_attr_list">
				<?php if (!$attributes) return;

				$display_result = '';

				foreach ($attributes as $attribute) {
					if ($attribute->get_variation()) {
						continue;
					}

					// to make attribute visible only for admin [START]
					$isVisible = $attribute->get_visible();

					if (!current_user_can('manage_options') && !$isVisible) {
						continue;
					}
					// to make attribute visible only for admin [END]

					$name = $attribute->get_name();

					if (!in_array($name, $productAttrNotShow)) {
						if ($attribute->is_taxonomy()) {
							$terms                  = wp_get_post_terms($product->get_id(), $name, 'all');
							$cwtax                  = $terms[0]->taxonomy;
							$cw_object_taxonomy     = get_taxonomy($cwtax);

							if (isset($cw_object_taxonomy->labels->singular_name)) {
								$tax_label = $cw_object_taxonomy->labels->singular_name;
							}
							elseif (isset($cw_object_taxonomy->label)) {
								$tax_label = $cw_object_taxonomy->label;

								if (0 === strpos($tax_label, 'Product ')) {
									$tax_label = substr($tax_label, 8);
								}
							}

							$display_result .= '<div class="product_attr_item" data-name="' . $name . '" data-visible="' . $isVisible . '"><span class="product_attr_item__name">' . $tax_label . '</span>';
							$tax_terms = array();

							foreach ($terms as $term) {
								$single_term = esc_html($term->name);
								array_push($tax_terms, $single_term);
							}

							$display_result .= '<span class="product_attr_item__val">' . implode(', ', $tax_terms) .  '</span></div>';
						}
						else {
							$display_result .= '<div class="product_attr_item"><span class="product_attr_item__name">' . $name . '</span>';
							$display_result .= '<span class="product_attr_item__val">' . esc_html(implode(', ', $attribute->get_options())) . '</span></div>';
						}
					}
				}

				echo $display_result; ?>
			</div>

			<?php // posts
			if (have_posts()) {
				while ( have_posts() ) {
					the_post();
				}
			} ?>
		</div>
	</div>

	<ul class="product_gallery">
		<?php // gallery images
		foreach ($gallery_images as $key => $gallery_image) {
			// thumbnail | medium | large | full
			$image_link = str_replace('https://' . $_SERVER['SERVER_NAME'], '', wp_get_attachment_image_url($gallery_image, 'medium')); ?>

			<li class="product_gallery__item">
				<a class="product_gallery__link js-popup-show js-go-to-slide" href="javascript:void(0);" data-popup="product_gallery" data-slide="<?= $key; ?>">
					<span class="product_gallery__img js-img-scroll" data-src="<?= $image_link; ?>"></span>
				</a>
			</li>
		<?php } ?>
	</ul>

	<?php // map
	include_once "template-parts/product_map.php"; ?>
</main>

<?php // popup gallery ?>
<div class="popup popup--product js-popup" data-popup="product_gallery">
	<div class="popup__bg js-popup-close"></div>

	<div class="popup__content">
		<div class="popup__close js-popup-close"></div>

		<div class="product_slider">
			<div class="owl-carousel js-owl-carousel">
				<?php // gallery images
				foreach ($gallery_images as $gallery_image) {
					// thumbnail | medium | large | full
					$image_link = str_replace('https://' . $_SERVER['SERVER_NAME'], '', wp_get_attachment_image_url($gallery_image, 'large')); ?>

					<span class="product_slider__img js-img-scroll" data-src="<?= $image_link; ?>"></span>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>