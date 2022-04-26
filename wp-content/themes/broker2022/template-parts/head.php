
<?php // thumb img url
$thumbUrl = '';

if ( get_the_post_thumbnail_url() ) {
	$thumbUrl = str_replace('https://brokertop.ru', '', get_the_post_thumbnail_url());
} ?>

<div class="hero_block_wrap">
	<div class="hero_block" <?php if ($thumbUrl !== '') { ?>style="background-image: url(<?php echo $thumbUrl; ?>);"<?php } ?>>
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

		<?php if (is_front_page()) { ?>
			<?php include "hero.php"; ?>
		<?php } ?>
	</div>
</div>

<div class="wrap">
	<?php if (is_active_sidebar('after_header' )) : ?>
		<?php dynamic_sidebar('after_header' ); ?>
	<?php endif; ?>
</div>
