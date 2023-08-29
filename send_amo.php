<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">

	<?php require_once 'wp-load.php';
	require __DIR__ . '/vendor/autoload.php';

	if (isset($_POST['user-phone'])) {
		/*try {
			$subdomain = '1amotopbrokermoscow';
			$login     = '1@topbroker.Moscow';
			$apikey    = '543b7a20dd7ff2cb50f46407b8cde4a2972368ee';

			$amo            = new \AmoCRM\Client($subdomain, $login, $apikey);
			$lead = $amo->lead;
			$lead['name'] = $_POST['product_name'];
			$lead['pipeline_id'] = 4507276; 
			$id = $lead->apiAdd();
			

			$contact            = $amo->contact;
			$contact['name']    = isset($_POST['user-name']) ? $_POST['user-name'] : 'Не указано';
			$contact['linked_leads_id'] = [(int)$id];
			$contact->addCustomField(184885, [
				[$_POST['user-phone'], 'MOB']
			]);
			$contact->addCustomField(184887, [
				[$_POST['user-email'], 'PRIV']
			]);
			$contact->addCustomField(184883, [
				[$_POST['page-url'], 'PRIV']
			]);
			$id = $contact->apiAdd();
			
					}
		catch (\AmoCRM\Exception $e) {
			printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
		}*/
			/*$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if ($statusCode != 200) {
				die('Ошибка при отправке данных: ' . $statusCode);
			}*/
			//print_r($amo->pipelines->apiList());

			$url = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);

			$to         = 'dfox@foxartbox.com';
			$subject    = 'Заявка с сайта';
			$message    = 'Имя: ' . $_POST['user-name'] . '<br>';
			$message    .= 'Телефон: ' . $_POST['user-phone'] . '<br>';
			$message    .= 'Email: ' . $_POST['user-email'] . '<br>';
//			$message    .= 'From page: ' . $_POST['page-url'] . '<br>';
			$message    .= 'From page: ' . $url . '<br>';
			$headers = 'From: info@brokertop.ru' . "rn" .
			  'Reply-To: ' . $_POST['user-email'] . "rn" .
			  'Content-type: text/html; charset=utf-8' . "rn" .
			  'X-Mailer: PHP/' . phpversion();

			if (mail($to, $subject, $message, $headers)) {
				echo "Сообщение продублировано на почту!";
			}
			else {
				echo "Ошибка отправки";
			}
	} ?>
</html>