<?php // widgets
function registerMyWidgets() {
	register_sidebar(array(
		'after_title'       => '</h4>',
		'after_widget'      => '',
		'before_title'      => '<h4>',
		'before_widget'     => '',
		'id'                => 'after_header',
		'name'              => 'After header'
	));
}

add_action('widgets_init', 'registerMyWidgets');
