<?php // link to images folder
$i = '/wp-content/themes/broker2022/i/hero'; ?>

<div class="hero_block_slider">
	<div class="owl-carousel js-owl-carousel-auto-height">
		<div class="hero_block_slide">
			<span class="hero_block_slide__img js-img-scroll" data-src="<?= $i; ?>/20.jpg"></span>

			<div class="hero_block_slide__content">
				<div class="hero_block_slide__title">Новостройки</div>

				<div class="hero_block_slide__desc">Квартиры и апартаменты в лучших жилых комплексах Москвы и Подмосковья</div>

				<div class="hero_block_slide__more"><a class="btn btn_more btn__animated js-popup-show" href="javascript:void(0);" data-popup="feedback-7626">Получить планировки и цены</a></div>
			</div>
		</div>

		<div class="hero_block_slide hero_block_slide--light">
			<span class="hero_block_slide__img js-img-scroll" data-src="<?= $i; ?>/23.jpg"></span>

			<div class="hero_block_slide__content">
				<?= do_shortcode('[contact-form-7 id="7237"]'); ?>
			</div>
		</div>
	</div>

	<?php wp_reset_query(); ?>
</div>