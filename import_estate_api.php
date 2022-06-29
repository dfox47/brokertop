<?php
set_time_limit(0);
ini_set('max_execution_time', 0);

require_once(__DIR__."/wp-load.php");

//получение товаров
$ch = curl_init('https://app.syncrm.ru/api/v1/estate-properties');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer d489b37439c22340ec198d46275c36d34c13270e6231fa2a75364e07ea747977'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$estate_object_json = curl_exec($ch);
curl_close($ch);

$estate_object = json_decode($estate_object_json, true);

$products = products();

$products_ids = array();
foreach($products as $product)
{
	$products_ids[] = $product->id;
}

//создание товаров
foreach($estate_object['data'] as $object)
{
	//данные
	$product = get_page_by_title(trim($object['attributes']['name']), OBJECT, 'product');
	
	if(isset($product->ID) AND $product->ID > 0)
	{
		//редактирование товара
		update_product($product->ID, $object['attributes']['purchase-price']);
		
		$products_ids = array_diff($products_ids, array($product->ID));
	}
	else
	{
		//главная картинка
		$ch = curl_init($object['relationships']['cover']['links']['related']);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer d489b37439c22340ec198d46275c36d34c13270e6231fa2a75364e07ea747977'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$main_image_data = curl_exec($ch);
		curl_close($ch);
		
		$main_image_data = json_decode($main_image_data, true);
		$main_image_tmp = explode('?',$main_image_data['data']['attributes']['download-link']);
		$main_image_ext_arr = explode('.', $main_image_tmp[0]);
		$main_image_ext = $main_image_ext_arr[count($main_image_ext_arr)-1];
		$main_image_name = 'api_'.$object['id'].'.'.$main_image_ext;
		$main_image_id = upload_image($main_image_tmp[0], $main_image_name);
		
		//галерея
		$ch = curl_init($object['relationships']['images']['links']['related']);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer d489b37439c22340ec198d46275c36d34c13270e6231fa2a75364e07ea747977'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$gallery_images_data = curl_exec($ch);
		curl_close($ch);
		
		$gallery_images_data = json_decode($gallery_images_data, true);
		$gallery_images = array();
		foreach($gallery_images_data['data'] as $key=>$gallery_image_data)
		{
			if($key != 0 AND $key <= 5)
			{
				$gallery_image_tmp = explode('?',$gallery_image_data['attributes']['download-link']);
				$gallery_image_ext_arr = explode('.', $gallery_image_tmp[0]);
				$gallery_image_ext = $gallery_image_ext_arr[count($gallery_image_ext_arr)-1];
				$gallery_image_name = 'api_'.$object['id'].'_'.$key.'.'.$gallery_image_ext;
				$gallery_image_id = upload_image($gallery_image_tmp[0], $gallery_image_name);
				$gallery_images[] = $gallery_image_id;
			}
		}
		
		$params = array();
		$params['pa_adres'] = trim($object['attributes']['address']);
		$params['pa_etazh'] = trim($object['attributes']['floor-number']);
		$params['pa_klass'] = trim($object['attributes']['flat-type']);
		$params['pa_kolichestvo-komnat'] = trim($object['attributes']['total-room']);
		$params['pa_material-doma'] = trim($object['attributes']['material']);
		$params['pa_nomer-obekta'] = trim($object['attributes']['cadastral-num']);
		$params['pa_obshhaya-ploshhad'] = trim($object['attributes']['total-area']);
		$params['pa_rajony'] = trim($object['attributes']['district']);
		$params['pa_remont'] = trim($object['attributes']['condition']);
		$params['pa_telefon-rieltora'] = trim($object['attributes']['contact-phone']);
		$params['pa_tip-nedvizhimosti'] = trim($object['attributes']['object-category']);
		$params['pa_vsego-etazhej'] = trim($object['attributes']['total-floors']);

		preg_match_all('/[А-Я][^А-Я]*?/Usu',str_replace(',', '', trim($object['attributes']['subway-name'])),$metro_res);
		$params['pa_stancziya-metro'] = $metro_res[0];
		
		$params['pa_google-api-x'] = trim($object['attributes']['latitude']);
		$params['pa_google-api-y'] = trim($object['attributes']['longitude']);

		//добавление товара
		$created_product = create_product($object['attributes']['name'], $object['attributes']['purchase-price'], $object['attributes']['description'], $object['attributes']['deal-category'], $params, $main_image_id, $gallery_images);
		
		$products_ids = array_diff($products_ids, array($created_product));
	}

	//break;
}

//удаление товаров
foreach($products_ids as $product)
{
	delete_product($product, TRUE);
}















function upload_image($image_url, $image_name)
{
	$upload_dir = wp_upload_dir();

	$image_data = @file_get_contents( $image_url );

	$filename = $image_name;

	if ( wp_mkdir_p( $upload_dir['path'] ) ) {
	  $file = $upload_dir['path'] . '/' . $filename;
	}
	else {
	  $file = $upload_dir['basedir'] . '/' . $filename;
	}

	file_put_contents( $file, $image_data );

	$wp_filetype = wp_check_filetype( $filename, null );

	$attachment = array(
	  'post_mime_type' => $wp_filetype['type'],
	  'post_title' => sanitize_file_name( $filename ),
	  'post_content' => '',
	  'post_status' => 'inherit'
	);

	$attach_id = wp_insert_attachment( $attachment, $file );
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
	wp_update_attachment_metadata( $attach_id, $attach_data );
	
	return $attach_id;
}

