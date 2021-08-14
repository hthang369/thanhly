<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
    include "../../connect.php";
    $ndt = isset($_REQUEST["noidung"])?addslashes($_REQUEST["noidung"]):"";
	$ngcn = isset($_REQUEST["ngup"])?$_REQUEST["ngup"]:"";
	
$sqlch="update noidunghome set ngaycapnhat='$ngcn', noidung='$ndt'";
print_r($sqlch);
 $sqlttc=mysql_query($sqlch);
		if(!$sqlttc)
		echo "<script>alert('13.Có lỗi trong lúc update!');window.history.go(-2);</script>";
	else
	{
		$n=mysql_affected_rows($sqlttc);
		echo "<script>alert('14.Đã update thành công $n tin tức!');window.history.go(-1);</script>";
	}

?>