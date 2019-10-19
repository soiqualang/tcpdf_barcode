<?php
require_once('tcpdf_include.php');

/* Khổ giấy */
$width=110;
$height=45;
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


$style_nopadding = array(
    'border' => false,
    'padding' => 0,
    'fgcolor' => array(128,0,0),
    'bgcolor' => false
);

/* Qrcode 1 */
$qrsize=20;

$nd_qr=998687699;
$top=3;

$pdf->write2DBarcode($nd_qr, 'QRCODE,H', 10, 3, $qrsize, $qrsize, $style_nopadding, 'N');

/* $pdf->write2DBarcode($nd_qr, 'QRCODE,H', 45, 3, $qrsize, $qrsize, $style_nopadding, 'N');

$pdf->write2DBarcode($nd_qr, 'QRCODE,H', 80, 3, $qrsize, $qrsize, $style_nopadding, 'N'); */

$pdf->Output('barcode_sach.pdf', 'I');


?>