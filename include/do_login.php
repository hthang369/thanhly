<?php session_start();?>
<title>đăng nhập</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="5;URL=../index.php" />
<?php
include "../connect.php";
if(isset($_REQUEST["button"]))
{
	if($_REQUEST["button"]=="Đăng Nhập")
	{
		$user=$_REQUEST["txtuser"];
		$pass=md5($_REQUEST["txtpas"]);
		$sql=mysql_query("select * from thanhvien where user='$user'") or die ("loi truy van");
		if(mysql_num_rows($sql)==0)
		{
			echo "<script>alert('Tên truy nhập bị sai. Nhập lại');window.history.go(-1);</script>";
			//header("Location:../index.php");	
		}
		else
		{
			$row=mysql_fetch_array($sql);
			if($pass!==$row["pass"])
			{
				echo "<script>alert('Mật khẩu bị sai. Nhập lại');window.history.go(-1);</script>";
				//header("Location:../index.php");
			}
			else
			{
				if(isset($_POST["chk"]) and $_POST["chk"] == "on"){
					setcookie('user',$user,time()+(60*60*24*15));
					setcookie('pass',$pass,time()+(60*60*24*15));
				}
				//if(isset($_COOKIE['user'], $_COOKIE['pass']))
				$_SESSION["mauser"]=$user;
				$_SESSION["success1"]=true;
						echo "<p align=\"center\">chào bạn $user</p><p align=\"center\">Nếu hệ thống không tự động chuyển về trang chủ trong 5 giây, bạn vui lòng nhấp vào đây <a href=\'../index.php\'>Trở về trang chủ</a></p>";
			}
		}
	}
}
 ?>