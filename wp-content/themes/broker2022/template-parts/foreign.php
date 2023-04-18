<?php // link to images folder
$i      = '/wp-content/themes/broker2022/i/hero';
$dumm   = '/wp-content/themes/broker2022/i/dumm.png';
?>

<div class="hero_block_slider">
	<div class="owl-carousel js-owl-carousel">
		<div class="hero_block_slide">
			<img class="hero_block_slide__img js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $i; ?>/22.jpg" alt="">

			<div class="hero_block_slide__content">
				<div class="hero_block_slide__title">Зарубежная недвижимость</div>

				<div class="hero_block_slide__desc">Апартаменты, виллы и готовый бизнес в Объединенных Арабских Эмиратах, Великобритании, Катаре, Северном и Южном Кипре.</div>

				<div class="hero_block_slide__more"><a class="btn btn_more" href="/shop/">Получить планировки и цены</a></div>
			</div>
		</div>

		<div class="hero_block_slide hero_block_slide--light">
			<img class="hero_block_slide__img js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $i; ?>/21.jpg" alt="">

			<div class="hero_block_slide__content">
				<?= do_shortcode('[contact-form-7 id="7237"]'); ?>
			</div>
		</div>
	</div>

	<?php wp_reset_query(); ?>
</div>