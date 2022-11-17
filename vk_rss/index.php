<?php include '../wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

header('Content-Type: text/html; charset=utf-8');

if (!isset($_REQUEST)) {
	return;
}

$token = 'asQ13axAPQEcczQa';

$data = json_decode(file_get_contents('php://input'));

switch ($data->type) {
	case 'confirmation':
		echo "307d7368";
		exit();
		break;

	case 'wall_post_new':
		$post_text = $data->object->text;
		$post_images = [];

		foreach ($data->object->attachments as $key => $value) {

			if ($value->type == 'photo') {
				if ($value->photo->photo_2560) {
					$post_images[] = $value->photo->photo_2560;
				}
				else if ($value->photo->photo_1280) {
					$post_images[] = $value->photo->photo_1280;
				}
				else if ($value->photo->photo_1080) {
					$post_images[] = $value->photo->photo_1080;
				}
				else if ($value->photo->photo_807) {
					$post_images[] = $value->photo->photo_807;
				}
				else if ($value->photo->photo_604) {
					$post_images[] = $value->photo->photo_604;
				}
				else if ($value->photo->photo_320) {
					$post_images[] = $value->photo->photo_320;
				}
				else if ($value->photo->photo_200) {
					$post_images[] = $value->photo->photo_200;
				}
				else if ($value->photo->photo_130) {
					$post_images[] = $value->photo->photo_130;
				}
				else if ($value->photo->photo_75) {
					$post_images[] = $value->photo->photo_75;
				}
			}
		}

		$first_enter = strpos($post_text, PHP_EOL);
		$post_title = substr($post_text, 0, $first_enter);
		$post_text = substr($post_text, $first_enter);
		$post_text = trim($post_text);

		foreach ($post_images as $key => $url) {
			if ($key != 0) {
				$tmp    = download_url( $url );
				$name   = basename( $url );
				$name   = substr($name, 0, strrpos($name,'?'));

				$file_array = [
					'name'     => basename ($name),
					'tmp_name' => $tmp,
					'error'    => 0,
					'size'     => filesize($tmp),
				];

				$id = media_handle_sideload( $file_array, 0);

				if( is_wp_error( $id ) ) {
					@unlink($file_array['tmp_name']);
					return $id->get_error_messages();
				}

				$post_text = $post_text . PHP_EOL . '<img class="alignnone size-medium wp-image-12563" src="' . wp_get_attachment_url($id) . '" alt="" style="max-width: 100%;" />';

				@unlink( $tmp );
			}
		}

		$source = array (
			'post_title'        => $post_title,
			'post_content'      => $post_text,
			'post_status'       => 'publish',
			'post_author'       => 1,
			'post_category'     => array(124),
			'post_type'         => 'post'
		);

		$post_id    = wp_insert_post($source);
		$url        = $post_images [0];
		$tmp        = download_url($url);
		$name       = basename($url);
		$name       = substr($name, 0, strrpos($name,'?'));

		$file_array = [
			'name'      => basename ($name),
			'tmp_name'  => $tmp,
			'error'     => 0,
			'size'      => filesize($tmp),
		];

		$id = media_handle_sideload( $file_array, 0);

		if( is_wp_error( $id ) ) {
			@unlink($file_array['tmp_name']);
			return $id->get_error_messages();
		}

		set_post_thumbnail($post_id, $id);

		@unlink( $tmp );

		break;
}

echo 'ok';