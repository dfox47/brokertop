<!-- Подать заявку -->
<div class="popup popup--feedback js-popup" data-popup="feedback2">
	<div class="popup__bg js-popup-close"></div>

	<div class="popup__content">
		<div class="popup__close js-popup-close"></div>

		<div class="contacts_form">
			<?php echo do_shortcode('[contact-form-7 id="1966"]'); ?>
		</div>
	</div>
</div>

<!-- Реализовать объект -->
<div class="popup popup--feedback js-popup" data-popup="feedback3">
	<div class="popup__bg js-popup-close"></div>

	<div class="popup__content">
		<div class="popup__close js-popup-close"></div>

		<div class="contacts_form">
			<?php echo do_shortcode('[contact-form-7 id="1967"]'); ?>
		</div>
	</div>
</div>

<!-- Добро пожаловать -->
<div class="popup popup--welcome js-popup" data-popup="feedback-6847">
	<div class="popup__bg js-popup-close"></div>

	<div class="popup__content">
		<div class="popup__close js-popup-close"></div>

		<div class="contacts_form">
			<form name="feedback-form" method="POST" action="/send_amo.php">
				<?php echo do_shortcode('[contact-form-7 id="6847"]'); ?>
			</form>
		</div>

		<div class="contacts_form__error js-popup-error">Ошибка. Заполните все поля</div>
	</div>
	<div id="success-message"></div>
</div>

<!-- Внимание! Закрытые лоты и переуступки с лучшей ценой! -->
<div class="popup popup--welcome js-popup" data-popup="feedback-6953">
	<div class="popup__bg js-popup-close"></div>

	<div class="popup__content">
		<div class="popup__close js-popup-close"></div>

		<div class="contacts_form">
			<?php echo do_shortcode('[contact-form-7 id="6953"]'); ?>
		</div>
	</div>
</div>

<!-- Внимание! Успейте забронировать до старта продаж! -->
<div class="popup popup--welcome js-popup" data-popup="feedback-6954">
	<div class="popup__bg js-popup-close"></div>

	<div class="popup__content">
		<div class="popup__close js-popup-close"></div>

		<div class="contacts_form">
			<?php echo do_shortcode('[contact-form-7 id="6954"]'); ?>
		</div>
	</div>
</div>

<?php // welcome popup
if (is_front_page() && 1 > 2) {
	$welcome = "/wp-content/themes/broker2022/i/welcome"; ?>

	<div class="welcome_preload js-welcome-preload">
		<span></span>
		<span></span>
		<span></span>
	</div>

	<div class="welcome js-welcome">
		<div class="welcome__bg"></div>

		<div class="welcome_animation welcome_animation__1">
			<img src="<?= $welcome; ?>/1.png" alt="">
		</div>

		<div class="welcome_animation welcome_animation__2">
			<img src="<?= $welcome; ?>/2.png" alt="">
		</div>

		<div class="welcome_animation welcome_animation__3">
			<img src="<?= $welcome; ?>/3.png" alt="">
		</div>

		<div class="welcome_animation welcome_animation__4">
			<img src="<?= $welcome; ?>/4.png" alt="">
		</div>

		<div class="welcome__content">
			<span class="logo"></span>

			<div class="welcome_slogan">
				<div class="welcome_slogan__row">Мы делаем наших клиентов</div>
				<div class="welcome_slogan__row">еще счастливее и успешнее</div>
				<div class="welcome_slogan__row">с каждой сделкой</div>
			</div>

			<div class="welcome_slogan_en">
				<div class="welcome_slogan_en__row">We make our customers</div>
				<div class="welcome_slogan_en__row">happier and more successful</div>
				<div class="welcome_slogan_en__row">with every deal</div>
			</div>

			<div class="welcome_copyright">
				<?php include "copyright.php" ?>
			</div>
		</div>
	</div>
<?php } ?>