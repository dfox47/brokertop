
<?php get_header(); ?>

<?php // attributes
global $product;
$gallery_images = $product->get_gallery_image_ids();

$productAttributes = [
//	'pa_material-doma',
//	'pa_rajony',
//	'pa_remont',
//	'pa_stancziya-metro'
]; ?>

<?php // filter
//if (is_active_sidebar('woocommerce_filter')) { ?>
<!--	--><?php //dynamic_sidebar('woocommerce_filter'); ?>
<?php //} ?>

<?php // object attribites
$objectClass        = $product->get_attribute('pa_klass');
$objectFloor        = $product->get_attribute('pa_etazh');
$objectFloorTotal   = $product->get_attribute('pa_vsego-etazhej');
$objectId           = $product->get_id();
$objectRooms        = $product->get_attribute('pa_kolichestvo-komnat');
$objectSquare       = $product->get_attribute('pa_obshhaya-ploshhad');
$objectType         = $product->get_attribute('pa_tip-nedvizhimosti');
$objectView         = $product->get_attribute('pa_vid-iz-okon');
$pdfLink            = $product->get_attribute('pa_ssylka-na-prezentacziyu');
$pdfOnServer        = 'wp-content/themes/broker2022/pdf/' . $objectId . '.pdf';
$price              = $product->get_price();
$realtorName        = $product->get_attribute('pa_imya-rieltora');
$realtorPhone       = $product->get_attribute('pa_telefon-rieltora');
$realtorPhoto       = $product->get_attribute('pa_foto-rieltora');
?>

