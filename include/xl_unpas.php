<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include "../connect.php";
if(isset($_REQUEST["act"]) && isset($_REQUEST["gui"]))
{
	if($_REQUEST["gui"]=="Gửi")
	{
		$user=$_REQUEST["user"];
		$sql=mysql_query("select * from thanhvien where user='$user'") or die ("lỗi truy vấn");
		$r=mysql_fetch_array($sql);
		$mail=(isset($_REQUEST['email']))?$_REQUEST['email']:$r["email"];
		$sq=mysql_query("update thanhvien SET  pass = MD5(  '123456' ) where user='$user '") or die ("lỗi cập nhật");
		echo "mat khẩu của bạn đẽ dc seret về mã 123456";
		$to="linh kiện máy tính online";
		$subject="reset mật khẩu";
		$message="Pass của bạn đã được reset lại mặc định là 123456 bạn có thể sử dụng pass này để đổi lại pass của bạn";
		mail($to,$subject,$message,'From:$mail');
		echo "<script>alert('Đã gửi mật khẩu mới tới email của bạn. Bạn hãy kiểm tra lại mail của mình để biết mật khẩu mới.');/*window.history.go(-1);*/</script>";
	}
}?>
