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
	register_setting( 'broker-options-admin', 'broker_address' );
	register_setting( 'broker-options-admin', 'broker_footer_address' );
	register_setting( 'broker-options-admin', 'broker_footer_title' );
	register_setting( 'broker-options-admin', 'broker_inst' );
	register_setting( 'broker-options-admin', 'broker_phone' );
	register_setting( 'broker-options-admin', 'broker_telegram' );
	register_setting( 'broker-options-admin', 'broker_whatsapp' );
}

function customOptionsContent() { ?>
	<div class="wrap">
		<h1>Настройки Top Broker</h1>

		<form method="post" action="options.php">
			<?php settings_fields('broker-options-admin'); ?>
			<?php do_settings_sections('broker-options-admin'); ?>

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
					<th scope="row"><label for="broker_phone">Адрес</label></th>
					<td>
						<input id="broker_address"
						       name="broker_address"
						       placeholder="Пресненская набережная 8 стр.1, МФК “Город Столиц”"
						       type="text"
						       value="<?php echo esc_attr(get_option('broker_address')); ?>"
						/>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="broker_inst">Instagram</label></th>
					<td>
						<input id="broker_inst"
						       name="broker_inst"
						       placeholder="topbroker.moscow"
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
						       placeholder="79778021616"
						       type="text"
						       value="<?php echo esc_attr(get_option('broker_whatsapp')); ?>"
						/>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="broker_telegram">Telagram</label></th>
					<td>
						<input id="broker_telegram"
						       name="broker_telegram"
						       placeholder="79778021616"
						       type="text"
						       value="<?php echo esc_attr(get_option('broker_telegram')); ?>"
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









add_action( 'admin_menu', 'register_media_selector_settings_page' );

function register_media_selector_settings_page() {
	add_submenu_page( 'options-general.php', 'Media Selector', 'Media Selector', 'manage_options', 'media-selector', 'media_selector_settings_page_callback' );
}

function media_selector_settings_page_callback() {
	// Save attachment ID
	if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['image_attachment_id'] ) ) :
		update_option( 'media_selector_attachment_id', absint( $_POST['image_attachment_id'] ) );
	endif;

	wp_enqueue_media(); ?>

	<form method='post'>
		<div class='image-preview-wrapper'>
			<img id='image-preview' src='<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>' height='100' alt="" />
		</div>

		<input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
		<input type='hidden' name='image_attachment_id' id='image_attachment_id' value='<?php echo get_option( 'media_selector_attachment_id' ); ?>' />
		<input type="submit" name="submit_image_selector" value="Save" class="button-primary" />
	</form>
<?php }

add_action('admin_footer', 'media_selector_print_scripts');

function media_selector_print_scripts() {
	$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 ); ?>

	<script>
		jQuery( document ).ready( function( $ ) {
			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this

			jQuery('#upload_image_button').on('click', function( event ) {
				event.preventDefault();

				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					// Open frame
					file_frame.open();
					return;
				}
				else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();

					// Do something with attachment.id and/or attachment.url here
					$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#image_attachment_id' ).val( attachment.id );

					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});

				// Finally, open the modal
				file_frame.open();
			});

			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		});
	</script>
<?php }
