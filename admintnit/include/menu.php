<?php $b= isset($_REQUEST["b"])?$_REQUEST["b"]:"";
if(isset($b))
{
	switch($b)
	{
		case "home":
			include "include/left-menu.php";
		break;
		case "sp":
			include "include/sp-left.php";
		break;
		case "ttcnad":
			include "include/admin_left.php";
		break;
		case "sphome":
			include "include/menusanphamhome.php";
		break;
		case "sphome":
			include "include/menusanphamhome.php";
		break;
		case "km":
			include "include/km_left.php";
		break;
		case "hd":
			include "include/hd_left.php";
			break;
		case "tintuc":
			include "include/tintuc_left.php";
		break;	
	}
}?>