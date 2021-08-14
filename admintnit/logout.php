<?php session_start();?>
<title>thoát</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
unset($_SESSION["success"]);
unset($_SESSION["user_admin"]);
header("Location:login.php"); 
?>