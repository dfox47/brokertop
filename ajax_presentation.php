<?php
require_once 'wp-load.php';
require_once 'pdf/autoload.php';

use Dompdf\Dompdf;

define("DOMPDF_ENABLE_REMOTE", true);

$post_id = intval($_GET['id']);
$post = get_post($post_id);

$product = wc_get_product($post_id);
$attributes = $product->get_attributes();

$broker_photo = isset($attributes['pa_foto-rieltora']) ? $product->get_attribute('pa_foto-rieltora') : '';
$broker_name = isset($attributes['pa_imya-rieltora']) ? $product->get_attribute('pa_imya-rieltora') : '';
$broker_phone = isset($attributes['pa_telefon-rieltora']) ? $product->get_attribute('pa_telefon-rieltora') : '';
$broker_email = isset($attributes['pa_email_rieltora']) ? $product->get_attribute('pa_email_rieltora') : '';
$broker_adres = isset($attributes['pa_adres']) ? $product->get_attribute('pa_adres') : '';
$broker_tip_nedvizhimosti = isset($attributes['pa_tip-nedvizhimosti']) ? $product->get_attribute('pa_tip-nedvizhimosti') : '';
$broker_obshhaya_ploshhad = isset($attributes['pa_obshhaya-ploshhad']) ? $product->get_attribute('pa_obshhaya-ploshhad') : '';
$googleMapsX = (empty($product->get_attribute('pa_google-api-x')) ? '55.7560299' : $product->get_attribute('pa_google-api-x'));
$googleMapsY = (empty($product->get_attribute('pa_google-api-y')) ? '37.6048052' : $product->get_attribute('pa_google-api-y'));


$main_image = wp_get_attachment_image_src(get_post_thumbnail_id( $post_id ), 'single-post-thumbnail')[0];

$attachment_ids = $product->get_gallery_attachment_ids();

    foreach( $attachment_ids as $attachment_id ) {
      //echo $image_link = wp_get_attachment_url( $attachment_id );	 
	//echo wp_get_attachment_image($attachment_id, 'medium');

    }
	
//var_dump($product);
// echo $broker_photo; https://via.placeholder.com/164x59 <img src="data:image/png;base64, '.base64_encode(file_get_contents('http://brokertop.ru/wp-content/uploads/2022/04/1-1-scaled.jpg')).'">

