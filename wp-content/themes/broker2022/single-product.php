
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

<?php
$objectType     = $product->get_attribute('pa_tip-nedvizhimosti');
$objectClass    = $product->get_attribute('pa_klass');
?>

<main class="main_content_wrap">
	<div class="main_content">
		<div class="wrap3">
			<div class="product_info_wrap">
				<div class="product_apt_info">
					<div class="product_info">
						<?php // Тип квартиры
						if ($product -> get_attribute('pa_tip-nedvizhimosti')) { ?>
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
						if ($product -> get_attribute('pa_kolichestvo-komnat')) { ?>
							<div class="product_info__item product_info__item--cols">
								<div class="product_info__value product_info__value--xl"><?php echo $product -> get_attribute('pa_kolichestvo-komnat'); ?></div>
								<div class="product_info__title">Количество<br />комнат</div>
							</div>
						<?php } ?>

						<?php // Этаж
						if ($product -> get_attribute('pa_etazh')) { ?>
							<div class="product_info__item product_info__item--cols">
								<div class="product_info__value product_info__value--xl"><?php echo $product -> get_attribute('pa_etazh'); ?></div>

								<?php // Этажность
								if ($product -> get_attribute('pa_vsego-etazhej')) { ?>
									<div class="product_info_floor">
										<div class="product_info_floor__from">/ <?php echo $product -> get_attribute('pa_vsego-etazhej'); ?></div>
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
						if ($product -> get_attribute('pa_vid-iz-okon')) { ?>
							<div class="product_info__item product_info__item--start">
								<div class="product_info__title product_info__title--short"><?php echo $product -> get_attribute('pa_vid-iz-okon'); ?></div>
							</div>
						<?php } ?>

						<?php // Класс
						if ($product -> get_attribute('pa_klass')) { ?>
							<div class="product_info__item product_info__item--start">
								<div class="product_info__title"><?php echo wc_attribute_label('pa_klass'); ?></div>

								<div class="product_info__value">
									<?php if ($objectClass == 'flat') { ?>
										Апартамент
									<?php }
									else {
										echo $objectClass;
									} ?>
								</div>
							</div>
						<?php } ?>

						<?php // Общая площадь
						if ($product -> get_attribute('pa_obshhaya-ploshhad')) { ?>
							<div class="product_info__item product_info__item--start">
								<div class="product_info__title"><?php echo wc_attribute_label('pa_obshhaya-ploshhad'); ?></div>
								<div class="product_info__value"><?php echo $product -> get_attribute('pa_obshhaya-ploshhad'); ?> <small>м</small><sup>2</sup></div>
							</div>
						<?php } ?>

						<?php // Стоимость
						if ($product -> get_price()) { ?>
							<div class="product_info__item product_info__item--start">
								<div class="product_info__title">Стоимость</div>
								<div class="product_info__value product_info__value--bold"><?php echo number_format($product -> get_price(),0,'',' '); ?>&nbsp;₽</div>
							</div>
						<?php } ?>
					</div>
				</div>

				<div class="product_realtor">
					<?php // Объект №
					if ($product -> get_attribute('pa_nomer-obekta')) { ?>
						<div class="product_info__title">Объект № <?php echo $product -> get_attribute('pa_nomer-obekta'); ?></div>
					<?php } ?>

					<?php // Имя риэлтора
					if ($product -> get_attribute('pa_imya-rieltora')) { ?>
						<div class="product_realtor__name"><?php echo $product -> get_attribute('pa_imya-rieltora'); ?></div>
					<?php } ?>

					<?php // Фото риэлтора
					if ($product -> get_attribute('pa_foto-rieltora')) { ?>
						<img class="product_realtor__img" src="<?php echo $product -> get_attribute('pa_foto-rieltora'); ?>" alt="<?php if ($product -> get_attribute('pa_imya-rieltora')) echo $product -> get_attribute('pa_imya-rieltora'); ?>" />
					<?php } ?>

					<?php // Телефон риэлтора
					if ($product -> get_attribute('pa_telefon-rieltora')) { ?>
						<a class="product_realtor__phone" href="tel:<?php echo $product -> get_attribute('pa_telefon-rieltora'); ?>" target="_blank"><?php echo $product -> get_attribute('pa_telefon-rieltora'); ?></a>
					<?php } ?>

					<?php // Ссылка на презентацию
					if ($product -> get_attribute('pa_ssylka-na-prezentacziyu')) { ?>
						<a class="product_realtor__presentation" href="<?php echo $product -> get_attribute('pa_ssylka-na-prezentacziyu'); ?>" target="_blank">Скачать презентацию</a>
					<?php } ?>
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

	<?php // map
	include_once "template-parts/product_map.php"; ?>

	<ul class="product_gallery">
		<?php // gallery images
		foreach ($gallery_images as $key=>$gallery_image) {
			$image_link = str_replace('https://' . $_SERVER['SERVER_NAME'], '', wp_get_attachment_url($gallery_image)); ?>

			<li class="product_gallery__item">
				<a class="product_gallery__link js-popup-show js-go-to-slide" href="javascript:void(0);" data-popup="product_gallery" data-slide="<?php echo $key; ?>"><img class="product_gallery__img" src="<?php echo $image_link; ?>" alt="" /></a>
			</li>
		<?php } ?>
	</ul>
</main>

<div class="popup popup--product js-popup" data-popup="product_gallery">
	<div class="popup__bg js-popup-close"></div>

	<div class="popup__content">
		<div class="popup__close js-popup-close"></div>

		<div class="product_slider">
			<div class="js-splide-slider splide" data-splide='{"keyboard":"global","type":"loop","perPage":1}'>
				<div class="splide__track">
					<ul class="splide__list">
						<?php // gallery images
						foreach ($gallery_images as $gallery_image) {
							$image_link = str_replace('https://' . $_SERVER['SERVER_NAME'], '', wp_get_attachment_url($gallery_image)); ?>
							<li class="splide__slide">
								<img class="product_slider__img" src="<?php echo $image_link; ?>" alt="" />
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
