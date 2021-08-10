<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <?php include "../connect.php";
 $user=$_GET["user"];
 if($user=="administrator"||$user=="admin"||$user=="quantrivien"||$user=="Admin"||$user=="Administrator" ||$user=="thanhnhan"||$user=="thanhtam"||$user=="thanhthai"||$user=="hoangthang")
		echo "Tên đăng nhập: <strong>$user</strong> không được phép đăng ký!";
 else
 {
 	$sql=mysql_query("select user from thanhvien where user='$user'") or die ("loi db");
 	if (mysql_num_rows($sql)!=0) 
		echo "Tên đăng nhập: <strong>$user</strong> này đã có người sử dụng.";
 	else 
		echo "<img src=\"images/true.png\" width=\"16\" height=\"16\" />";
 }
 ?>