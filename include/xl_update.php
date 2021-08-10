<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include "../connect.php";
function up_ttcn($iduser)
{
	$ten=$_REQUEST["hten"];
	$mail=$_REQUEST["email"];
	$dchi=$_REQUEST["dchi"];
	$dt=$_REQUEST["dthoai"];
	$sql1=mysql_query("update thanhvien set hoten='$ten',email='$mail',diachi='$dchi',dienthoai='$dt' where user='$iduser'");
	if(!$sql1)
		echo "<script>alert('Có lỗi trong quá trình update!');window.history.go(-1)</script>";
	else
		echo "<script>alert('Đã cập nhật thành công!');window.history.go(-1)</script>";
}

function doi_pw($maus)
{
	$pasold=md5($_REQUEST["pwold"]);
	$pasn=md5($_REQUEST["pwnew"]);
	$paxn=md5($_REQUEST["xnpwnew"]);
	if($pasn!=$paxn)
		echo "<script>alert('Mật khẩu xác nhận không trùng khớp');window.history.go(-1)</script>";
	else{
		$check=mysql_query("select pass from thanhvien where user='$maus'") or die ("lỗi truy vấn");
		$row=(mysql_fetch_array($check));
		if($row["pass"]!=$pasold)
			echo "<script>alert('Mật khẩu cũ không trùng khớp');window.history.go(-1)</script>";
		else
		{
			$sql=mysql_query("update thanhvien set pass='$pasn' where user='$user'");
			if(!$sql)
				echo "<script>alert('Có lỗi trong quá trình xử lý!');window.history.go(-1)</script>";
			else
				echo "<script>alert('Đã cập nhật thành công!');window.history.go(-1)</script>";
		}
	}
}
$act=$_REQUEST["act"];
if($act=="doipw")
{
	$maus=$_REQUEST["tenuser"];
	doi_pw($maus);
}

if($act=="upttcn")
{
	$iduser=$_REQUEST["tendn"];
	up_ttcn($iduser);
}

?>