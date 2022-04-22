
<div class="hero_block">
	<div class="header_wrap">
		<header class="header">
			<a class="logo" href="/"></a>

			<?php // header_menu
			wp_nav_menu(array(
				'container'         => false,
				'depth'             => 0,
				'item_spacing'      => 'preserve',
				'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
				'menu'              => 'header_menu',
				'menu_class'        => 'header_menu',
			)); ?>

			<a class="header_phone" href="tel:+74951503977">+7 (495) 150 -39 -77</a>

			<ul class="header_social">
				<li class="header_social__item">
					<a class="header_social__icon header_social__icon--whatsapp" href="" target="_blank"></a>
				</li>

				<li class="header_social__item">
					<a class="header_social__icon header_social__icon--telegram" href="" target="_blank"></a>
				</li>

				<li class="header_social__item">
					<a class="header_social__icon header_social__icon--instagram" href="" target="_blank"></a>
				</li>
			</ul>
		</header>
	</div>
</div>
