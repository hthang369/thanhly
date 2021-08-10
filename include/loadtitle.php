<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

// title sẽ bằng "abc" nếu bạn đang ở trang chủ
$title = 'VNNIT GROUP';
if(isset($_GET['b'])) {
if(!isset($_GET['idbv']) && !isset($_GET['idl']) && !isset($_GET['idsp'])&& !isset($_GET['idtt'])){
	$tmn=$_GET['b'];
// echo $tmn;
// Đang ở chuyên mục
// Bạn kết nối database, lấy cái tên chuyên mục đó ra theo $_GET['cate'] lấy đc trên URL 
$sqt=mysql_query("select * from titlemenu where id='$tmn'") or die ("loi dbtitle 1");
$rot=mysql_fetch_array($sqt);
$title = $rot['tieude'];
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
$title = $rotl['tieude'];
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
$sqtl=mysql_query("select * from loaisanpham where id_loai='$tmn' ") or die ("loi dbtitle 2");
$rotl=mysql_fetch_array($sqtl);
$title = $rotl['tenloai'];
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
$sqtl=mysql_query("select * from sanpham where id_sp='$tmn' ") or die ("loi dbtitle 2");
$rotl=mysql_fetch_array($sqtl);
$title = $rotl['tensp'];
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
$title = $rotl['tieude'];
//echo $title;
}
}
function khongdau($str) { //hàm lọc bỏ dấu tiếng việt cho 1 chuỗi
	$search = array (
		'#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
		'#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
		'#(ì|í|ị|ỉ|ĩ)#',
		'#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
		'#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
		'#(ỳ|ý|ỵ|ỷ|ỹ)#',
		'#(đ)#',
		'#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
		'#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
		'#(Ì|Í|Ị|Ỉ|Ĩ)#',
		'#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
		'#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
		'#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
		'#(Đ)#',
		'#(A-Z)#',
		'/[^a-zA-Z\d]+/',
	);
	$replace = array ('a','e','i','o','u','y','d','A','E','I','O','U','Y','D','a-z',' ');
	$str = preg_replace($search, $replace, $str);
	$str = preg_replace('/ /', '-', trim($str));
	return strtolower($str);
}
function base_url(){
	$site_url=trim(strstr($_SERVER['PHP_SELF'],'index.php',1),'/');
	$site_url=empty($site_url)?'':'/'.$site_url.'/';
	echo 'http://'.$_SERVER['SERVER_NAME'].$site_url;
}
?>
