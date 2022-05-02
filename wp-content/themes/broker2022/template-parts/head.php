
<?php // thumb img url
$thumbUrl = '';

if (get_the_post_thumbnail_url()) {
	$thumbUrl = str_replace('https://' . $_SERVER['SERVER_NAME'], '', get_the_post_thumbnail_url());
}

// page type
$pageType = '';

if (is_front_page()) {
	$pageType = ' hero_block_wrap--home';
}
else if (is_product()) {
	$pageType = ' hero_block_wrap--product';
}
else if (is_category()) {
	$pageType = ' hero_block_wrap--category';
} ?>

<div class="hero_block_wrap<?php echo $pageType; ?>">
	<div class="hero_block" <?php if ($thumbUrl !== '' && is_product()) { ?>style="background-image: url(<?php echo $thumbUrl; ?>);"<?php } ?>>
		<div class="header_wrap">
			<header class="header">
				<div class="header_left">
					<a class="logo" href="/"></a>

					<div class="header_menu_toggle js-header-menu-toggle">
						<span></span> Меню
					</div>
				</div>

				<div class="header_menu_wrap">
					<div class="btn btn_close js-header-menu-toggle"></div>

					<?php // header_menu
					wp_nav_menu(array(
						'container'         => false,
						'depth'             => 0,
						'item_spacing'      => 'preserve',
						'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
						'menu'              => 'header_menu',
						'menu_class'        => 'header_menu',
					)); ?>
				</div>

				<div class="header_right">
					<?php include "phone.php"; ?>
					<?php include "social.php"; ?>
				</div>
			</header>
		</div>

		<div class="hero_block__content">
			<?php // product page
			if (is_product()) { ?>
				<div class="wrap2">
					<?php // title
					if (get_the_title()) { ?>
						<h1><?php echo get_the_title(); ?></h1>
					<?php } ?>

					<?php // Адрес объекта
					global $product;

					if ($product -> get_attribute('pa_adres')) { ?>
						<div class="product_address">
							<span><?php echo $product -> get_attribute('pa_adres'); ?></span>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>

		<?php if (is_front_page()) { ?>
			<?php include "hero.php"; ?>
		<?php } ?>
	</div>
</div>
