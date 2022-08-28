<?php

require_once 'pdf/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml('<h4>HTML to PDF using Dompdf</h4><br><p>by yourblogcoach</p>');

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream();


echo 'asd';

?>