<main class="main_content_wrap" data-object-id="<?php echo $objectId; ?>" data-link="<?php echo $pdfOnServer; ?>">
	<div class="main_content">
		<div class="wrap3">
			<div class="product_info_wrap">
				<div class="product_apt_info">
					<div class="product_info">
						<?php // Тип квартиры
						if ($objectType) { ?>
							<div class="product_info__item product_info__item--full-width-mobile">
								<div class="product_info__title"><?php echo wc_attribute_label('pa_tip-nedvizhimosti'); ?></div>

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
								<div class="product_info__value product_info__value--xl"><?php echo $objectRooms; ?></div>
								<div class="product_info__title">Количество<br />комнат</div>
							</div>
						<?php } ?>

						<?php // Этаж
						if ($objectFloor) { ?>
							<div class="product_info__item product_info__item--cols">
								<div class="product_info__value product_info__value--xl"><?php echo $objectFloor; ?></div>

								<?php // Этажность
								if ($objectFloorTotal) { ?>
									<div class="product_info_floor">
										<div class="product_info_floor__from">/ <?php echo $objectFloorTotal; ?></div>
										<div class="product_info__title">Этажность</div>
									</div>
								<?php } ?>
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
								<div class="product_info__title product_info__title--short"><?php echo $objectView; ?></div>
							</div>
						<?php } ?>

						<?php // Класс
						if ($objectClass) { ?>
							<div class="product_info__item product_info__item--start">
								<div class="product_info__title"><?php echo wc_attribute_label('pa_klass'); ?></div>

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

						<?php // Общая площадь
						if ($objectSquare) { ?>
							<div class="product_info__item product_info__item--start">
								<div class="product_info__title"><?php echo wc_attribute_label('pa_obshhaya-ploshhad'); ?></div>
								<div class="product_info__value"><?php echo $objectSquare; ?> <small>м</small><sup>2</sup></div>
							</div>
						<?php } ?>

						<?php // Стоимость
						if ($price) { ?>
							<div class="product_info__item product_info__item--start">
								<div class="product_info__title">Стоимость</div>
								<div class="product_info__value product_info__value--bold"><?php echo number_format($price,0,'',' '); ?>&nbsp;₽</div>
							</div>
						<?php } ?>
					</div>
				</div>

				<div class="product_realtor">
					<?php // Объект №
					if ($product -> get_attribute('pa_nomer-obekta')) { ?>
						<div class="product_info__title">Объект № <?php echo $product->get_attribute('pa_nomer-obekta'); ?></div>
					<?php } ?>

					<?php // Имя риэлтора
					if ($realtorName) { ?>
						<div class="product_realtor__name"><?php echo $realtorName; ?></div>

						<?php // Андреев Борис
						if ($realtorName == 'Андреев Борис') { ?>
							<img class="product_realtor__img" src="/wp-content/themes/broker2022/i/team/andreev.png" alt="<?php echo $realtorName; ?>" />
							<a class="product_realtor__phone" href="tel:+79778021616" target="_blank">+7(977) 802-16-16</a>
						<?php }
						// Сорокина Ульяна
						elseif ($realtorName == 'Сорокина Ульяна') { ?>
							<img class="product_realtor__img" src="/wp-content/themes/broker2022/i/team/sorokina.png" alt="<?php echo $realtorName; ?>" />
							<a class="product_realtor__phone" href="tel:+79778021616" target="_blank">+7(977) 802-16-16</a>
						<?php }
						else { ?>
							<?php // Фото риэлтора
							if ($realtorPhoto) { ?>
								<img class="product_realtor__img" src="<?php echo $realtorPhoto; ?>" alt="<?php echo $realtorName; ?>" />
							<?php } ?>

							<?php // Телефон риэлтора
							if ($realtorPhone) { ?>
								<a class="product_realtor__phone" href="tel:<?php echo $realtorPhone; ?>" target="_blank"><?php echo $realtorPhone; ?></a>
							<?php } ?>
						<?php } ?>
					<?php }
					// default | Баширова Юлия
					else { ?>
						<div class="product_realtor__name">Баширова Юлия</div>
						<img class="product_realtor__img" src="/wp-content/themes/broker2022/i/team/bashirova.png" alt="Баширова Юлия" />
<!--						<a class="product_realtor__phone" href="tel:+79267989236" target="_blank">+7(926) 798-92-36</a>-->
						<a class="product_realtor__phone" href="tel:+79778021616" target="_blank">+7(977) 802-16-16</a>
					<?php } ?>

					<a class="product_realtor__phone js-popup-show" href="javascript:void(0);" data-popup="feedback">Обратная связь</a>

					<?php // Ссылка на презентацию
					/*
					if ($pdfLink) { ?>
						<a class="product_realtor__presentation" href="<?php echo $pdfLink; ?>" target="_blank">Скачать презентацию</a>
					<?php }
					elseif (file_exists($pdfOnServer)) { ?>
						<a class="product_realtor__presentation" href="/<?php echo $pdfOnServer; ?>" target="_blank">Скачать презентацию</a>
					<?php } */?>
					<a class="product_realtor__presentation" href="/ajax_presentation.php?id=<?php echo $objectId; ?>" target="_blank">Скачать презентацию</a>
				</div>
			</div>

			<?php // attributes
			foreach ($productAttributes as $productAttribute) {
				$value      = $product -> get_attribute($productAttribute);
				$label      = wc_attribute_label($productAttribute);

				if ($value) { ?>
					<div><?php echo $label; ?> --|-- <?php echo $value; ?></div>
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
		foreach ($gallery_images as $key=>$gallery_image) {
			$image_link = str_replace('https://' . $_SERVER['SERVER_NAME'], '', wp_get_attachment_url($gallery_image)); ?>

			<li class="product_gallery__item">
				<a class="product_gallery__link js-popup-show js-go-to-slide" href="javascript:void(0);" data-popup="product_gallery" data-slide="<?php echo $key; ?>"><img class="product_gallery__img" src="<?php echo $image_link; ?>" alt="" /></a>
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
					$image_link = str_replace('https://' . $_SERVER['SERVER_NAME'], '', wp_get_attachment_url($gallery_image)); ?>
					<img class="product_slider__img" src="<?php echo $image_link; ?>" alt="" />
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php // feedback popup ?>
<div class="popup popup--feedback js-popup" data-popup="feedback">
	<div class="popup__bg js-popup-close"></div>

	<div class="popup__content">
		<div class="popup__close js-popup-close"></div>

		<div class="contacts_form">
			<?php echo do_shortcode('[contact-form-7 id="63" title="Обратная связь"]'); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
