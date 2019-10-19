<?php
include("../../../functions/mysql.php");
include("../../../functions/libs.php");
include("../../../functions/function.php");
require_once('tcpdf_include.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
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
$style_thehs = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
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
if (isset($_POST["taobarcode_sach"])) {
    $maxelem = $_POST["soluongbarcode_sach"];
    $maxid   = $_POST["maxid"];
    $left    = 6;
    $top     = 10;
    $lengh   = 9;
    for ($i = 1; $i <= $maxelem; $i++) {
        $lenghelem = strlen($maxid + $i);
        $num0      = ($lengh - $lenghelem);
        $num0txt   = '';
        for ($j = 1; $j <= $num0; $j++) {
            $num0txt .= '0';
        }
        $mavach = 'MK' . $num0txt . ($maxid + $i);
        $pdf->write1DBarcode($mavach, 'C93', $left, $top, '', 16, 0.23, $style, 'N');
        $sql = "INSERT INTO mavachsach(mavach) VALUES('$mavach')";
        $rs  = mysql_getQuery($sql);
        $left += 38;
        if ($i % 5 == 0) {
            $top += 20;
            $left = 6;
        }
        if (($i % 65 == 0) and (($i + 1) < $maxelem)) {
            $pdf->AddPage();
            $top = 10;
        }
    }
    $pdf->Output('barcode_sach.pdf', 'I');
}
function numspace($txtin)
{
    $lenghelem = mb_strlen($txtin);
    $numspace  = round((19 - $lenghelem) / 2);
    $spacetxt  = '  ';
    for ($j = 1; $j <= $numspace; $j++) {
        $spacetxt .= ' ';
    }
    return $spacetxt;
}
if (isset($_POST["taogaysach"])) {
    $ngaybatdau  = $_POST["ngaybatdau"];
    $ngayketthuc = $_POST["ngayketthuc"];
    $sql         = "SELECT * FROM dausach WHERE ebook != 1";
    $rs          = mysql_getQuery($sql);
    $left        = 7;
    $top         = 3;
    $pdf->setJPEGQuality(10);
    $i = 1;
    while ($row = mysql_fetch_array($rs)) {
        if ((strtotime($row['ngaynhap']) >= strtotime($ngaybatdau)) and (strtotime($row['ngaynhap']) <= strtotime($ngayketthuc))) {
            $pdf->Image('masach2.png', $left, $top, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
            $txt = numspace('Thư viện Minh Khai') . "Thư viện Minh Khai\n";
            $txt .= "\n\n";
            $txt .= numspace($row['ddc']) . $row['ddc'] . "\n";
            $txt .= numspace($row['tenmhtacgia']) . $row['tenmhtacgia'] . "\n";
            $txt .= numspace($row['namxb']) . $row['namxb'] . "\n";
            $txt .= "\n\n";
            $txt .= numspace('C.' . $row['socuon']) . 'C.' . $row['socuon'] . "\n";
            $txt .= numspace($row['maloaidoc']) . $row['maloaidoc'] . "\n";
            $pdf->MultiCell(40, 50, $txt, 0, 'J', false, 1, $left + 8, $top + 3, true, 0, false, true, 0, 'T', false);
            $pdf->Ln(2);
            $left += 50;
            if ($i % 4 == 0) {
                $top += 54;
                $left = 7;
            }
            if ($i % 20 == 0) {
                $pdf->AddPage();
                $top  = 3;
                $left = 7;
            }
            $i++;
        }
    }
    $pdf->Output('barcode_sach.pdf', 'I');
}
if (isset($_POST["taobarcode_sach_gocccccccccccccccccccccccccccc"])) {
    $tenbarcode_sach   = $_POST["tenbarcode_sach"];
    $tenmhbarcode_sach = $_POST["tenmhbarcode_sach"];
    $namxbbarcode_sach = $_POST["namxbbarcode_sach"];
    $loaibarcode_sach  = $_POST["loaibarcode_sach"];
    $maxelem           = $_POST["soluongbarcode_sach"];
    $maxid             = $_POST["maxid"];
    $left              = 7;
    $top               = 20;
    $lengh             = 5;
    $pdf->setJPEGQuality(10);
    for ($i = 1; $i <= $maxelem; $i++) {
        $lenghelem = strlen($maxid + $i);
        $num0      = ($lengh - $lenghelem);
        $num0txt   = '';
        for ($j = 1; $j <= $num0; $j++) {
            $num0txt .= '0';
        }
        $pdf->Image('masach2.png', $left, $top, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
        $txt = "Thư viện Minh Khai\n";
        $txt .= "\n\n";
        $txt .= "       " . $tenmhbarcode_sach . "\n";
        $txt .= "          " . $namxbbarcode_sach . "\n";
        $txt .= "\n\n";
        $txt .= "             " . $loaibarcode_sach . "\n";
        $pdf->MultiCell(40, 50, $txt, 0, 'J', false, 1, $left + 8, $top + 3, true, 0, false, true, 0, 'T', false);
        $pdf->Ln(2);
        $pdf->write1DBarcode('' . $num0txt . ($maxid + $i) . '', 'C93', $left + 5, $top + 34, '', 18, 0.4, $style, 'N');
        $left += 50;
        if ($i % 4 == 0) {
            $top += 55;
            $left = 7;
        }
        if (($i % 16 == 0) and (($i + 1) < $maxelem)) {
            $pdf->AddPage();
            $top = 20;
        }
    }
    $pdf->Output('barcode_sach.pdf', 'I');
}
if (isset($_POST["taobarcode_oldsach"])) {
    $masach = $_POST["masach"];
    $pdf->write1DBarcode('' . $masach . '', 'C93', '', '', '', 18, 0.4, $style, 'N');
    $pdf->Output('barcode_sach.pdf', 'I');
}
if (isset($_POST["inmahs"])) {
    $mahs          = $_POST["mahs"];
    $tenhieutruong = getElement("hieutruong", "ten", "id", countElement0("hieutruong", "id"));
    $chuky         = getElement("hieutruong", "chuky", "id", countElement0("hieutruong", "id"));
    $def           = explode(',', $mahs);
    $left          = 3;
    $top           = 3;
    $leftbc        = 36;
    $topbc         = 47;
    $sety          = 21;
    $setx          = 6;
    $j             = 0;
    for ($i = 0; $i < count($def); $i++) {
        $mahs      = trim($def[$i]);
        $tenhs     = getElement("dshs2013_2014", "HOLOTHS", "MAHS", $mahs) . ' ' . getElement("dshs2013_2014", "TENHS", "MAHS", $mahs);
        $ngasinhhs = getElement("dshs2013_2014", "NGAYSINH", "MAHS", $mahs);
        $sdb       = getElement("dshs2013_2014", "SDB", "MAHS", $mahs);
        $pdf->setJPEGQuality(10);
        $pdf->Image('cmnd.png', $left, $top, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
        $html2 = ' <table width="500px"> <tr> <td width="45px"><img src="logohs.png" width="40px"></td> <td align="center"><font color="blue">SỞ GIÁO DỤC - ĐÀO TẠO TPHCM<br><font size="10">TRƯỜNG THPT NGUYỄN THỊ MINH KHAI</font></font></td> </tr> </table><hr width="310px"> <table width="397px" align="center" cellpadding="2" cellspacing="0.5"> <tr> <th rowspan="5" width="125px">SDB ' . $sdb . '</th> <td align="center"><h1 style="color:red;">THẺ HỌC SINH</h1></td> </tr> <tr> <td align="center"><h2 style="color:blue;">' . $tenhs . '</h2></td> </tr> <!--<tr> <td style="color:blue;">Mã số: ' . $mahs . '</td> </tr>--> <tr> <td style="color:blue;">Ngày sinh: ' . $ngasinhhs . '</td> </tr> <tr> <td style="color:blue;">Địa chỉ trường: 275 ĐBP-P7-Q3</td> </tr> </table> ';
        $pdf->writeHTMLCell('', '', $left, $top + 2, $html2, 0, 0, 0, true, 'J', true);
        $pdf->SetY($sety);
        $pdf->SetX($setx);
        $html = '<table border="1"><tr><td width="113.385826772px" height="151.181102362px">Dán hình ở đây</td></tr></table>';
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Ln(2);
        $pdf->write1DBarcode('' . $mahs . '', 'C93', $leftbc, $topbc, '', 15, 0.37, $style_thehs, 'N');
        $left += 96;
        $leftbc += 96;
        $setx += 96;
        $j++;
        if (($j != 0) and ($j % 2 == 0)) {
            $top += 65;
            $topbc += 65;
            $sety += 65;
            $setx   = 6;
            $left   = 3;
            $leftbc = 36;
        }
        if ($j % 8 == 0) {
            $pdf->AddPage();
            $left   = 3;
            $top    = 3;
            $leftbc = 36;
            $topbc  = 47;
            $sety   = 21;
            $setx   = 6;
            for ($k = 1; $k <= 8; $k++) {
                $pdf->Image('cmnd.png', $left, $top, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
                $html2 = ' <table width="397px" cellpadding="10" cellspacing="5"> <tr> <td width="150px"> LỚP:<br> GVCN:<br> --------------------------------<br> LỚP:<br> GVCN:<br> --------------------------------<br> LỚP:<br> GVCN:<br> <br> Chữ ký của học sinh </td> <td align="center"> Ngày ____ / ____ / ______<br><br> HIỆU TRƯỞNG <br> <br> <img src="../../../images/chuky/' . $chuky . '" width="130px"> <br> <br> <br> ' . $tenhieutruong . ' </td> </tr> </table> ';
                $pdf->writeHTMLCell('', '', $left, $top + 2, $html2, 0, 0, 0, true, 'J', true);
                $left += 96;
                $leftbc += 96;
                $setx += 96;
                $j++;
                if ($k % 2 == 0) {
                    $top += 65;
                    $topbc += 65;
                    $sety += 65;
                    $setx   = 6;
                    $left   = 3;
                    $leftbc = 36;
                }
            }
            $pdf->AddPage();
            $left   = 3;
            $top    = 3;
            $leftbc = 36;
            $topbc  = 47;
            $sety   = 21;
            $setx   = 6;
        }
    }
    $pdf->AddPage();
    $left   = 3;
    $top    = 3;
    $leftbc = 36;
    $topbc  = 47;
    $sety   = 21;
    $setx   = 6;
    $conlai = count($def) % 8;
    for ($yellow = 1; $yellow <= $conlai; $yellow++) {
        $pdf->Image('cmnd.png', $left, $top, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
        $html2 = ' <table width="397px" cellpadding="10" cellspacing="5"> <tr> <td width="150px"> LỚP:<br> GVCN:<br> --------------------------------<br> LỚP:<br> GVCN:<br> --------------------------------<br> LỚP:<br> GVCN:<br> <br> Chữ ký của học sinh </td> <td align="center"> Ngày ____ / ____ / ______<br><br> HIỆU TRƯỞNG <br> <br> <img src="../../../images/chuky/' . $chuky . '" width="130px"> <br> <br> <br> ' . $tenhieutruong . ' </td> </tr> </table> ';
        $pdf->writeHTMLCell('', '', $left, $top + 2, $html2, 0, 0, 0, true, 'J', true);
        $left += 96;
        $leftbc += 96;
        $setx += 96;
        $j++;
        if ($yellow % 2 == 0) {
            $top += 65;
            $topbc += 65;
            $sety += 65;
            $setx   = 6;
            $left   = 3;
            $leftbc = 36;
        }
    }
    $pdf->Output('barcode_hocsinh.pdf', 'I');
}
if (isset($_POST["inthedocgia"])) {
    $ngaybatdau    = $_POST["ngaybatdau_docgia"];
    $ngayketthuc   = $_POST["ngayketthuc_docgia"];
    $sql           = "SELECT * FROM dshs2013_2014 WHERE ngaynhap != ''";
    $rs            = mysql_getQuery($sql);
    $tenhieutruong = getElement("hieutruong", "ten", "id", countElement0("hieutruong", "id"));
    $chuky         = getElement("hieutruong", "chuky", "id", countElement0("hieutruong", "id"));
    $left          = 3;
    $top           = 3;
    $leftbc        = 36;
    $topbc         = 47;
    $sety          = 21;
    $setx          = 6;
    $j             = 0;
    $idocgia       = 0;
    while ($row = mysql_fetch_array($rs)) {
        if ((strtotime($row['ngaynhap']) >= strtotime($ngaybatdau)) and (strtotime($row['ngaynhap']) <= strtotime($ngayketthuc))) {
            $mahs      = $row['MAHS'];
            $tenhs     = $row['HOLOTHS'] . ' ' . $row['TENHS'];
            $ngasinhhs = $row['NGAYSINH'];
            $pdf->setJPEGQuality(10);
            $pdf->Image('cmnd.png', $left, $top, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
            $html2 = ' <table width="500px"> <tr> <td width="45px"><img src="logohs.png" width="40px"></td> <td align="center"><font color="blue">SỞ GIÁO DỤC - ĐÀO TẠO TPHCM<br><font size="10">TRƯỜNG THPT NGUYỄN THỊ MINH KHAI</font></font></td> </tr> </table><hr width="310px"> <table width="397px" align="center" cellpadding="2" cellspacing="0.5"> <tr> <th rowspan="5" width="125px"></th> <td align="center"><h1 style="color:red;">THẺ THƯ VIỆN</h1></td> </tr> <tr> <td align="center"><h2 style="color:blue;">' . $tenhs . '</h2></td> </tr> <!--<tr> <td style="color:blue;">Mã số: ' . $mahs . '</td> </tr>--> <tr> <td style="color:blue;">Ngày sinh: ' . $ngasinhhs . '</td> </tr> <tr> <td style="color:blue;">Địa chỉ trường: 275 ĐBP-P7-Q3</td> </tr> </table> ';
            $pdf->writeHTMLCell('', '', $left, $top + 2, $html2, 0, 0, 0, true, 'J', true);
            $pdf->SetY($sety);
            $pdf->SetX($setx);
            $html = '<table border="1"><tr><td width="113.385826772px" height="151.181102362px">Dán hình ở đây</td></tr></table>';
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Ln(2);
            $pdf->write1DBarcode('' . $mahs . '', 'C93', $leftbc, $topbc, '', 15, 0.37, $style_thehs, 'N');
            $left += 96;
            $leftbc += 96;
            $setx += 96;
            $j++;
            if (($j != 0) and ($j % 2 == 0)) {
                $top += 65;
                $topbc += 65;
                $sety += 65;
                $setx   = 6;
                $left   = 3;
                $leftbc = 36;
            }
            if ($j % 8 == 0) {
                $pdf->AddPage();
                $left   = 3;
                $top    = 3;
                $leftbc = 36;
                $topbc  = 47;
                $sety   = 21;
                $setx   = 6;
                for ($k = 1; $k <= 8; $k++) {
                    $pdf->Image('cmnd.png', $left, $top, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
                    $html2 = ' <table width="397px" cellpadding="10" cellspacing="5"> <tr> <td width="150px"> <br> <br> <br> Chữ ký của đọc giả <br> <br> <br> <br> <br> <br> <br> </td> <td align="center"> Ngày ____ / ____ / ______<br><br> HIỆU TRƯỞNG <br> <br> <img src="../../../images/chuky/' . $chuky . '" width="130px"> <br> <br> <br> ' . $tenhieutruong . ' </td> </tr> </table> ';
                    $pdf->writeHTMLCell('', '', $left, $top + 2, $html2, 0, 0, 0, true, 'J', true);
                    $left += 96;
                    $leftbc += 96;
                    $setx += 96;
                    $j++;
                    if ($k % 2 == 0) {
                        $top += 65;
                        $topbc += 65;
                        $sety += 65;
                        $setx   = 6;
                        $left   = 3;
                        $leftbc = 36;
                    }
                }
                $pdf->AddPage();
                $left   = 3;
                $top    = 3;
                $leftbc = 36;
                $topbc  = 47;
                $sety   = 21;
                $setx   = 6;
            }
            $idocgia++;
        }
    }
    $pdf->AddPage();
    $left   = 3;
    $top    = 3;
    $leftbc = 36;
    $topbc  = 47;
    $sety   = 21;
    $setx   = 6;
    $conlai = $idocgia % 8;
    for ($yellow = 1; $yellow <= $conlai; $yellow++) {
        $pdf->Image('cmnd.png', $left, $top, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
        $html2 = ' <table width="397px" cellpadding="10" cellspacing="5"> <tr> <td width="150px"> <br> <br> <br> Chữ ký của đọc giả <br> <br> <br> <br> <br> <br> <br> </td> <td align="center"> Ngày ____ / ____ / ______<br><br> HIỆU TRƯỞNG <br> <br> <img src="../../../images/chuky/' . $chuky . '" width="130px"> <br> <br> <br> ' . $tenhieutruong . ' </td> </tr> </table> ';
        $pdf->writeHTMLCell('', '', $left, $top + 2, $html2, 0, 0, 0, true, 'J', true);
        $left += 96;
        $leftbc += 96;
        $setx += 96;
        $j++;
        if ($yellow % 2 == 0) {
            $top += 65;
            $topbc += 65;
            $sety += 65;
            $setx   = 6;
            $left   = 3;
            $leftbc = 36;
        }
    }
    $pdf->Output('barcode_hocsinh.pdf', 'I');
}
if (isset($_POST["inthedocgia_old"])) {
    $madocgia       = $_POST["madocgia"];
    $holotdocgia    = $_POST["holotdocgia"];
    $tendocgia      = $_POST["tendocgia"];
    $ngaysinhdocgia = $_POST["ngaysinhdocgia"];
    $bophan         = $_POST["bophan"];
    $diachi         = $_POST["diachi"];
    $tenhieutruong  = getElement("hieutruong", "ten", "id", countElement0("hieutruong", "id"));
    $chuky          = getElement("hieutruong", "chuky", "id", countElement0("hieutruong", "id"));
    $sql            = "INSERT INTO dshs2013_2014(MAHS,HOLOTHS,TENHS,NGAYSINH,LOP,đc) VALUES('$madocgia','$holotdocgia','$tendocgia','$ngaysinhdocgia','$bophan','$diachi')";
    $rs             = mysql_getQuery($sql);
    $left           = 3;
    $top            = 3;
    $leftbc         = 36;
    $topbc          = 47;
    $sety           = 21;
    $setx           = 6;
    $pdf->setJPEGQuality(10);
    $pdf->Image('cmnd.png', $left, $top, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
    $html2 = ' <table width="500px"> <tr> <td width="45px"><img src="logohs.png" width="40px"></td> <td align="center"><font color="blue">SỞ GIÁO DỤC - ĐÀO TẠO TPHCM<br><font size="10">TRƯỜNG THPT NGUYỄN THỊ MINH KHAI</font></font></td> </tr> </table><hr width="310px"> <table width="397px" align="center" cellpadding="2" cellspacing="0.5"> <tr> <th rowspan="5" width="125px"></th> <td align="center"><h1 style="color:red;">THẺ THƯ VIỆN</h1></td> </tr> <tr> <td align="center"><h2 style="color:blue;">' . $holotdocgia . ' ' . $tendocgia . '</h2></td> </tr> <!--<tr> <td style="color:blue;">Mã số: ' . $madocgia . '</td> </tr>--> <tr> <td style="color:blue;">Ngày sinh: ' . $ngaysinhdocgia . '</td> </tr> <tr> <td style="color:blue;">Địa chỉ trường: 275 ĐBP-P7-Q3</td> </tr> </table> ';
    $pdf->writeHTMLCell('', '', $left, $top + 2, $html2, 0, 0, 0, true, 'J', true);
    $pdf->SetY($sety);
    $pdf->SetX($setx);
    $html = '<table border="1"><tr><td width="113.385826772px" height="151.181102362px">Dán hình ở đây</td></tr></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(2);
    $pdf->write1DBarcode('' . $madocgia . '', 'C93', $leftbc, $topbc, '', 15, 0.37, $style_thehs, 'N');
    $pdf->AddPage();
    $left   = 3;
    $top    = 3;
    $leftbc = 36;
    $topbc  = 47;
    $sety   = 21;
    $setx   = 6;
    $pdf->Image('cmnd.png', $left, $top, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
    $html2 = ' <table width="397px" cellpadding="10" cellspacing="5"> <tr> <td width="150px"> <br> <br> <br> Chữ ký của đọc giả <br> <br> <br> <br> <br> <br> <br>' . $tendocgia . ' </td> <td align="center"> Ngày ____ / ____ / ______<br><br> HIỆU TRƯỞNG <br> <br> <img src="../../../images/chuky/' . $chuky . '" width="130px"> <br> <br> <br> ' . $tenhieutruong . ' </td> </tr> </table> ';
    $pdf->writeHTMLCell('', '', $left, $top + 2, $html2, 0, 0, 0, true, 'J', true);
    $pdf->Output('barcode_hocsinh.pdf', 'I');
}
if (isset($_POST["themdocgia"])) {
    $madocgia       = $_POST["madocgia"];
    $holotdocgia    = $_POST["holotdocgia"];
    $tendocgia      = $_POST["tendocgia"];
    $ngaysinhdocgia = $_POST["ngaysinhdocgia"];
    $bophan         = $_POST["bophan"];
    $diachi         = $_POST["diachi"];
    $ngaynhap       = $_POST["ngaynhapdocgia"];
    $sql            = "INSERT INTO dshs2013_2014(MAHS,HOLOTHS,TENHS,NGAYSINH,LOP,đc,ngaynhap) VALUES('$madocgia','$holotdocgia','$tendocgia','$ngaysinhdocgia','$bophan','$diachi','$ngaynhap')";
    $rs             = mysql_getQuery($sql);
    $page           = '../../../owner.php?act=makebarcode';
    header('Location: ' . $page, true, 303);
}
if (isset($_POST["inmahslop"])) {
    $tenlop        = $_POST["tenlop"];
    $tenhieutruong = getElement("hieutruong", "ten", "id", countElement0("hieutruong", "id"));
    $chuky         = getElement("hieutruong", "chuky", "id", countElement0("hieutruong", "id"));
    $left          = 3;
    $top           = 3;
    $leftbc        = 36;
    $topbc         = 47;
    $sety          = 21;
    $setx          = 6;
    $j             = 0;
    $i             = 0;
    $sql           = "SELECT * FROM dshs2013_2014 where LOP='$tenlop'";
    $rs            = mysql_getQuery($sql);
    while ($row = mysql_fetch_array($rs)) {
        $mahs      = trim($row['MAHS']);
        $tenhs     = $row['HOLOTHS'] . ' ' . $row['TENHS'];
        $ngasinhhs = $row['NGAYSINH'];
        $sdb       = $row['SDB'];
        $pdf->setJPEGQuality(10);
        $pdf->Image('cmnd.png', $left, $top, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
        $html2 = ' <table width="500px"> <tr> <td width="45px"><img src="logohs.png" width="40px"></td> <td align="center"><font color="blue">SỞ GIÁO DỤC - ĐÀO TẠO TPHCM<br><font size="10">TRƯỜNG THPT NGUYỄN THỊ MINH KHAI</font></font></td> </tr> </table><hr width="310px"> <table width="397px" align="center" cellpadding="2" cellspacing="0.5"> <tr> <th rowspan="5" width="125px">SDB ' . $sdb . '</th> <td align="center"><h1 style="color:red;">THẺ HỌC SINH</h1></td> </tr> <tr> <td align="center"><h2 style="color:blue;">' . $tenhs . '</h2></td> </tr> <!--<tr> <td style="color:blue;">Mã số: ' . $mahs . '</td> </tr>--> <tr> <td style="color:blue;">Ngày sinh: ' . $ngasinhhs . '</td> </tr> <tr> <td style="color:blue;">Địa chỉ trường: 275 ĐBP-P7-Q3</td> </tr> </table> ';
        $pdf->writeHTMLCell('', '', $left, $top + 2, $html2, 0, 0, 0, true, 'J', true);
        $pdf->SetY($sety);
        $pdf->SetX($setx);
        $html = '<table border="1"><tr><td width="113.385826772px" height="151.181102362px">Dán hình ở đây</td></tr></table>';
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Ln(2);
        $pdf->write1DBarcode('' . $mahs . '', 'C93', $leftbc, $topbc, '', 15, 0.37, $style_thehs, 'N');
        $left += 96;
        $leftbc += 96;
        $setx += 96;
        $j++;
        if (($j != 0) and ($j % 2 == 0)) {
            $top += 65;
            $topbc += 65;
            $sety += 65;
            $setx   = 6;
            $left   = 3;
            $leftbc = 36;
        }
        if ($j % 8 == 0) {
            $pdf->AddPage();
            $left   = 3;
            $top    = 3;
            $leftbc = 36;
            $topbc  = 47;
            $sety   = 21;
            $setx   = 6;
            for ($k = 1; $k <= 8; $k++) {
                $pdf->Image('cmnd.png', $left, $top, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
                $html2 = ' <table width="397px" cellpadding="10" cellspacing="5"> <tr> <td width="150px"> LỚP:<br> GVCN:<br> --------------------------------<br> LỚP:<br> GVCN:<br> --------------------------------<br> LỚP:<br> GVCN:<br> <br> Chữ ký của học sinh </td> <td align="center"> Ngày ____ / ____ / ______<br><br> HIỆU TRƯỞNG <br> <br> <img src="../../../images/chuky/' . $chuky . '" width="130px"> <br> <br> <br> ' . $tenhieutruong . ' </td> </tr> </table> ';
                $pdf->writeHTMLCell('', '', $left, $top + 2, $html2, 0, 0, 0, true, 'J', true);
                $left += 96;
                $leftbc += 96;
                $setx += 96;
                $j++;
                if ($k % 2 == 0) {
                    $top += 65;
                    $topbc += 65;
                    $sety += 65;
                    $setx   = 6;
                    $left   = 3;
                    $leftbc = 36;
                }
            }
            $pdf->AddPage();
            $left   = 3;
            $top    = 3;
            $leftbc = 36;
            $topbc  = 47;
            $sety   = 21;
            $setx   = 6;
        }
        $i++;
    }
    $pdf->AddPage();
    $left   = 3;
    $top    = 3;
    $leftbc = 36;
    $topbc  = 47;
    $sety   = 21;
    $setx   = 6;
    $conlai = countElement("dshs2013_2014", "MAHS", "LOP", $tenlop) % 8;
    for ($yellow = 1; $yellow <= $conlai; $yellow++) {
        $pdf->Image('cmnd.png', $left, $top, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
        $html2 = ' <table width="397px" cellpadding="10" cellspacing="5"> <tr> <td width="150px"> LỚP:<br> GVCN:<br> --------------------------------<br> LỚP:<br> GVCN:<br> --------------------------------<br> LỚP:<br> GVCN:<br> <br> Chữ ký của học sinh </td> <td align="center"> Ngày ____ / ____ / ______<br><br> HIỆU TRƯỞNG <br> <br> <img src="../../../images/chuky/' . $chuky . '" width="130px"> <br> <br> <br> ' . $tenhieutruong . ' </td> </tr> </table> ';
        $pdf->writeHTMLCell('', '', $left, $top + 2, $html2, 0, 0, 0, true, 'J', true);
        $left += 96;
        $leftbc += 96;
        $setx += 96;
        $j++;
        if ($yellow % 2 == 0) {
            $top += 65;
            $topbc += 65;
            $sety += 65;
            $setx   = 6;
            $left   = 3;
            $leftbc = 36;
        }
    }
    $pdf->Output('barcode_hocsinh.pdf', 'I');
}
if (isset($_POST["taobarcode_hsokkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk"])) {
    $mahs     = $_POST["mahs"];
    $tenhs    = $_POST["tenhs"];
    $diachihs = $_POST["diachihs"];
    $emailhs  = $_POST["emailhs"];
    $sdths    = $_POST["sdths"];
    $nienkhoa = $_POST["nienkhoa"];
    $sql      = "INSERT INTO hocsinh(mahs,hoten,diachi,email,sdt,nienkhoa) VALUES('$mahs','$tenhs','$diachihs','$emailhs','$sdths','$nienkhoa')";
    $pdf->setJPEGQuality(10);
    $pdf->Image('cmnd.png', 3, 13, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
    $html2 = ' <table width="500px"> <tr> <td width="45px"><img src="logohs.png" width="40px"></td> <td align="center"><font color="blue">SỞ GIÁO DỤC - ĐÀO TẠO TPHCM<br><font size="10">TRƯỜNG THPT NGUYỄN THỊ MINH KHAI</font></font></td> </tr> </table><hr width="310px"> <table width="397px" align="center" cellpadding="2" cellspacing="0.5"> <tr> <th rowspan="5" width="125px">SDB ' . $sdb . '</th> <td align="center"><h1 style="color:red;">THẺ HỌC SINH</h1></td> </tr> <tr> <td align="center"><h2 style="color:blue;">' . strtoupper($tenhs) . '</h2></td> </tr> <tr> <td style="color:blue;">Mã số: ' . $mahs . '</td> </tr> <tr> <td style="color:blue;">Ngày sinh: ' . $mahs . '</td> </tr> <tr> <td style="color:blue;">Địa chỉ trường: 275 ĐBP-P7-Q3</td> </tr> </table> ';
    $pdf->writeHTMLCell('', '', 3, 15, $html2, 0, 0, 0, true, 'J', true);
    $pdf->SetY(31);
    $pdf->SetX(6);
    $html = '<table border="1"><tr><td width="113.385826772px" height="151.181102362px">Dán hình ở đây</td></tr></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(2);
    $pdf->write1DBarcode('' . $mahs . '', 'C93', '36', '57', '', 15, 0.37, $style_thehs, 'N');
    $pdf->setJPEGQuality(10);
    $pdf->Image('cmnd.png', 99, 13, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
    $html2 = ' <table width="500px"> <tr> <td width="45px"><img src="logohs.png" width="40px"></td> <td align="center"><font color="blue">SỞ GIÁO DỤC - ĐÀO TẠO TPHCM<br><font size="10">TRƯỜNG THPT NGUYỄN THỊ MINH KHAI</font></font></td> </tr> </table><hr width="310px"> <table width="397px" align="center" cellpadding="2" cellspacing="0.5"> <tr> <th rowspan="5" width="125px">SDB ' . $sdb . '</th> <td align="center"><h1 style="color:red;">THẺ HỌC SINH</h1></td> </tr> <tr> <td align="center"><h2 style="color:blue;">' . strtoupper($tenhs) . '</h2></td> </tr> <tr> <td style="color:blue;">Mã số: ' . $mahs . '</td> </tr> <tr> <td style="color:blue;">Ngày sinh: ' . $mahs . '</td> </tr> <tr> <td style="color:blue;">Địa chỉ trường: 275 ĐBP-P7-Q3</td> </tr> </table> ';
    $pdf->writeHTMLCell('', '', 99, 15, $html2, 0, 0, 0, true, 'J', true);
    $pdf->SetY(31);
    $pdf->SetX(102);
    $html = '<table border="1"><tr><td width="113.385826772px" height="151.181102362px">Dán hình ở đây</td></tr></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(2);
    $pdf->write1DBarcode('' . $mahs . '', 'C93', '132', '57', '', 15, 0.37, $style_thehs, 'N');
    $pdf->Output('barcode_hocsinh.pdf', 'I');
}
if (isset($_POST["taobarcode_hsaaaaaaaa"])) {
    $mahs     = $_POST["mahs"];
    $tenhs    = $_POST["tenhs"];
    $diachihs = $_POST["diachihs"];
    $emailhs  = $_POST["emailhs"];
    $sdths    = $_POST["sdths"];
    $nienkhoa = $_POST["nienkhoa"];
    $sql      = "INSERT INTO hocsinh(mahs,hoten,diachi,email,sdt,nienkhoa) VALUES('$mahs','$tenhs','$diachihs','$emailhs','$sdths','$nienkhoa')";
    $pdf->setJPEGQuality(10);
    $pdf->Image('cmnd.png', 12, 13, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
    $html2 = 'Thư viện Trường trung học phổ thông<br><font size="14">Nguyễn Thị Minh Khai</font>';
    $pdf->writeHTML($html2, true, false, true, false, '');
    $txt = "Họ tên: " . $tenhs . "\n";
    $txt .= "Niên khóa: " . $nienkhoa . "\n";
    $txt .= "Địa chỉ: " . $diachihs . "\n";
    $txt .= "Email: " . $emailhs . "\n";
    $txt .= "Số điện thoại: " . $sdths . "\n";
    $pdf->MultiCell(80, 50, $txt, 0, 'J', false, 1, 50, 30, true, 0, false, true, 0, 'T', false);
    $pdf->SetY(30);
    $html = '<table border="1"><tr><td width="113.385826772px" height="151.181102362px">Dán hình ở đây</td></tr></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(2);
    $pdf->write1DBarcode('' . $mahs . '', 'C93', '50', '55', '', 18, 0.4, $style, 'N');
    $pdf->Output('barcode_hocsinh.pdf', 'I');
}
if (isset($_POST["inmahs_old"])) {
    @$mahs = $_POST["mahs"];
    @$tenhs = getElement(hocsinh, hoten, mahs, $mahs);
    @$diachihs = getElement(hocsinh, diachi, mahs, $mahs);
    @$emailhs = getElement(hocsinh, email, mahs, $mahs);
    @$sdths = getElement(hocsinh, sdt, mahs, $mahs);
    @$nienkhoa = getElement(hocsinh, nienkhoa, mahs, $mahs);
    $pdf->setJPEGQuality(10);
    $pdf->Image('cmnd.png', 12, 13, '', '', 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
    $html2 = 'Thư viện Trường trung học phổ thông<br><font size="14">Nguyễn Thị Minh Khai</font>';
    $pdf->writeHTML($html2, true, false, true, false, '');
    $txt = "Họ tên: " . $tenhs . "\n";
    $txt .= "Niên khóa: " . $nienkhoa . "\n";
    $txt .= "Địa chỉ: " . $diachihs . "\n";
    $txt .= "Email: " . $emailhs . "\n";
    $txt .= "Số điện thoại: " . $sdths . "\n";
    $pdf->MultiCell(80, 50, $txt, 0, 'J', false, 1, 50, 30, true, 0, false, true, 0, 'T', false);
    $pdf->SetY(30);
    $html = '<table border="1"><tr><td width="113.385826772px" height="151.181102362px">Dán hình ở đây</td></tr></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(2);
    $pdf->write1DBarcode('' . $mahs . '', 'C93', '50', '55', '', 18, 0.4, $style, 'N');
    $pdf->Output('barcode_hocsinh.pdf', 'I');
}
?>