<?php // link to images folder
$i      = '/wp-content/themes/broker2022/i/hero';
$dumm   = '/wp-content/themes/broker2022/i/dumm.png';

// thumb img url
$thumbUrl = '';

if (get_the_post_thumbnail_url()) {
	$thumbUrl = str_replace('https://' . $_SERVER['SERVER_NAME'], '', get_the_post_thumbnail_url());
} ?>

<div class="hero_block_slider">
	<div class="owl-carousel js-owl-carousel">
		<div class="hero_block_slide">
			<?php if ($thumbUrl !== '') { ?>
				<img class="hero_block_slide__img js-img-scroll" src="<?= $dumm; ?>" data-src="<?php echo $thumbUrl; ?>" alt="" loading="lazy">
			<?php } ?>

			<div class="hero_block_slide__content">
				<div class="hero_block_slide__title">Зарубежная недвижимость</div>

				<div class="hero_block_slide__desc">Апартаменты, виллы и готовый бизнес в Объединенных Арабских Эмиратах, Великобритании, Катаре, Северном и Южном Кипре.</div>

				<div class="hero_block_slide__more"><a class="btn btn_more btn__animated js-popup-show" href="javascript:void(0);" data-popup="feedback-7626">Оставить заявку на бесплатную консультацию</a></div>
			</div>
		</div>

		<div class="hero_block_slide hero_block_slide--light">
			<img class="hero_block_slide__img js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $i; ?>/23.jpg" alt="" loading="lazy">

			<div class="hero_block_slide__content">
				<?= do_shortcode('[contact-form-7 id="7237"]'); ?>
			</div>
		</div>
	</div>

	<?php wp_reset_query(); ?>
</div>