$html = '
	<html>
		<head>
			<style>
				@page {
					margin:0;
				}
			
				body{
					font-family:DejaVu Sans, sans-serif;
					font-size:0;
				}
				
				.firstpage{
					margin:40px 0;
					padding:0 30px;
				}
				
				.firstpage .cover-image{
					display:inline-block;
					vertical-align:top;
					margin-right:40px;
					width:495px;
					height:396px;
					border-radius:5px;
					background:url("data:image/png;base64, '.base64_encode(file_get_contents($main_image)).'") center no-repeat;
					background-size:cover;
				}
				
				.firstpage .broker-info{
					display:inline-block;
					vertical-align:top;
					width:194px;
					font-size:14px;
					text-align:center;
				}
				
				.firstpage .broker-info .logo{
					width:194px;
					height:59px;
					background:url("data:image/svg+xml;base64, '.base64_encode(file_get_contents('https://brokertop.ru/wp-content/themes/broker2022/i/logo_for_pdf.png')).'") center no-repeat;
					background-size:cover;
				}
				
				.firstpage .broker-info .broker-title{
					margin:10px;
					font-weight:700;
				}
				
				.firstpage .broker-info .broker-photo{
					height:170px;
					background:url("data:image/png;base64, '.base64_encode(file_get_contents($broker_photo)).'") center no-repeat;
					background-size:cover;
					border-radius:5px;
				}
				
				.firstpage .broker-info .broker-name{
					margin-top:10px;
				}
				
				.firstpage .broker-info .broker-phone{
					margin-top:10px;
				}
				
				.firstpage .broker-info .broker-email{
					margin-top:10px;
				}
				
				.firstpage-line{
					border-bottom:1px dashed #F7F7F7;
					margin:25px 30px;
				}
				
				.firstpage-data{
					padding:0 30px;
					font-weight:700;
				}
				
				.firstpage-data .left{
					display:inline-block;
					vertical-align:top;
					width:50%;
					text-align:left;
					box-sizing:border-box;
					font-size:14px;
				}
				
				.firstpage-data .right{
					display:inline-block;
					vertical-align:top;
					width:50%;
					text-align:right;
					box-sizing:border-box;
					font-size:14px;
				}
				
				.firstpage-data-info{
					width:calc(100% - 60px);
					margin:0 30px;
					box-sizing:border-box;
					background:#F7F7F7;
					margin-top:10px;
				}
				
				.firstpage-data-info > div{
					padding-top:10px;
					padding-bottom:20px;
					width:25%;
					display:inline-block;
					vertical-align:top;
					text-align:center;
					font-size:14px;
					line-height:18px;
				}
				
				.firstpage-data-info > div.empty{
					line-height:36px;
				}
				
				.firstpage-data-info-detail {
					display: flex;
					font-size: 14px;
					flex-direction: column;
					width: calc(100% - 60px);
					margin: 31px 30px;
					color: #999;
				}
				
				.firstpage-data-info-detail span {
					color: #000000;
				}
				
				.firstpage-data-info-detail p {
					color: #000000;
					line-height: 1.7;
				}
				
				.firstpage-data-info-detail h2 {
					color: #000000;
				}
				
				.firstpage-data-info-footer {
					display: flex;
					justify-content: center;
					align-items: flex-end;
					font-size: 16px;
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
					<div class="broker-name">'.$broker_name.'</div>
					<div class="broker-phone">'.$broker_phone.'</div>
					<div class="broker-email">'.$broker_email.'</div>
				</div>
			</div>
			
			<div class="firstpage-line"></div>
			
			<div class="firstpage-data">
				<div class="left">'.$product->get_title().'</div>
				<div class="right">'.number_format($product->get_price(), 0, '.', ' ').' &#8381;</div>
			</div>
			
			<div class="firstpage-data-info">
				<div><span>'.$broker_obshhaya_ploshhad.' <small>м</small><sup>2</sup><br>Общая площадь</span></div>
				<div><span>-<br>кухня</span></div>
				<div><span>-<br>комнаты</span></div>
				<div class="empty"><span>-</span></div>
			</div>
			<div class="firstpage-data-info-detail">
				<div style="margin-bottom: 20px;">Адрес: <span>'.$broker_adres.'</span>
				</div>
				<div>
				<img width:300px; height:250px; src="data:image/svg+xml;base64, '.base64_encode(file_get_contents('https://static-maps.yandex.ru/1.x/?ll='.$googleMapsY.','.$googleMapsX.'&size=650,250&z=13&l=map&pt='.$googleMapsY.','.$googleMapsX.',pm2dom~37.64,55.76363,pm2dom99')).'">
				</div>
				<div>Описание:
				<p>'.$product->get_description().'</p>
				</div>
				<h2>Общая информация</h2>
				<div>Цена: <span>'.number_format($product->get_price(), 0, '.', ' ').' &#8381;</span></div>
				<div>Планировка: <span></span></div>
				<div>Тип объекта: <span>'.$broker_tip_nedvizhimosti.'</span></div>
				<div>Валюта: <span>&#8381;</span></div>
				<div>Категория объекта: <span></span></div>
				<div>Цена (прописью): <span>'.num2str($product->get_price()).'</span></div>
				<h2>Контактная информация</h2>
				<div>Брокер объекта: <span>'.$broker_phone.', '.$broker_name.'</span></div>
				<h2>Фотографии объекта</h2>';
				foreach( $attachment_ids as $attachment_id ) {
				$image_link = wp_get_attachment_url( $attachment_id );   
						$html.= '<img width:300px; height:250px; src="data:image/png;base64, '.base64_encode(file_get_contents($image_link)).'" style="width: 735px; height: 460px; padding: 9px;"><br>';  
				}'
			</div>
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

$dompdf->stream('document.pdf',array("Attachment" => false));

exit(0);

function num2str($num) {
    $nul='ноль';
    $ten=array(
        array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
        array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
    );
    $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
    $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
    $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
    $unit=array( // Units
        array('копейка' ,'копейки' ,'копеек',	 1),
        array('рубль'   ,'рубля'   ,'рублей'    ,0),
        array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
        array('миллион' ,'миллиона','миллионов' ,0),
        array('миллиард','милиарда','миллиардов',0),
    );
    //
    list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
    $out = array();
    if (intval($rub)>0) {
        foreach(str_split($rub,3) as $uk=>$v) { 
            if (!intval($v)) continue;
            $uk = sizeof($unit)-$uk-1; 
            $gender = $unit[$uk][3];
            list($i1,$i2,$i3) = array_map('intval',str_split($v,1));

            $out[] = $hundred[$i1]; 
            if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3];
            else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; 

            if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
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
}
?>

