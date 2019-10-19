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

$left=3;
$top=3;


/* $pdf->write2DBarcode($nd_qr, 'QRCODE,H', $left, $top, $qrsize, $qrsize, $style_nopadding, 'N'); */

$barcodeobj = new TCPDF2DBarcode('http://www.tcpdf.org', 'QRCODE,H');
/* echo $barcodeobj->getBarcodeHTML(3, 3, 'black'); */

$html2 = '
    <table width="100%">
        <tr>
            <td width="33%">
            '.$barcodeobj.'
            </td>
            <td width="33%">
            hahaa
            </td>
            <td width="33%">
            hahaa
            </td>
        </tr>
    </table>';
$pdf->writeHTMLCell('', '', $left, $top + 2, $html2, 0, 0, 0, true, 'J', true);



$pdf->Output('barcode_sach.pdf', 'I');


?>