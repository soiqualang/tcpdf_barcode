﻿<?php
include("../../../functions/mysql.php");
include("../../../functions/libs.php");
if (isset($_GET["mahs"])) {
    @$mahs = $_GET["mahs"];
    @$tenhs = getElement(hocsinh, hoten, mahs, $mahs);
    @$diachihs = getElement(hocsinh, diachi, mahs, $mahs);
    @$emailhs = getElement(hocsinh, email, mahs, $mahs);
    @$sdths = getElement(hocsinh, sdt, mahs, $mahs);
    @$nienkhoa = getElement(hocsinh, nienkhoa, mahs, $mahs);
    echo '<form method="post" name="frmbarcode_hs" action="" enctype="multipart/form-data" style="margin:15px auto auto 0;"> <table width="100%"> <tr><td width="20%">Mã học sinh</td><td><input name="mahs" type="text" placeholder="Nhập mã học sinh" size="30px" value="' . $mahs . '"/><br></td></tr> <tr><td width="20%">Tên học sinh</td><td><input name="tenhs" type="text" placeholder="Nhập tên học sinh" size="30px" value="' . $tenhs . '"/><br></td></tr> <tr><td width="20%">Niên khóa</td><td><input name="nienkhoa" type="text" placeholder="Nhập niên khóa" size="30px" value="' . $nienkhoa . '"/><br></td></tr> <tr><td width="20%">Địa chỉ</td><td><input name="diachihs" type="text" placeholder="Nhập địa chỉ nhà học sinh" size="30px" value="' . $diachihs . '"/><br></td></tr> <tr><td width="20%">Email</td><td><input name="emailhs" type="text" placeholder="Nhập email học sinh" size="30px" value="' . $emailhs . '"/><br></td></tr> <tr><td width="20%">Số điện thoại</td><td><input name="sdths" type="text" placeholder="Nhập số điện thoại học sinh" size="30px" value="' . $sdths . '"/><br></td></tr> </table> <input name="btsuahs" type="submit" value="Sửa thông tin học sinh"/> </form>';
}
if (isset($_POST["btsuahs"])) {
    @$mahsu = $_POST["mahs"];
    @$tenhsu = $_POST["tenhs"];
    @$diachihsu = $_POST["diachihs"];
    @$emailhsu = $_POST["emailhs"];
    @$sdthsu = $_POST["sdths"];
    @$nienkhoau = $_POST["nienkhoa"];
    @$sql = "UPDATE hocsinh SET mahs='$mahsu',hoten='$tenhsu',diachi='$diachihsu',email='$emailhsu',sdt='$sdthsu',nienkhoa='$nienkhoau' WHERE mahs=$mahsu";
    $rs = mysql_getQuery($sql);
    if (!$rs)
        die(mysql_error());
    else {
        echo "Đã cập nhật thành công";
    }
}
?>