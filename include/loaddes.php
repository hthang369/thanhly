<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

// title sẽ bằng "abc" nếu bạn đang ở trang chủ
$des = 'sửa máy tính chuyên nghiệp, cài đặt sửa máy tính laptop với giá cả hợp lý, tư vấn lắp máy văn phòng gaming, mua bán linh kiện máy tính - hotline: 0976112209';
if(isset($_GET['b'])) {
if(!isset($_GET['idbv']) && !isset($_GET['idl']) && !isset($_GET['idsp'])&& !isset($_GET['idtt'])){
	$tmn=$_GET['b'];
// echo $tmn;
// Đang ở chuyên mục
// Bạn kết nối database, lấy cái tên chuyên mục đó ra theo $_GET['cate'] lấy đc trên URL 
//$sqt=mysql_query("select * from titlemenu where id='$tmn'") or die ("loi dbtitle 1");
//$rot=mysql_fetch_array($sqt);
$des = 'sửa máy tính chuyên nghiệp, cài đặt sửa máy tính laptop giá cả hợp lý, tư vấn lắp ráp máy vi tính theo yêu cầu, thanh lý máy văn phòng - hotline: 0976112209';
//echo $title;
} 
elseif(isset($_GET['idbv'])) {
	$idx=$_REQUEST["idbv"];
	$idbv1 = explode('-',$idx);
	$tmn=end($idbv1);
	//echo $tmn;
// Đang ở bài viết
// Bạn kết nối database, lấy cái tên bài viết đó ra theo $_GET['id'] lấy đc trên URL
$sqtl=mysql_query("select * from baiviet where id_baiviet='$tmn' ") or die ("loi dbtitle 2");

$rotl=mysql_fetch_array($sqtl);
$des = $rotl['ghichu'];
//echo $title;
}
elseif(isset($_GET['idl'])) {
	$idx=$_REQUEST["idl"];
	$idl1 = explode('-',$idx);
	$tmn=end($idl1);
//	echo $tmn;
	//echo $tmn;
// Đang ở bài viết
// Bạn kết nối database, lấy cái tên bài viết đó ra theo $_GET['id'] lấy đc trên URL
//$sqtl=mysql_query("select * from loaisanpham where id_loai='$tmn' ") or die ("loi dbtitle 2");
//$rotl=mysql_fetch_array($sqtl);
$des = 'sửa máy tính tận nhà chuyên nghiệp, cài đặt sửa máy tính laptop tận nơi với giá cả hợp lý, tư vấn lắp ráp máy vi tính theo yêu cầu, nhận bảo trì máy vi tính laptop công ty văn phòng.';
 //echo $title;
}
elseif(isset($_GET['idsp'])) {
	$idx=$_REQUEST["idsp"];
	$idsp1 = explode('-',$idx);
	$tmn=end($idsp1);
	//echo $tmn;
	//echo $tmn;
// Đang ở bài viết
// Bạn kết nối database, lấy cái tên bài viết đó ra theo $_GET['id'] lấy đc trên URL
//$sqtl=mysql_query("select * from sanpham where id_sp='$tmn' ") or die ("loi dbtitle 2");
//$rotl=mysql_fetch_array($sqtl);
$des = 'sửa máy tính tận nhà chuyên nghiệp, cài đặt sửa máy tính laptop tận nơi với giá cả hợp lý, tư vấn lắp ráp máy vi tính theo yêu cầu, nhận bảo trì máy vi tính laptop công ty văn phòng.';
 //echo $title;
}
elseif(isset($_GET['idtt'])) {
	$idx=$_REQUEST["idtt"];
	$idtt1 = explode('-',$idx);
	$tmn=end($idtt1);
	//echo $tmn;
// Đang ở bài viết
// Bạn kết nối database, lấy cái tên bài viết đó ra theo $_GET['id'] lấy đc trên URL
$sqtl=mysql_query("select * from tintuc where id_tintuc='$tmn' ") or die ("loi dbtitle 2");

$rotl=mysql_fetch_array($sqtl);
$des = $rotl['ghichu'];
//echo $title;
}
}

?>
