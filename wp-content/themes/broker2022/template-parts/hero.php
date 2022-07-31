
<?php
$i = '/wp-content/themes/broker2022/i';
$heroImages = $i . '/hero';
?>

<div class="hero_block_slider">
	<div class="cs3-wrap">
		<div class="cs3 js-hero-slider">
			<?php $args = array(
				'orderby'           => 'rand',
				'post_type'         => 'product',
				'posts_per_page'    => -1,
//				'product_cat'       => 'kupit',
				'product_cat'       => 'arendovat'
			);

			$loop = new WP_Query( $args );

			// thumb
//			while ($loop->have_posts()) :
//				$loop->the_post();
//				global $product; ?>
<!---->
<!--				<div class="cs3-slide">-->
<!--					--><?php //// thumb img url
//					$thumbUrl = '';
//
//					if (get_the_post_thumbnail_url()) {
//						$thumbUrl = str_replace('https://' . $_SERVER['SERVER_NAME'], '', get_the_post_thumbnail_url()); ?>
<!--						<div class="hero_block_slide">-->
<!--							<img class="hero_block_slide__img" src="--><?php //echo $thumbUrl; ?><!--" alt="" />-->
<!--						</div>-->
<!--					--><?php //} ?>
<!--				</div>-->
<!--			--><?php //endwhile; ?>

			<div class="cs3-slide">
				<div class="hero_block_slide"><img class="hero_block_slide__img" src="<?php echo $heroImages; ?>/17.jpg" alt="" /></div>
			</div>

			<div class="cs3-slide">
				<div class="hero_block_slide"><img class="hero_block_slide__img" src="<?php echo $heroImages; ?>/8.jpg" alt="" /></div>
			</div>

			<div class="cs3-slide">
				<div class="hero_block_slide"><img class="hero_block_slide__img" src="<?php echo $heroImages; ?>/3.jpg" alt="" /></div>
			</div>

			<div class="cs3-slide">
				<div class="hero_block_slide"><img class="hero_block_slide__img" src="<?php echo $heroImages; ?>/18.jpg" alt="" /></div>
			</div>

			<div class="cs3-slide">
				<div class="hero_block_slide"><img class="hero_block_slide__img" src="<?php echo $heroImages; ?>/1.jpg" alt="" /></div>
			</div>



			<div class="hero_slider_arrow hero_slider_arrow__prev js-hero-slider-prev"></div>
			<div class="hero_slider_arrow hero_slider_arrow__next js-hero-slider-next"></div>

			<div class="hero_slider_pagination js-hero-slider-pagination"></div>

			<div class="cs3-captions">
				<div class="cs3-caption">
					<div class="hero_block_slide__content">
						<div class="hero_block_slide__title">Каталог недвижимости</div>

						<a class="hero_block_slide__developer" href="//novostroiki-moscow.com/">Новостройки</a>

						<div class="hero_block_slide__more"><a class="btn btn_more" href="/shop/">Открыть</a></div>
					</div>
				</div>

				<div class="cs3-caption">
					<div class="hero_block_slide__content">
						<div class="hero_block_slide__title">Новостройки</div>

						<a class="hero_block_slide__developer" href="//dubaiestate.top/">Дубай/Dubai</a>

						<div class="hero_block_slide__more"><a class="btn btn_more" href="//novostroiki-moscow.com/">Открыть</a></div>
					</div>
				</div>

				<div class="cs3-caption">
					<div class="hero_block_slide__content">
						<div class="hero_block_slide__title">Дубай/Dubai</div>

						<a class="hero_block_slide__developer" href="/o-kompanii/">О компании</a>

						<div class="hero_block_slide__more"><a class="btn btn_more" href="//dubaiestate.top/">Открыть</a></div>
					</div>
				</div>

				<div class="cs3-caption">
					<div class="hero_block_slide__content">
						<div class="hero_block_slide__title">О компании</div>

						<a class="hero_block_slide__developer" href="/novosti/">Новости</a>

						<div class="hero_block_slide__more"><a class="btn btn_more" href="/o-kompanii/">Открыть</a></div>
					</div>
				</div>

				<div class="cs3-caption">
					<div class="hero_block_slide__content">
						<div class="hero_block_slide__title">Новости</div>

						<a class="hero_block_slide__developer" href="/shop/">Каталог недвижимости</a>

						<div class="hero_block_slide__more"><a class="btn btn_more" href="/novosti/">Открыть</a></div>
					</div>
				</div>

<!--				--><?php //while ($loop->have_posts()) :
//					$loop->the_post();
//					global $product; ?>
<!---->
<!--					<div class="cs3-caption">-->
<!--						<div class="hero_block_slide__content">-->
<!--							<div class="hero_block_slide__title">--><?php //the_title(); ?><!--</div>-->
<!---->
<!--							--><?php //// address
//							if ($product->get_attribute('pa_adres')) { ?>
<!--								<div class="hero_block_slide__address"><span>--><?php //echo $product->get_attribute('pa_adres'); ?><!--</span></div>-->
<!--							--><?php //} ?>
<!---->
<!--							<div class="hero_block_slide__more">-->
<!--								<a class="btn btn_more" href="--><?php //echo get_permalink($loop->post->ID) ?><!--">Подробнее</a>-->
<!--							</div>-->
<!---->
<!--							--><?php //// developer
//							if ($product->get_attribute('zastrojshhik')) { ?>
<!--								<div class="hero_block_slide__developer">--><?php //echo $product->get_attribute('zastrojshhik'); ?><!--</div>-->
<!--							--><?php //} ?>
<!---->
<!--							--><?php //// 1st gallery image
//							$gallery_images = $product->get_gallery_image_ids();
//
//							if ( is_array( $gallery_images ) && !empty($gallery_images) ) {
//								$image_link = str_replace('https://' . $_SERVER['SERVER_NAME'], '', wp_get_attachment_url($gallery_images[0])); ?>
<!---->
<!--								<div class="hero_block_slide__thumb_wrap">-->
<!--									<span class="hero_block_slide__thumb" style="background-image: url(--><?php //echo $image_link; ?><!--"></span>-->
<!--								</div>-->
<!--							--><?php //} ?>
<!--						</div>-->
<!--					</div>-->
<!--				--><?php //endwhile; ?>
			</div>
		</div>
	</div>

	<?php wp_reset_query(); ?>
</div>

<div class="hero_block__footer">
	<?php // copyright
	include_once "copyright.php"; ?>
</div>
