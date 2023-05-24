<?php
$currentUrl = $_SERVER['REQUEST_URI'];
$dumm       = '/wp-content/themes/broker2022/i/dumm.png';
$i          = esc_url(get_template_directory_uri()) . '/i';
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
					<img src="<?= $i; ?>/icons/flerr.svg" alt="flerr.ru" />
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

				<div class="yandex_badge_wrap js-yandex-badge"></div>
			</div>
		</div>
	</div>
</footer>

<?php if ($whatsapp) { ?>
	<a class="whatsapp_link" href="//wa.me/<?= $whatsapp; ?>" target="_blank"><span class="whatsapp_link__img js-img-scroll" data-src="<?= $i . '/icons/whatsapp_green.svg'; ?>" title="whatsapp"></span></a>
<?php } ?>

<?php // popup
include "template-parts/popups.php"; ?>

<?php // all scripts in one file with GULP ?>
<script src="<?= esc_url(get_template_directory_uri()); ?>/all.min.js?v<?= (date("Ymd")); ?>"></script>

<?php wp_footer(); ?>

</body>
</html>