function get_product_by_name($post_name, $output = OBJECT) {
    global $wpdb;
        $post = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type='product'", $post_name ));
        if ( $post )
            return get_post($post, $output);

    return null;
}

function create_product($name, $price, $description, $category, $params, $main_image_id, $gallery_images) {
	$product = new WC_Product_Simple();
	$product->set_status('publish'); 
	$product->set_catalog_visibility('visible');
	
	//название
	$product->set_name($name);
	
	//описание
	$product->set_description($description);
	
	//цена
	$product->set_regular_price($price);
	
	//категория
	if($category == 'sell')
	{
		$product->set_category_ids([19]);
	}
	
	if($category == 'rent')
	{
		$product->set_category_ids([20]);
	}

	//изображение
	$product->set_image_id($main_image_id);
	
	//галерея
	$product->set_gallery_image_ids($gallery_images);
	
	$product_id = $product->save();

	//параметры
	foreach ( $params as $attribute_key => $option ) {
		if((is_array($option) OR trim($option) != '') AND trim($attribute_key) != '')
		{
			if(is_array($option))
			{
				foreach($option as $single_value)
				{
					$taxonomy = trim($attribute_key);
					$term_name = trim($single_value);
					$term_slug = sanitize_title($term_name);

					if( ! term_exists( $term_name, $taxonomy ) ){
						$term_data = wp_insert_term( $term_name, $taxonomy );
						$term_id   = $term_data['term_id'];
					} else {
						$term_id   = get_term_by( 'name', $term_name, $taxonomy )->term_id;
					}

					$product = wc_get_product( $product_id );

					$attributes = (array) $product->get_attributes();

					if( array_key_exists( $taxonomy, $attributes ) ) {
						foreach( $attributes as $key => $attribute ){
							if( $key == $taxonomy ){
								$options = (array) $attribute->get_options();
								$options[] = $term_id;
								$attribute->set_options($options);
								$attributes[$key] = $attribute;
								break;
							}
						}
						$product->set_attributes( $attributes );
					}
					else {
						$attribute = new WC_Product_Attribute();

						$attribute->set_id( sizeof( $attributes) + 1 );
						$attribute->set_name( $taxonomy );
						$attribute->set_options( array( $term_id ) );
						$attribute->set_position( sizeof( $attributes) + 1 );
						$attribute->set_visible( true );
						$attribute->set_variation( false );
						$attributes[] = $attribute;

						$product->set_attributes( $attributes );
					}

					$product->save();

					if( ! has_term( $term_name, $taxonomy, $product_id ))
						wp_set_object_terms($product_id, $term_slug, $taxonomy, true );
				}
			}
			else
			{
				$taxonomy = trim($attribute_key);
				$term_name = trim($option);
				$term_slug = sanitize_title($term_name);

				if( ! term_exists( $term_name, $taxonomy ) ){
					$term_data = wp_insert_term( $term_name, $taxonomy );
					$term_id   = $term_data['term_id'];
				} else {
					$term_id   = get_term_by( 'name', $term_name, $taxonomy )->term_id;
				}

				$product = wc_get_product( $product_id );

				$attributes = (array) $product->get_attributes();

				if( array_key_exists( $taxonomy, $attributes ) ) {
					foreach( $attributes as $key => $attribute ){
						if( $key == $taxonomy ){
							$options = (array) $attribute->get_options();
							$options[] = $term_id;
							$attribute->set_options($options);
							$attributes[$key] = $attribute;
							break;
						}
					}
					$product->set_attributes( $attributes );
				}
				else {
					$attribute = new WC_Product_Attribute();

					$attribute->set_id( sizeof( $attributes) + 1 );
					$attribute->set_name( $taxonomy );
					$attribute->set_options( array( $term_id ) );
					$attribute->set_position( sizeof( $attributes) + 1 );
					$attribute->set_visible( true );
					$attribute->set_variation( false );
					$attributes[] = $attribute;

					$product->set_attributes( $attributes );
				}

				$product->save();

				if( ! has_term( $term_name, $taxonomy, $product_id ))
					wp_set_object_terms($product_id, $term_slug, $taxonomy, true );
			}
		}
	}
	
	return $product_id;
}

function update_product($id, $price) {
	$product = wc_get_product($id);
	$product->set_regular_price($price);
	$product->save();
}

function products() {
	return array_map('wc_get_product', get_posts(['post_type'=>'product','nopaging'=>true]));
}

function delete_product($id, $force = FALSE)
{
    $product = wc_get_product($id);

    if(empty($product))
        return new WP_Error(999, sprintf(__('No %s is associated with #%d', 'woocommerce'), 'product', $id));

    // If we're forcing, then delete permanently.
    if ($force)
    {
        if ($product->is_type('variable'))
        {
            foreach ($product->get_children() as $child_id)
            {
                $child = wc_get_product($child_id);
                $child->delete(true);
            }
        }
        elseif ($product->is_type('grouped'))
        {
            foreach ($product->get_children() as $child_id)
            {
                $child = wc_get_product($child_id);
                $child->set_parent_id(0);
                $child->save();
            }
        }

        $product->delete(true);
        $result = $product->get_id() > 0 ? false : true;
    }
    else
    {
        $product->delete();
        $result = 'trash' === $product->get_status();
    }

    if (!$result)
    {
        return new WP_Error(999, sprintf(__('This %s cannot be deleted', 'woocommerce'), 'product'));
    }

    // Delete parent product transients.
    if ($parent_id = wp_get_post_parent_id($id))
    {
        wc_delete_product_transients($parent_id);
    }
    return true;
}
?>