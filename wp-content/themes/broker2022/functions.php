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
function removePageFromQueryString($query_string) {
	if ($query_string['name'] == 'page' && isset($query_string['page'])) {
		unset($query_string['name']);
		$query_string['paged'] = $query_string['page'];
	}

	return $query_string;
}
add_filter('request', 'removePageFromQueryString');

add_filter('woof_clear_all_text', function($default_text) {
	return 'Сбросить фильтр';
}, 99, 1);



// product attributes to category page
function categoryPageProductAttributes() {
	global $product;

	$product_attribute_taxonomies = array(
		'pa_tip-nedvizhimosti',
		'pa_adres'
	);

	$attr_output = array();

	foreach ($product_attribute_taxonomies as $taxonomy) {
		if (taxonomy_exists($taxonomy)) {
			$term_names = $product -> get_attribute($taxonomy);

			if (!empty($term_names)) {
				$attr_output[] = '<li class="product_attributes__item product_attribute__' . $taxonomy . '">' . $term_names . '</span>';
			}
		}
	}

	echo '<ul class="product_attributes">' . implode('', $attr_output) . '</ul>';
}
add_action('woocommerce_after_shop_loop_item_title', 'categoryPageProductAttributes');



function templateLoopProductTitle() {
	echo '<h2 class="product_cat__title">' . get_the_title() . '</h2>';
}

function switchLoopTitle() {
	remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
	add_action('woocommerce_after_shop_loop_item_title', 'templateLoopProductTitle', 0);
}
add_action('woocommerce_before_shop_loop_item', 'switchLoopTitle');



// remove default product link at category page
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

function replaceProductLinkAtCategory() {
	global $product;
	$affiliate_link = get_post_meta(get_the_ID(), '_product_url', true);

	if ($affiliate_link) {
		echo '<a href="' . esc_url($affiliate_link) . '" class="product_link" target="_blank">';
	}
	else {
		echo '<a href="' . get_the_permalink() . '" class="product_link" style="background-image: url(' . wp_get_attachment_url( $product->get_image_id() ) . ')"><span class="product_link__content">';
	}
}

add_action('woocommerce_before_shop_loop_item', 'replaceProductLinkAtCategory', 10);
