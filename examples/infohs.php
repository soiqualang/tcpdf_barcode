﻿<?php
include("../../../functions/mysql.php");
include("../../../functions/libs.php");
include("../../../functions/function.php");
if (isset($_GET["mahs"])) {
    @$mahs = $_GET["mahs"];
    @$tenhs = getElement(dshs2013_2014, HOLOTHS, MAHS, $mahs) . ' ' . getElement(dshs2013_2014, TENHS, MAHS, $mahs);
    @$ngaysinhhs = getElement(dshs2013_2014, NGAYSINH, MAHS, $mahs);
    @$lophs = getElement(dshs2013_2014, LOP, MAHS, $mahs);
    @$diachihs = getElement(dshs2013_2014, đc, MAHS, $mahs);
    echo '<h2>Thông tin đọc giả</h2> <form method="post" name="frmbarcode_hs" action="" enctype="multipart/form-data" style="margin:15px auto auto 0;"> <table width="100%"> <tr><td width="20%">Mã độc giả</td><td><input name="mahs" type="text" disabled placeholder="Nhập mã độc giả" size="30px" value="' . $mahs . '"/><br></td></tr> <tr><td width="20%">Tên hiển thị</td><td><input name="tenhs" type="text" disabled placeholder="Nhập tên hiển thị" size="30px" value="' . $tenhs . '"/><br></td></tr> <tr><td width="20%">Ngày sinh</td><td><input name="ngaysinhhs" id="ngaysinhhs" type="text" placeholder="Nhập ngày sinh học sinh" size="30px" value="' . $ngaysinhhs . '"/><br></td></tr> <tr><td width="20%">Lớp/Bộ phận</td><td><input name="lophs" type="text" placeholder="Lớp/Bộ phận" size="30px" value="' . $lophs . '"/><br></td></tr> <tr><td width="20%">Địa chỉ</td><td><input name="diachihs" type="text" placeholder="Nhập địa chỉ nhà học sinh" size="70px" value="' . $diachihs . '"/><br></td></tr> </table> <input name="btsuahs" type="submit" value="Sửa thông tin học sinh"/> </form> <h2>Các sách đang mượn</h2>';
    $a = table_to_array_2dk("muonsach", "mahs", $mahs, "datra", 0);
    for ($i = 0; $i < count($a); $i++) {
        @$tendausach = getElement(dausach, tendausach, masach, $a[$i]['masach']);
        @$iddausach = getElement(dausach, id, masach, $a[$i]['masach']);
        echo $i . '/ <a href="ree.php?act=view&id=' . $iddausach . '" target="_blank">' . $tendausach . '</a><br>';
    }
}
if (isset($_POST["btsuahs"])) {
    $lophs      = $_POST["lophs"];
    $ngaysinhhs = $_POST["ngaysinhhs"];
    $diachihs   = $_POST["diachihs"];
    @$sql = "UPDATE dshs2013_2014 SET LOP='$lophs',NGAYSINH='$ngaysinhhs',đc='$diachihs' WHERE MAHS='$mahs'";
    $rs = mysql_getQuery($sql);
    if (!$rs)
        die(mysql_error());
    else {
        echo "Đã cập nhật thành công";
    }
}
?>