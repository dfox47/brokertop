<?php
// more info https://codex.wordpress.org/Creating_Options_Pages
// theme's custom options
add_action('admin_menu', 'customOptions');

function customOptions() {
	add_menu_page(
		'Настройки TOP Broker Estate',
		'TOP Broker',
		'manage_options',
		'theme-custom-options',
		'customOptionsContent',
		'dashicons-admin-generic',
		100
	);

	add_action('admin_init', 'customOptionsSettings');
}

function customOptionsSettings() {
	register_setting( 'broker-options-admin', 'broker_footer_address' );
	register_setting( 'broker-options-admin', 'broker_footer_title' );
	register_setting( 'broker-options-admin', 'broker_inst' );
	register_setting( 'broker-options-admin', 'broker_phone' );
	register_setting( 'broker-options-admin', 'broker_whatsapp' );
}

function customOptionsContent() { ?>
	<div class="wrap">
		<h1>Настройки Top Broker</h1>

		<form method="post" action="options.php">
			<?php settings_fields( 'broker-options-admin' ); ?>
			<?php do_settings_sections( 'broker-options-admin' ); ?>

			<table class="form-table">
				<tr>
					<th scope="row"><label for="broker_phone">Телефон</label></th>
					<td>
						<input id="broker_phone"
						       name="broker_phone"
						       placeholder="+7 (495) 150 -39 -77"
						       type="text"
						       value="<?php echo esc_attr(get_option('broker_phone')); ?>"
						/>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="broker_inst">Instagram</label></th>
					<td>
						<input id="broker_inst"
						       name="broker_inst"
						       placeholder="lnstameow"
						       type="text"
						       value="<?php echo esc_attr(get_option('broker_inst')); ?>"
						/>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="broker_whatsapp">WhatsApp</label></th>
					<td>
						<input id="broker_whatsapp"
						       name="broker_whatsapp"
						       type="text"
						       value="<?php echo esc_attr(get_option('broker_whatsapp')); ?>"
						/>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="broker_footer_title">Footer | Заголовок</label></th>
					<td>
						<input id="broker_footer_title"
						       name="broker_footer_title"
						       placeholder="TOP BROKER ESTATE."
						       type="text"
						       value="<?php echo esc_attr(get_option('broker_footer_title')); ?>"
						/>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="broker_footer_address">Footer | Адрес</label></th>
					<td>
						<input id="broker_footer_address"
						       name="broker_footer_address"
						       placeholder="Москва, Пресненская набережная 8 стр.1, 571"
						       type="text"
						       value="<?php echo esc_attr(get_option('broker_footer_address')); ?>"
						/>
					</td>
				</tr>
			</table>

			<?php submit_button(); ?>
		</form>
	</div>
<?php }