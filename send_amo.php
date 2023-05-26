<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">

	<?php require_once 'wp-load.php';
	require __DIR__ . '/vendor/autoload.php';

//	if (isset($_POST['user-phone'])) {
		try {
			$subdomain = '1amotopbrokermoscow';
			$login     = '1@topbroker.Moscow';
			$apikey    = '543b7a20dd7ff2cb50f46407b8cde4a2972368ee';

			$amo            = new \AmoCRM\Client($subdomain, $login, $apikey);
			$lead           = $amo->lead;
			$lead['name']   = $_POST['product_name'];
			$id             = $lead->apiAdd();

			$contact            = $amo->contact;
			$contact['name']    = isset($_POST['user-name']) ? $_POST['user-name'] : 'Не указано';
			$contact['linked_leads_id'] = [(int)$id];
			$contact->addCustomField(184885, [
				[$_POST['user-phone'], 'MOB'],
			]);
			$contact->addCustomField(184887, [
				[$_POST['user-email'], 'PRIV'],
			]);
			$id = $contact->apiAdd();

			// test all fileds
//			print_r($amo->account->apiCurrent());


			$url = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);

			$to   = 'dfox@foxartbox.com';
			//$to       = 'Arson66@yandex.ru';
			$subject    = 'Заявка с сайта';
			$message    = 'Имя: ' . $_POST['user-name'] . '<br>';
			$message    .= 'Телефон: ' . $_POST['user-phone'] . '<br>';
			$message    .= 'Email: ' . $_POST['user-email'] . '<br>';
			//$message    .= 'From page: ' . $_POST['page-url'] . '<br>';
			$message    .= 'From page: ' . $url . '<br>';
			//$message .= 'Product name: '.$_POST['product_name'].'<br>';
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
		}
		catch (\AmoCRM\Exception $e) {
			printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
		}
//	}
	?>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Ваша заявка успешно отправлена</title>

	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans" rel="stylesheet">

	<style>
		body,
		html {
			background-color: #fff;
			color: #636b6f;
			font-family: 'IBM Plex Sans', sans-serif;
			font-weight: 100;
			height: 100vh;
			margin: 0;
		}

		.back-link {
			text-decoration: none;
			border-bottom: 1px dotted;
		}

		.content {
			text-align: center;
		}

		.flex-center {
			align-items: center;
			display: flex;
			justify-content: center;
		}

		.full-height {
			height: 100vh;
		}

		.position-ref {
			position: relative;
		}

		.success-message {
			font-size: 33px;
			font-weight: 500;
			margin-bottom: 20px;
		}

		.title {
			font-size: 20px;
			padding: 20px;
		}
	</style>
</head>

<body>
	<div class="flex-center position-ref full-height">
		<div class="content">
			<div class="title">
				<p class="success-message">Спасибо!</p>

				<p>Ваша заявка успешно отправлена.</p>

				<?php if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']) { ?>
					<br><br><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="back-link">Вернуться назад</a>
				<?php } ?>
			</div>
		</div>
	</div>
</body>
</html>