<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include "../connect.php";
function update_pwad($user)
{
	$pasold=md5($_REQUEST["pwad"]);
	$pasn=md5($_REQUEST["pwnad"]);
	$paxn=md5($_REQUEST["xnpw"]);
	if($pasn!=$paxn)
		echo "<script>alert('Mật khẩu xác nhận không trùng khớp');window.history.go(-1)</script>";
	else
	{
		$check=mysql_query("select pass from thanhvien where user='$user'") or die ("lỗi truy vấn");
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
if($act=="dpwad")
{
	$user=$_REQUEST["userad"];
	update_pwad($user);
}
?>