
<?php
$i          = esc_url(get_template_directory_uri()) . '/i';
$currentUrl = $_SERVER['REQUEST_URI'];
$whatsapp   = esc_attr(get_option('broker_whatsapp'));
?>

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

				<iframe src="https://yandex.ru/sprav/widget/rating-badge/4782454911" width="150" height="50" frameborder="0"></iframe>
			</div>
		</div>
	</div>
</footer>

<?php if ($whatsapp) { ?>
	<a class="whatsapp_link" href="//wa.me/<?php echo $whatsapp; ?>" target="_blank"><img class="whatsapp_link__img" src="<?php echo $i . '/icons/whatsapp_green.svg'; ?>" alt="whatsapp" /></a>
<?php } ?>

<?php // feedback 2 popup ?>
<div class="popup popup--feedback js-popup" data-popup="feedback2">
	<div class="popup__bg js-popup-close"></div>

	<div class="popup__content">
		<div class="popup__close js-popup-close"></div>

		<div class="contacts_form">
			<?php echo do_shortcode('[contact-form-7 id="1966"]'); ?>
		</div>
	</div>
</div>

<?php // feedback 3 popup ?>
<div class="popup popup--feedback js-popup" data-popup="feedback3">
	<div class="popup__bg js-popup-close"></div>

	<div class="popup__content">
		<div class="popup__close js-popup-close"></div>

		<div class="contacts_form">
			<?php echo do_shortcode('[contact-form-7 id="1967"]'); ?>
		</div>
	</div>
</div>

<?php // all scripts in one file with GULP ?>
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/all.min.js?v<?php echo(date("Ymd")); ?>"></script>

<?php wp_footer(); ?>

<?php // mango callback | https://lk.mango-office.ru/ ?>
<script>
	(function(w, d, u, i, o, s, p) {
		if (d.getElementById(i)) { return; } w['MangoObject'] = o;
		w[o] = w[o] || function() { (w[o].q = w[o].q || []).push(arguments) }; w[o].u = u; w[o].t = 1 * new Date();
		s = d.createElement('script'); s.async = 1; s.id = i; s.src = u; s.charset = 'utf-8';
		p = d.getElementsByTagName('script')[0]; p.parentNode.insertBefore(s, p);
	}(window, document, '//widgets.mango-office.ru/widgets/mango.js', 'mango-js', 'mgo'));
	mgo({multichannel: {id: 12601}});
</script>

</body>
</html>
