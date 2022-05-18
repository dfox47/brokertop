<?php

// allow menus
add_theme_support('menus');

// title at head
add_theme_support( 'title-tag' );

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

// theme's custom options
include "template-parts/theme_options.php";

// widgets
include "template-parts/widgets.php";

// support woocommerce custom themes
function woocommerceThemeSupport() {
	add_theme_support( 'woocommerce' );
}
add_action('after_setup_theme', 'woocommerceThemeSupport');

// pagination error fix
function remove_page_from_query_string($query_string) {
	if ($query_string['name'] == 'page' && isset($query_string['page'])) {
		unset($query_string['name']);
		$query_string['paged'] = $query_string['page'];
	}

	return $query_string;
}
add_filter('request', 'remove_page_from_query_string');

add_filter('woof_clear_all_text', function($default_text) {
	return 'Сбросить фильтр';
}, 99, 1);



// product attributes to category page
function categoryPageProductAttributes() {
	global $product;

	$product_attribute_taxonomies = array(
		'pa_adres',
		'pa_tip-nedvizhimosti'
	);

	$attr_output = array();

	foreach ($product_attribute_taxonomies as $taxonomy) {
		if (taxonomy_exists($taxonomy)) {
			$term_names = $product->get_attribute($taxonomy);

			if (!empty($term_names)) {
				$attr_output[] = '<span class="'.$taxonomy.'">'.$term_names.'</span>';
			}
		}
	}

	echo '<div class="product_attr">'.implode('', $attr_output).'</div>';
}
add_action('woocommerce_after_shop_loop_item_title', 'categoryPageProductAttributes');
