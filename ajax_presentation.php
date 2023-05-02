<?php
ini_set('memory_limit', '2048M');
require_once 'wp-load.php';
require_once 'pdf/autoload.php';

use Dompdf\Dompdf;

define("DOMPDF_ENABLE_REMOTE", true);

$post_id    = intval($_GET['id']);
$post       = get_post($post_id);
$product    = wc_get_product($post_id);
$attributes = $product->get_attributes();

$productAttrNotShow = [
	'pa_adres',
	'pa_etazh',
	'pa_foto-rieltora',
	'pa_google-api-x',
	'pa_google-api-y',
	'pa_imya-rieltora',
	'pa_klass',
	'pa_kolichestvo-komnat',
	'pa_obshhaya-ploshhad',
	'pa_ssylka-na-prezentacziyu',
	'pa_telefon-rieltora',
	'pa_tip-nedvizhimosti',
	'pa_vid-iz-okon',
	'pa_vsego-etazhej'
];

$attachment_ids     = $product->get_gallery_attachment_ids();
$broker_name        = isset($attributes['pa_imya-rieltora']) ? $product->get_attribute('pa_imya-rieltora') : 'TOPBROKER';

// get broker image URL [START]
$terms = get_terms('pa_imya-rieltora', array(
	'hide_empty' => false,
	'object_ids' => $post_id
));

$termDesc = "";

foreach ($terms as $term) {
	$termDesc = $term->description;
}

preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $termDesc, $brokerImgUrl);
// get broker image URL [END]



// additional attributes [START]
$display_result = "";

foreach ($attributes as $attribute) {
	if ($attribute->get_variation()) {
		continue;
	}

	// to make attribute visible only for admin [START]
	$isVisible = $attribute->get_visible();

	if (!current_user_can('manage_options') && !$isVisible) {
		continue;
	}
	// to make attribute visible only for admin [END]

	$name = $attribute->get_name();

	if (!in_array($name, $productAttrNotShow)) {
		if ($attribute->is_taxonomy()) {
			$terms                  = wp_get_post_terms($product->get_id(), $name, 'all');
			$cwtax                  = $terms[0]->taxonomy;
			$cw_object_taxonomy     = get_taxonomy($cwtax);

			if (isset($cw_object_taxonomy->labels->singular_name)) {
				$tax_label = $cw_object_taxonomy->labels->singular_name;
			}
			elseif (isset($cw_object_taxonomy->label)) {
				$tax_label = $cw_object_taxonomy->label;

				if (0 === strpos($tax_label, 'Product ')) {
					$tax_label = substr($tax_label, 8);
				}
			}

			$display_result .= '<div class="product_attr_item">' . $tax_label . ': ';
			$tax_terms = array();

			foreach ($terms as $term) {
				$single_term = esc_html($term->name);
				array_push($tax_terms, $single_term);
			}

			$display_result .= '<span class="product_attr_item__val">' . implode(', ', $tax_terms) .  '</span></div>';
		}
		else {
			$display_result .= '<div class="product_attr_item"><span class="product_attr_item__name">' . $name . '</span>';
			$display_result .= '<span class="product_attr_item__val">' . esc_html(implode(', ', $attribute->get_options())) . '</span></div>';
		}
	}
}
// additional attributes [END]

$address                    = isset($attributes['pa_adres']) ? $product->get_attribute('pa_adres') : '';
$brokerPhotoCSS             = isset($attributes['pa_imya-rieltora']) ? 'background: url("data:image/png;base64, ' . base64_encode(file_get_contents($brokerImgUrl[0][0])) . '") center no-repeat; height: 170px;' : '';
$broker_email               = isset($attributes['pa_email_rieltora']) ? $product->get_attribute('pa_email_rieltora') : '1@topbroker.moscow';
$broker_phone               = isset($attributes['pa_telefon-rieltora']) ? $product->get_attribute('pa_telefon-rieltora') : '+7(977)802-16-16';
$googleMapsX                = empty($product->get_attribute('pa_google-api-x')) ? '55.7560299' : $product->get_attribute('pa_google-api-x');
$googleMapsY                = empty($product->get_attribute('pa_google-api-y')) ? '37.6048052' : $product->get_attribute('pa_google-api-y');
$mainImg                    = empty(!wp_get_attachment_image_src(get_post_thumbnail_id( $post_id ), 'single-post-thumbnail')[0]) ? 'background: url("data:image/png;base64, ' . base64_encode(file_get_contents(wp_get_attachment_image_src(get_post_thumbnail_id( $post_id ), 'single-post-thumbnail')[0])) . '") center no-repeat;' : '';
$obshhayaPloshhad           = isset($attributes['pa_obshhaya-ploshhad']) ? $product->get_attribute('pa_obshhaya-ploshhad') : '';
$tip_nedvizhimosti          = isset($attributes['pa_tip-nedvizhimosti']) ? $product->get_attribute('pa_tip-nedvizhimosti') : '';
$price                      = $product->get_price();
$price_formatted            = $price !== "" ? number_format($price, 0, '.', ' ') : '';
$price_words                = $price !== "" ? num2str($price) : '';
$product_description        = $product->get_description() !== "" ? $product->get_description() : '';

