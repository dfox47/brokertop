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
	register_setting( 'broker-options-admin', 'broker_inst' );
	register_setting( 'broker-options-admin', 'broker_phone' );
	register_setting( 'broker-options-admin', 'broker_whatsapp' );
}

function customOptionsContent() { ?>
	<div class="wrap">
		<h1>Your Plugin Name</h1>

		<form method="post" action="options.php">
			<?php settings_fields( 'broker-options-admin' ); ?>
			<?php do_settings_sections( 'broker-options-admin' ); ?>

			<table class="form-table">
				<tr>
					<th scope="row"><label for="broker_phone">Телефон</label></th>
					<td><input id="broker_phone" type="text" name="broker_phone" value="<?php echo esc_attr(get_option('broker_phone')); ?>" placeholder="+7 (495) 150 -39 -77" /></td>
				</tr>

				<tr>
					<th scope="row"><label for="broker_inst">Instagram</label></th>
					<td><input id="broker_inst" type="text" name="broker_inst" value="<?php echo esc_attr(get_option('broker_inst')); ?>" placeholder="lnstameow" /></td>
				</tr>

				<tr>
					<th scope="row"><label for="broker_whatsapp">WhatsApp</label></th>
					<td><input id="broker_whatsapp" type="text" name="broker_whatsapp" value="<?php echo esc_attr(get_option('broker_whatsapp')); ?>" /></td>
				</tr>
			</table>

			<?php submit_button(); ?>
		</form>
	</div>
<?php }
