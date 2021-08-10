<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include "../connect.php";
if(isset($_REQUEST["act"]) && isset($_REQUEST["dangky"]))
{
	if($_REQUEST["dangky"]=="Đăng ký")
	{
		$user=$_REQUEST["user"];
		$pass=md5($_REQUEST["pass"]);
		$mail=$_REQUEST["nmEmailAdd"];
		$hoten=$_REQUEST["nmFullName"];
		$dt=$_REQUEST["nmNumber"];
		$dc=$_REQUEST["nmAddress"];
		$maxn=$_REQUEST["maxn"];
		$chk=$_REQUEST["nmAgreePolicy"];
		session_start();
		if($maxn==$_SESSION['code'])
		{
			$sql="insert into thanhvien(user, pass, hoten, email, diachi, dienthoai, capquyen) value ('$user', '$pass', '$hoten', '$mail', '$dc', '$dt', '0')";
			$kp=mysql_query($sql);
			if(!$kp)
				echo "<script>alert('Có lỗi xảy ra trong quá trình xử lý');window.history.go(-1);</script>";
			else
				echo "<script>alert('Bạn đã đăng ký thành công với tài khoản $user! Bạn sẽ được trở về trang chủ');</script>";
				header("Location:../index.php");
		}
		else
			echo "<script>alert('Mã xác nhận ko đúng');window.history.go(-1);</script>";
	}
}   
 ?>
