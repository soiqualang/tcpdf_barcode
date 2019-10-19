<?php
require_once('tcpdf_include.php');



$width=210;
$height=297;
$pageLayout = array($width, $height); //  or array($height, $width) 
$pdf = new TCPDF('p', 'pt', $pageLayout, true, 'UTF-8', false);

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
$pdf->SetFont('dejavusansextralight', '', 9);
$style       = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => true,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(
        0,
        0,
        0
    ),
    'bgcolor' => false,
    'text' => true,
    'font' => 'dejavusansextralight',
    'fontsize' => 8,
    'stretchtext' => 4
);

$left              = 7;
$top               = 20;
$lengh             = 5;
$pdf->setJPEGQuality(10);

/* $pdf->write1DBarcode('hahahahaha', 'C93', $left + 5, $top + 34, '', 18, 0.4, $style, 'N'); */

$style_nopadding = array(
    'border' => false,
    'padding' => 0,
    'fgcolor' => array(128,0,0),
    'bgcolor' => false
);

$pdf->write2DBarcode('haha^^T1', 'QRCODE,H', $left, $top, 50, 50, $style_nopadding, 'N');

/* $pdf->write2DBarcode('hahahahaha', 'QRCODE,H', 140, 210, 50, 50, $style_nopadding, 'N'); */

$pdf->Output('barcode_sach.pdf', 'I');



// -------------------------------------------------------------------
// DATAMATRIX (ISO/IEC 16022:2006)

/* $pdf->write2DBarcode('http://www.tcpdf.org', 'DATAMATRIX', 80, 150, 50, 50, $style, 'N');
$pdf->Text(80, 145, 'DATAMATRIX (ISO/IEC 16022:2006)');

// -------------------------------------------------------------------

// new style
$style = array(
    'border' => 2,
    'padding' => 'auto',
    'fgcolor' => array(0,0,255),
    'bgcolor' => array(255,255,64)
);

// QRCODE,H : QR-CODE Best error correction
$pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,H', 80, 210, 50, 50, $style, 'N');
$pdf->Text(80, 205, 'QRCODE H - COLORED');

// new style
$style = array(
    'border' => false,
    'padding' => 0,
    'fgcolor' => array(128,0,0),
    'bgcolor' => false
);

// QRCODE,H : QR-CODE Best error correction
$pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,H', 140, 210, 50, 50, $style, 'N');
$pdf->Text(140, 205, 'QRCODE H - NO PADDING');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_050.pdf', 'I'); */
?>