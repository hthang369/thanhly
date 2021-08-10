<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include "../connect.php";
if(isset($_REQUEST["gui"]))
{
	if($_REQUEST['ht']=="" || $_REQUEST['dt']=="" || $_REQUEST['ema']=="" ||$_REQUEST['nd']=="")
echo "<script>alert('Xin vui lòng nhập lại đầy đủ thông tin dữ liệu !');window.history.go(-1);</script>";
	else{
	$ten=$_REQUEST["ht"];
	$diachi=$_REQUEST["dc"];
	$dt=$_REQUEST["dt"];
	$email=$_REQUEST["ema"];
	$nd=$_REQUEST["nd"];
	$now=date("Y-m-d H:i:s");
	if(isset($_REQUEST['gt1']))
	 {
	  $gt='nam';
	 }
    else if(isset($_REQUEST['gt0']))
	{
	 $gt='nữ';
    }
	$sql=mysql_query("insert into lienhe values (NULL,'$ten','$email','$dt','$diachi','$nd','$now','$gt')");

	if(!$sql)
		echo "<script>alert('Lỗi truy vấn! Nhập lại!');window.history.go(-1);</script>";
	else ?>	
		<meta http-equiv='refresh' content='10;URL=../index.php'>
		<div align="center" style="width:960px; margin:10 auto; border:1px solid #999;"><div style="background-color:#CCC; height:20px;"></div><div style="border:1px solid #999;">Cám ơn quý khách đã liên hệ với chúng tôi! Nội dung của quý khách đã được gửi tới ban quản trị. Quý khách sẽ trở về trang chủ sau 10 giây<br>Nếu trang không tự động chuyển về xin bạn nhấp vào đây <a href='../index.php'>Trở về trang chủ</a></div>
	<?php 
	}
}
?>
<?php 
include('class.smtp.php');
include 'class.phpmailer.php';
if(isset($_POST['gui'])){
	global $error;
	$subject=$_POST['dt'];// tiêu đề mail
	$body=$_POST['nd'];// nội dung mail
	$from='info@suamaytinhvnn.com'; // địa chỉ mail gửi đi
	$from_name=$_POST['ema'];
	//$from_name='$email'; tên mail gửi đi
	// $to=$_POST['email']; địa chỉ mail được gửi đến
	 $to="tn.songvuisongtot@gmail.com"; //địa chỉ mail được gửi đến
	 $mail = new PHPMailer();  // create a new object
	 $mail->IsSMTP(); // enable SMTP
	 $mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
	 $mail->SMTPAuth = true;  // authentication enabled
	 $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
	 $mail->Host= "smtp.hostinger.vn";     // Thiết lập thông tin của SMPT
	 $mail->Port= 587;    
	 $mail->Username = 'info@suamaytinhvnn.com';//tai khoan gmail de ho tro gui mail user 
	 $mail->Password = 'uUjTV$s&';           //mat khau cua tai khoan gmail dat pá mail de làm mail gốc đe mà gui đi
	 $mail->SetFrom($from, $from_name);
	 $mail->Subject = $subject;
	 $mail->Body = $body;
	 $mail->AddAddress($to);
	 $mail->CharSet="utf-8";
	 $mail->IsHTML(true);
	 if(!$mail->Send()) {
		echo $error = 'Mail error: '.$mail->ErrorInfo; 
		 return false;
	 } else {
		echo $error = 'Đã gửi mật khẩu';
		 return true;
	 }
}
?>