$html = '
	<html>
		<head>
			<style>
				@page {
					margin: 0;
				}

				body {
					font-family: DejaVu Sans, sans-serif;
					font-size: 0;
				}

				.firstpage {
					margin: 40px 0;
					padding: 0 30px;
				}

				.firstpage .cover-image {
					' . $mainImg . '
					background-size: cover;
					border-radius: 5px;
					display: inline-block;
					height: 396px;
					margin-right: 40px;
					vertical-align: top;
					width: 495px;
				}

				.firstpage .broker-info {
					display: inline-block;
					font-size: 14px;
					text-align: center;
					vertical-align: top;
					width: 194px;
				}

				.firstpage .broker-info .logo {
					background: url("data:image/svg+xml;base64, ' . base64_encode(file_get_contents('https://brokertop.ru/wp-content/themes/broker2022/i/logo_for_pdf.png')) . '") center no-repeat;
					background-size: cover;
					height: 61px;
					width: 165px;
				}

				.firstpage .broker-info .broker-name {
					margin-top: 10px;
				}

				.firstpage .broker-info .broker-photo {
					'. $brokerPhotoCSS . '
					background-size: cover;
					border-radius: 5px;
					height: 138px;
					margin: 0 0 0 30px;
					width: 138px;
				}

				.firstpage .broker-info .broker-title {
					font-weight: 700;
					margin: 10px;
				}

				.firstpage .broker-info .broker-phone {
					margin-top: 10px;
				}

				.firstpage .broker-info .broker-email {
					margin-top: 10px;
				}

				.firstpage-line {
					border-bottom: 1px dashed #f7f7f7;
					margin: 25px 30px;
				}

				.firstpage-data {
					padding:0 30px;
					font-weight:700;
				}

				.firstpage-data .left {
					box-sizing: border-box;
					display: inline-block;
					font-size: 14px;
					text-align: left;
					vertical-align: top;
					width: 50%;
				}

				.firstpage-data .right {
					box-sizing: border-box;
					display: inline-block;
					font-size: 14px;
					text-align: right;
					vertical-align: top;
					width: 50%;
				}

				.firstpage-data-info {
					background: #f7f7f7;
					box-sizing: border-box;
					margin: 10px 30px 0;
					width: calc(100% - 60px);
				}

				.firstpage-data-info > div {
					display: inline-block;
					font-size: 14px;
					line-height: 1.2;
					padding: 10px 0 20px;
					text-align: center;
					vertical-align: top;
					width: 25%;
				}

				.firstpage-data-info > div.empty {
					line-height: 36px;
				}

				.firstpage-data-info-detail {
					color: #999;
					display: flex;
					flex-direction: column;
					font-size: 14px;
					margin: 30px;
					width: calc(100% - 60px);
				}

				.firstpage-data-info-detail span {
					color: #000;
				}

				.firstpage-data-info-detail p {
					color: #000;
					line-height: 1.7;
				}

				.firstpage-data-info-detail h2 {
					color: #000;
				}

				.firstpage-data-info-footer {
					align-items: flex-end;
					display: flex;
					font-size: 16px;
					justify-content: center;
					text-align: center;
				}
			</style>
		</head>

		<body>
			<div class="firstpage">
				<div class="cover-image"></div>

				<div class="broker-info">
					<div class="logo"></div>
					<div class="broker-title">Брокер объекта</div>
					<div class="broker-photo"></div>
					<div class="broker-name">' . $broker_name . '</div>
					<div class="broker-phone">' . $broker_phone . '</div>
					<div class="broker-email">' . $broker_email . '</div>
				</div>
			</div>

			<div class="firstpage-line"></div>

			<div class="firstpage-data">
				<div class="left">' . $product->get_title() . '</div>';

				if ($price_formatted) $html .= '<div class="right">' . $price_formatted . ' &#8381;</div>';

				$html .='</div>';

				if ($obshhayaPloshhad) {
					$html .='<div class="firstpage-data-info">
						<div><span>' . $obshhayaPloshhad . ' <small>м</small><sup>2</sup><br>Общая площадь</span></div>
					</div>';
				}

				$html .='<div class="firstpage-data-info-detail">';
				// адрес
				if ($address) $html .= '<div style="margin-bottom: 20px;">Адрес: <span>' . $address . '</span></div>';

				$html .= '<div>
					<img style="height: 250px; width: 650px;" src="data:image/svg+xml;base64, '.base64_encode(file_get_contents('https://static-maps.yandex.ru/1.x/?ll=' . $googleMapsY . ',' . $googleMapsX . '&size=650,250&z=13&l=map&pt=' . $googleMapsY . ',' . $googleMapsX . ',pm2dom~37.64,55.76363,pm2dom99')).'" alt="">
				</div>';

				if ($product_description) {
					$html .= '<div>
						<p>Описание:</p>
						<p>' . $product->get_description() . '</p>
					</div>';
				}

				$html .= '<h2>Общая информация</h2>

				<div>' . $display_result . '</div>';

				if ($price_formatted) $html .= '<div>Цена: <span>' . $price_formatted . ' &#8381;</span></div>';

				$html .= '<div>Планировка: <span></span></div>';

				// тип недвижимости
				if ($tip_nedvizhimosti) $html .= '<div>Тип объекта: <span>' . $tip_nedvizhimosti . '</span></div>';

				$html .= '<div>Валюта: <span>&#8381;</span></div>
				<div>Категория объекта: <span></span></div>';

				if ($price_words) $html .= '<div>Цена (прописью): <span>' . $price_words . '</span></div>';

				$html .= '<h2>Контактная информация</h2>';

				if ($broker_phone && $broker_name) $html .= '<div>Брокер объекта: <span>' . $broker_phone . ', ' . $broker_name . '</span></div>';

				$html .= '<h2>Фотографии объекта</h2>';

				foreach($attachment_ids as $attachment_id) {
					$image_link = wp_get_attachment_url($attachment_id);
					$html .= '<img src="data:image/png;base64, '.base64_encode(file_get_contents($image_link)).'" style="width: 735px; height: auto; padding: 9px;" alt="" /><br>';
				}

			$html .= '</div>

			<div class="firstpage-data-info-footer">
				<span>123112, г. Москва, ул. Пресненская набережная, 8, стр.1, 571<br>
				+79778021616<br>
				84951503977<br>
				1@topbroker.moscow
			</span>
			</div>
		</body>
	</html>
