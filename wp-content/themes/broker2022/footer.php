
<?php // footer_menu
wp_nav_menu(array(
	'container'         => false,
	'depth'             => 0,
	'item_spacing'      => 'preserve',
	'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
	'menu'              => 'footer_menu',
	'menu_class'        => 'footer_menu',
)); ?>

<?php // footer_submenu
wp_nav_menu(array(
	'container'         => false,
	'depth'             => 0,
	'item_spacing'      => 'preserve',
	'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
	'menu'              => 'footer_submenu',
	'menu_class'        => 'footer_submenu',
)); ?>

<?php // all scripts in one file with GULP ?>
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/all.min.js?v<?php echo(date("YmdHis")); ?>"></script>

<?php wp_footer(); ?>

</body>
</html>
