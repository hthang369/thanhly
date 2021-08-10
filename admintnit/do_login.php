<?php
session_start();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include "../connect.php"; 
if(isset($_REQUEST["act"]))
{
if ($_REQUEST["act"]=="do")
{
	$username = addslashes( $_POST['adname'] );
    $password = md5( addslashes( $_POST['adword'] ) );
	$sql_query = @mysql_query("SELECT * FROM thanhvien WHERE user='{$username}'");
    $member = @mysql_fetch_array( $sql_query );
	if ( @mysql_num_rows( $sql_query ) <= 0 )
    {
        echo "<script>alert('Tên truy nhập bị sai. Nhập lại');window.history.go(-1);</script>";
        exit;
    }
    // Nếu username này tồn tại thì tiếp tục kiểm tra mật khẩu
    if ( $password != $member['pass'] )
    {
        echo "<script>alert('Mật khẩu bị sai. Nhập lại');window.history.go(-1);</script>";
        exit;
    }
    // Khởi động phiên làm việc (session)
    $_SESSION['user_admin'] = $member['user'];
	$_SESSION["success"]=true;
	$_SESSION["capquyen"]=$member["capquyen"];
	if($_SESSION["capquyen"]!=1)
		echo "<script>alert('Tài khoản này không được quyền truy cập trang quản trị');window.location='login.php';</script>";
	else
		header("location:index.php?b=home&m=dsnsp");
    // Thông báo đăng nhập thành công
    //print "Bạn đã đăng nhập với tài khoản {$member['user']} thành công. <a href='index.php'>Nhấp vào đây để vào trang chủ</a>";
	}
}
?>