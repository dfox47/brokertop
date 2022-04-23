
<?php $i = esc_url(get_template_directory_uri()) . '/i'; ?>

<?php // hide footer on front page
if ( !is_front_page() ) { ?>
	<footer class="footer">
		<div class="wrap">
			<div class="footer_wrap">
				<?php // footer_menu
				wp_nav_menu(array(
					'container'         => false,
					'depth'             => 2,
					'item_spacing'      => 'preserve',
					'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
					'menu'              => 'footer_menu',
					'menu_class'        => 'footer_menu',
				)); ?>

				<a class="powered_by" href="//flerr.ru/" target="_blank">
					<span>разработка сайта:</span>
					<img src="<?php echo $i; ?>/icons/flerr.svg" alt="flerr.ru" />
				</a>
			</div>

			<div class="footer_bottom">
				<div class="copyright">
					<?php echo(date("Y")); ?> TOP BROKER ESTATE.<br />
					Москва, Пресненская набережная 8 стр.1, 571
				</div>

				<a class="footer_agree" href="">Согласие на обработку персональных данных</a>
			</div>
		</div>
	</footer>
<?php } ?>

<?php // all scripts in one file with GULP ?>
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/all.min.js?v<?php echo(date("Ymd")); ?>"></script>

<?php wp_footer(); ?>

</body>
</html>
