<?php include "../connect.php";
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION["success"]))
{
	header("location:login.php");
	exit;	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>xin chào admin của suamaytinhvnn.com</title>
<link href="../styles/style-admin.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="../script/jquery-1.6.4.js"></script>
<link href="../styles/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
</head>

<body style="background:#ececec">
<div id="iContainer">
<div id="iHeader"></div>
<div id="admin">Xin chào:&nbsp;&nbsp;<?php
	echo $_SESSION["user_admin"];
	?> &nbsp;&nbsp;&nbsp;<span class="b"><a href="logout.php">Thoát</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?b=ttcnad&m=dpw">Đổi mật khẩu</a></span></div>
<div id="iTopmenu"> <?php include "include/top-menu.php"; ?> </div>
<div id="iLeftmenu"> <?php include "include/menu.php"; ?> </div>
<div id="iContent"> <?php include "include/menu-giua.php";
?> </div>
<div id="iFooter"></div>
</div>
</body>
</html>
