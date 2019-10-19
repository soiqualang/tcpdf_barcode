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
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
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
$qrsize=20;

$nd_qr=998687699;
$left=$qrleft;
$top=3;

$pdf->write2DBarcode($nd_qr, 'QRCODE,H', $left, $top, $qrsize, $qrsize, $style_nopadding, 'N');

$pdf->Text($left-2, $top+$qrsize, $nd_qr);


/* Qrcode 2 */

$nd_qr=998687699;
$left=$qrleft+$qrleft+$qrsize+$qrright;

$pdf->write2DBarcode($nd_qr, 'QRCODE,H', $left, $top, $qrsize, $qrsize, $style_nopadding, 'N');

$pdf->Text($left-2, $top+$qrsize, $nd_qr);


/* Qrcode 3 */

$nd_qr=998687699;
$left=$left+$qrleft+$qrleft+$qrsize;

$pdf->write2DBarcode($nd_qr, 'QRCODE,H', $left, $top, $qrsize, $qrsize, $style_nopadding, 'N');

$pdf->Text($left-2, $top+$qrsize, $nd_qr);


/* 
Dong 2 
*/

$nd_qr=998687699;
$left=$qrleft;
$top=$top+$qrsize+$top;

$pdf->write2DBarcode($nd_qr, 'QRCODE,H', $left, $top, $qrsize, $qrsize, $style_nopadding, 'N');

$pdf->Text($left-2, $top+$qrsize, $nd_qr);


/* Qrcode 2 */

$nd_qr=998687699;
$left=$qrleft+$qrleft+$qrsize+$qrright;

$pdf->write2DBarcode($nd_qr, 'QRCODE,H', $left, $top, $qrsize, $qrsize, $style_nopadding, 'N');

$pdf->Text($left-2, $top+$qrsize, $nd_qr);


/* Qrcode 3 */

$nd_qr=998687699;
$left=$left+$qrleft+$qrleft+$qrsize;

$pdf->write2DBarcode($nd_qr, 'QRCODE,H', $left, $top, $qrsize, $qrsize, $style_nopadding, 'N');

$pdf->Text($left-2, $top+$qrsize, $nd_qr);



/* $pdf->StartTransform();
$pdf->Rotate(-90);
$pdf->Cell(0,0,'This is a sample data',1,1,'L',0,'');
$pdf->Text(0, trai phai, 'Day la ma xe');
$pdf->Text(6, 6, 'Day la ma xe');
$pdf->StopTransform(); */



/* $pdf->write2DBarcode('haha^^T1', 'QRCODE,H', $left+25+2, $top, 25, 25, $style_nopadding, 'N');

$pdf->write2DBarcode('haha^^T1', 'QRCODE,H', $left+25+2+25+2, $top, 25, 25, $style_nopadding, 'N'); */

$pdf->Output('barcode_sach.pdf', 'I');


?>