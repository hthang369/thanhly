<?php include "../connect.php";
function tensp_exist($tensp)
{
	$rows=mysql_query("select id_sp from sanpham where tensp=\"$tensp\"") or die ("Lỗi db");
	if (mysql_num_rows($rows)>0) return 1;
	return 0;
}
if(isset($_REQUEST["tensp"])==false)
	header("Location: insert.php");
$tensp=$_REQUEST["tensp"];
$gia=$_REQUEST["giasp"];
$loai=$_REQUEST["loaisp"];
$nhom=$_REQUEST["nhomsp"];
$mota=$_REQUEST["motasp"];
$hinh=$_FILES["hinh"]["name"];
?>