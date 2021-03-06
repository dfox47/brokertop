
<?php $i = esc_url(get_template_directory_uri()) . '/i'; ?>

<?php if (is_active_sidebar('footer')) : ?>
	<?php dynamic_sidebar('footer'); ?>
<?php endif; ?>

<footer class="footer<?php if (is_front_page()) { ?> footer--home<?php } ?>">
	<div class="wrap">
		<div class="footer_wrap2">
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
				<div class="footer_phone">
					<?php include "template-parts/phone.php"; ?>
				</div>

				<?php // copyright
				include "template-parts/copyright.php"; ?>

				<div class="footer_social">
					<?php // social
					include "template-parts/social.php"; ?>
				</div>

				<a class="footer_agree" href="">Согласие на обработку персональных данных</a>
			</div>
		</div>
	</div>
</footer>

<?php // all scripts in one file with GULP ?>
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/all.min.js?v<?php echo(date("Ymd")); ?>"></script>

<?php wp_footer(); ?>

</body>
</html>
