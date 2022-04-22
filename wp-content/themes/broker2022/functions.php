<?php

// allow menus
add_theme_support( 'menus' );

// remove class from li at menus
//add_filter('nav_menu_css_class', '__return_empty_array', 10, 3);

// remove ID's from li at menus
add_filter('nav_menu_item_id', '__return_null', 10, 3);

// header menu
function headerMenu() {
	register_nav_menu( 'header', 'Header menu' );
}
add_action('after_setup_theme', 'headerMenu');

// footer menu
function footerMenu() {
	register_nav_menu( 'footer', 'Footer menu' );
}
add_action('after_setup_theme', 'footerMenu');

// footer submenu
function footerSubmenu() {
	register_nav_menu( 'footer_submenu', 'Footer submenu' );
}
add_action('after_setup_theme', 'footerSubmenu');

function special_nav_class ($classes, $item) {
	if (in_array('current-menu-item', $classes) ){
		$classes[] = 'active ';
	}
	return $classes;
}
//add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
