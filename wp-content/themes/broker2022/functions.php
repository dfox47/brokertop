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
		echo '<a href="' . esc_url($affiliate_link) . '" class="product_link js-product-link" target="_blank">';
	}
	else {
		echo '<a href="' . get_the_permalink() . '" class="product_link js-product-link"><span class="product_link__img" style="background-image: url(' . wp_get_attachment_url( $product->get_image_id() ) . ')"></span><span class="product_link__content">';
	}
}

add_action('woocommerce_before_shop_loop_item', 'replaceProductLinkAtCategory', 10);


remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

function get_current_url() {
	global $wp;
	$old = 'http://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'], '?');

	$current_url = add_query_arg( '', '', home_url( $wp->request ) );
	return $current_url;
}

function woocommerce_catalog_ordering() {
	global $wp_query;

	if ( 1 == $wp_query->found_posts || ! woocommerce_products_will_display() ) {
		return;
	}

	$orderby                 = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
	$show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
	$catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
		'date'       => __( 'По дате обновления', 'woocommerce' ),
		'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
		'price-desc' => __( 'Sort by price: high to low', 'woocommerce' )
	) );

	if ( ! $show_default_orderby ) {
		unset( $catalog_orderby_options['menu_order'] );
	}

	if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
		unset( $catalog_orderby_options['rating'] );
	}

	if( get_option('woocommerce_enable_review_rating') == 'no' && get_option('woocommerce_default_catalog_orderby') == 'rating') {
		update_option('woocommerce_default_catalog_orderby', 'date');
	}

	wc_get_template( 'loop/orderby.php', array( 'catalog_orderby_options' => $catalog_orderby_options, 'orderby' => $orderby, 'show_default_orderby' => $show_default_orderby ) );
}
add_filter( 'acf/location/rule_types', function( $choices ){
$choices[ __("Other",'acf') ]['wc_prod_attr'] = 'WC Product Attribute';
return $choices;
} );
 
add_filter( 'acf/location/rule_values/wc_prod_attr', function( $choices ){
	foreach ( wc_get_attribute_taxonomies() as $attr ) {
	$pa_name = wc_attribute_taxonomy_name( $attr->attribute_name );
	$choices[ $pa_name ] = $attr->attribute_label;
	}
return $choices;
} );

add_filter( 'acf/location/rule_match/wc_prod_attr', function( $match, $rule, $options ){
	if ( isset( $options['taxonomy'] ) ) {
	if ( '==' === $rule['operator'] ) {
	$match = $rule['value'] === $options['taxonomy'];
	} elseif ( '!=' === $rule['operator'] ) {
	$match = $rule['value'] !== $options['taxonomy'];
	}
	}
	return $match;
}, 10, 3 );

function art_added_tabs( array $tabs ): array {

	$tabs['special_panel'] = [
		'label'    => 'Брокер', 
		'target'   => 'special_panel_product_data', 
		'class'    => [ 'hide_if_grouped' ], 
		'priority' => 5, 
	];

	return $tabs;
}

add_filter( 'woocommerce_product_data_tabs', 'art_added_tabs', 10, 1 );

function art_added_tabs_icon() {

	?>
	<style>
		#woocommerce-coupon-data ul.wc-tabs li.special_panel_options a::before,
		#woocommerce-product-data ul.wc-tabs li.special_panel_options a::before,
		.woocommerce ul.wc-tabs li.special_panel_options a::before  {
			font-family: Dashicons;
			content: "\f338";
		}
	</style>
	<?php

}

add_action( 'admin_footer', 'art_added_tabs_icon' );

function art_added_tabs_panel() {


}

add_action( 'woocommerce_product_data_panels', 'art_added_tabs_panel' );

// change menu items name at admin
function edit_admin_menus() {
	global $menu, $submenu;

	$menu[25][0] = 'Отзывы';
	$menu[26][0] = 'Объекты';

	// woocommerce
//	$menu['55.5'][0] = 'Store';

	// All products
	$submenu['edit.php?post_type=product'][5][0] = 'Все объекты';

	// attributes
	$submenu['edit.php?post_type=product'][17][0] = 'Параметры объекта';
}
add_action('admin_menu', 'edit_admin_menus');



// remove slash from links [START]
if ( !is_admin() && ( ! defined('DOING_AJAX') || ( defined('DOING_AJAX') && ! DOING_AJAX ) ) ) {
	ob_start( 'html5_slash_fixer' );
	add_action( 'shutdown', 'html5_slash_fixer_flush' );
}
function html5_slash_fixer( $buffer ) {
	return str_replace( ' />', '>', $buffer );
}
function html5_slash_fixer_flush() {
	ob_end_flush();
}
// remove slash from links [END]

// remove script & style tags from links
add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'html5', [ 'script', 'style' ] );
	}
);