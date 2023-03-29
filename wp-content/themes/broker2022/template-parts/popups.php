<?php // Подать заявку ?>
	<div class="popup popup--feedback js-popup" data-popup="feedback2">
		<div class="popup__bg js-popup-close"></div>

		<div class="popup__content">
			<div class="popup__close js-popup-close"></div>

			<div class="contacts_form">
				<?php echo do_shortcode('[contact-form-7 id="1966"]'); ?>
			</div>
		</div>
	</div>

<?php // Реализовать объект ?>
	<div class="popup popup--feedback js-popup" data-popup="feedback3">
		<div class="popup__bg js-popup-close"></div>

		<div class="popup__content">
			<div class="popup__close js-popup-close"></div>

			<div class="contacts_form">
				<?php echo do_shortcode('[contact-form-7 id="1967"]'); ?>
			</div>
		</div>
	</div>

<?php // Добро пожаловать ?>
	<div class="popup popup--welcome js-popup" data-popup="feedback-6847">
		<div class="popup__bg js-popup-close"></div>

		<div class="popup__content">
			<div class="popup__close js-popup-close"></div>

			<div class="contacts_form">
				<form name="feedback-form" method="POST" action="/send_amo.php">
					<?php echo do_shortcode('[contact-form-7 id="6847"]'); ?>
				</form>
			</div>
		</div>
	</div>

<?php // Внимание! Закрытые лоты и переуступки с лучшей ценой! ?>
	<div class="popup popup--welcome js-popup" data-popup="feedback-6953">
		<div class="popup__bg js-popup-close"></div>

		<div class="popup__content">
			<div class="popup__close js-popup-close"></div>

			<div class="contacts_form">
				<?php echo do_shortcode('[contact-form-7 id="6953"]'); ?>
			</div>
		</div>
	</div>

<?php // Внимание! Успейте забронировать до старта продаж! ?>
	<div class="popup popup--welcome js-popup" data-popup="feedback-6954">
		<div class="popup__bg js-popup-close"></div>

		<div class="popup__content">
			<div class="popup__close js-popup-close"></div>

			<div class="contacts_form">
				<?php echo do_shortcode('[contact-form-7 id="6954"]'); ?>
			</div>
		</div>
	</div>


<?php //if ()
if ($_SERVER['REQUEST_URI'] == "/dubaj/") { ?>
	<div class="welcome js-welcome">
		<div class="welcome__bg"></div>

		<div class="welcome__content">
			<span class="logo"></span>

			<div class="welcome_slogan">
				Мы делаем наших клиентов <span class="nobr">еще счастливее</span> <span class="nobr">и успешнее</span> <span class="nobr">с каждой</span> сделкой
			</div>

			<div class="welcome_slogan_en">
				We make <span class="nobr">our customers</span> happier <span class="nobr">and more</span> successful <span class="nobr">with every</span> deal
			</div>

			<div class="welcome_copyright">
				<?php include "copyright.php" ?>
			</div>
		</div>
	</div>
<?php }
// ?>