';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream('object_' . $post_id . '.pdf',array("Attachment" => false));

exit(0);

function num2str($num) {
	$nul        = 'ноль';
	$ten        = array(
		array('','один','два','три','четыре','пять','шесть','семь','восемь','девять'),
		array('','одна','две','три','четыре','пять','шесть','семь','восемь','девять'),
	);
	$a20        = array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
	$tens       = array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
	$hundred    = array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
	$unit = array( // Units
		array('копейка' ,'копейки' ,'копеек',    1),
		array('рубль'   ,'рубля'   ,'рублей'    ,0),
		array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
		array('миллион' ,'миллиона','миллионов' ,0),
		array('миллиард','милиарда','миллиардов',0),
	);

	list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
	$out = array();

	if (intval($rub) > 0) {
		foreach(str_split($rub,3) as $uk => $v) {
			if (!intval($v)) continue;

			$uk = sizeof($unit)-$uk-1;
			$gender = $unit[$uk][3];
			list($i1,$i2,$i3) = array_map('intval',str_split($v,1));

			$out[] = $hundred[$i1];

			if ($i2 > 1) $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3];
			else $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3];

			if ($uk > 1) $out[] = morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
		}
	}
	else $out[] = $nul;

	$out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]);
	$out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]);

	return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
}

function morph($n, $f1, $f2, $f5) {
	$n = abs(intval($n)) % 100;

	if ($n>10 && $n<20) return $f5;

	$n = $n % 10;

	if ($n>1 && $n<5) return $f2;

	if ($n==1) return $f1;

	return $f5;
} ?>
