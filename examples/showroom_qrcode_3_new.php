<?php
require_once('tcpdf_include.php');

/* Khổ giấy */
$width=110;
$height=75;
/* Khổ qrcode
35x25 */


$pageLayout = array($width, $height); //  or array($height, $width) 
$pdf = new TCPDF('l', 'mm', $pageLayout, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
/* $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT); */
/* $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); */
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$pdf->AddPage();
/* font size */
$pdf->SetFont('dejavusansextralight', '', 4);
$pdf->setJPEGQuality(10);

/* $pdf->write1DBarcode('hahahahaha', 'C93', $left + 5, $top + 34, '', 18, 0.4, $style, 'N'); */

$style_nopadding = array(
    'border' => false,
    'padding' => 0,
    'fgcolor' => array(128,0,0),
    'bgcolor' => false
);

/* $pdf->write2DBarcode('haha^^T1', 'QRCODE,H', $left, $top, 50, 50, $style_nopadding, 'N'); */

/* Qrcode 1 */
$qrleft=6;
$qrright=6;
$qrsize=18;

$nd_qr=998687699;
$left=$qrleft;
$top=3;

$pdf->write2DBarcode($nd_qr, 'QRCODE,H', 10, 3, $qrsize, $qrsize, $style_nopadding, 'N');

//$pdf->Text($left-2, $top+$qrsize, $nd_qr);


/* Qrcode 2 */

$nd_qr=998687699;

$pdf->write2DBarcode($nd_qr, 'QRCODE,H', 45, 3, $qrsize, $qrsize, $style_nopadding, 'N');

//$pdf->Text($left-2, $top+$qrsize, $nd_qr);


/* Qrcode 3 */

$style_nopadding_right = array(
    'border' => false,
    'padding' => 0,
    'fgcolor' => array(128,0,0),
    'bgcolor' => false,
    'position' => 'R'
);

$nd_qr=998687699;

$pdf->write2DBarcode($nd_qr, 'QRCODE,H', 0, 3, $qrsize, $qrsize, $style_nopadding_right, 'N');

//$pdf->Text($left-2, $top+$qrsize, $nd_qr);

/* 
Dong 2
 */


/* Qrcode 1 */
$qrleft=6;
$qrright=6;

$nd_qr=998687699;
$left=$qrleft;
$top.=$qrsize;

$pdf->write2DBarcode($nd_qr, 'QRCODE,H', 10, 25, $qrsize, $qrsize, $style_nopadding, 'N');

//$pdf->Text($left-2, $top+$qrsize, $nd_qr);


/* Qrcode 2 */

$nd_qr=998687699;

$pdf->write2DBarcode($nd_qr, 'QRCODE,H', 45, 25, $qrsize, $qrsize, $style_nopadding, 'N');

//$pdf->Text($left-2, $top+$qrsize, $nd_qr);


/* Qrcode 3 */

$style_nopadding_right = array(
    'border' => false,
    'padding' => 0,
    'fgcolor' => array(128,0,0),
    'bgcolor' => false,
    'position' => 'R'
);

$nd_qr=998687699;

$pdf->write2DBarcode($nd_qr, 'QRCODE,H', 0, 25, $qrsize, $qrsize, $style_nopadding_right, 'N');

//$pdf->Text($left-2, $top+$qrsize, $nd_qr);





$pdf->Output('barcode_sach.pdf', 'I');


?>