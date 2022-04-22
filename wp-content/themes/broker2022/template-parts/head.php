
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

	<div class="header_contacts"></div>
</header>
