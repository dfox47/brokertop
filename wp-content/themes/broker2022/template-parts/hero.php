<?php // link to images folder
$i      = '/wp-content/themes/broker2022/i/hero';
$dumm   = '/wp-content/themes/broker2022/i/dumm.png';
?>

<div class="hero_block_slider">
<!--	<div class="owl-carousel js-owl-carousel-auto">-->
	<div class="owl-carousel js-owl-carousel">
		<div class="hero_block_slide">
			<img class="hero_block_slide__img js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $i; ?>/17.jpg" alt="" loading="lazy">

			<div class="hero_block_slide__content">
				<div class="hero_block_slide__title">Каталог недвижимости</div>

				<div class="hero_block_slide__developer">
					<a class="hero_block_slide__developer_link js-menu-item-disabled" href="//novostroiki-moscow.com/">Новостройки</a>
				</div>

				<div class="hero_block_slide__thumb_wrap">
					<img class="hero_block_slide__thumb js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $i; ?>/8.jpg" alt="" loading="lazy">
				</div>

				<div class="hero_block_slide__more"><a class="btn btn_more" href="/shop/">Открыть</a></div>
			</div>
		</div>

		<div class="hero_block_slide">
			<img class="hero_block_slide__img js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $i; ?>/8.jpg" alt="" loading="lazy">

			<div class="hero_block_slide__content">
				<div class="hero_block_slide__title">Новостройки</div>

				<div class="hero_block_slide__developer">
					<a class="hero_block_slide__developer_link js-menu-item-disabled" href="//dubaiestate.top/">Дубай / Dubai</a>
				</div>

				<div class="hero_block_slide__thumb_wrap">
					<img class="hero_block_slide__thumb js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $i; ?>/3.jpg" alt="" loading="lazy">
				</div>

				<div class="hero_block_slide__more"><a class="btn btn_more js-menu-item-disabled" href="//novostroiki-moscow.com/">Открыть</a></div>
			</div>
		</div>

		<div class="hero_block_slide">
			<img class="hero_block_slide__img js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $i; ?>/3.jpg" alt="" loading="lazy">

			<div class="hero_block_slide__content">
				<div class="hero_block_slide__title">Дубай / Dubai</div>

				<div class="hero_block_slide__developer">
					<a class="hero_block_slide__developer_link" href="/o-kompanii/">О компании</a>
				</div>

				<div class="hero_block_slide__thumb_wrap">
					<img class="hero_block_slide__thumb js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $i; ?>/18.jpg" alt="" loading="lazy">
				</div>

				<div class="hero_block_slide__more"><a class="btn btn_more js-menu-item-disabled" href="//dubaiestate.top/">Открыть</a></div>
			</div>
		</div>

		<div class="hero_block_slide">
			<img class="hero_block_slide__img js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $i; ?>/18.jpg" alt="" loading="lazy">

			<div class="hero_block_slide__content">
				<div class="hero_block_slide__title">О компании</div>

				<div class="hero_block_slide__developer">
					<a class="hero_block_slide__developer_link" href="/novosti/">Новости</a>
				</div>

				<div class="hero_block_slide__thumb_wrap">
					<img class="hero_block_slide__thumb js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $i; ?>/1.jpg" alt="" loading="lazy">
				</div>

				<div class="hero_block_slide__more"><a class="btn btn_more" href="/o-kompanii/">Открыть</a></div>
			</div>
		</div>

		<div class="hero_block_slide">
			<img class="hero_block_slide__img js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $i; ?>/1.jpg" alt="" loading="lazy">

			<div class="hero_block_slide__content">
				<div class="hero_block_slide__title">Новости</div>

				<div class="hero_block_slide__developer">
					<a class="hero_block_slide__developer_link" href="/shop/">Каталог недвижимости</a>
				</div>

				<div class="hero_block_slide__thumb_wrap">
					<img class="hero_block_slide__thumb js-img-scroll" src="<?= $dumm; ?>" data-src="<?= $i; ?>/17.jpg" alt="" loading="lazy">
				</div>

				<div class="hero_block_slide__more"><a class="btn btn_more" href="/novosti/">Открыть</a></div>
			</div>
		</div>
	</div>

	<?php wp_reset_query(); ?>
</div>

<div class="hero_block__footer">
	<?php // copyright
	include_once "copyright.php"; ?>
</div>
