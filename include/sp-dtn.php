<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php include "../connect.php"; ?>
    <?php $sql=mysql_query("select * from sanpham limit 0, 3") or die ("loi db");
	$sq=mysql_query("select count(*) from sanpham") or die ("loi db");
	$S="<table width=\"100%\" border=\"1\">";
	while($row=mysql_fetch_array($sql))
	{
        $S.="<tr><td><img src=\"../images/sanpham/$row[hinhanh]\"</td></tr>";
		$S.="<tr><td>$row[tensp]</td></tr>";
		$S.="<tr><td>$row[giaban] USD</td></tr>";
	}
	$S.="</table>";
	//$r=mysql_fetch_array($sq);
	//for($i=0;$i>=$r[0];$i++)
		//echo "<table width=\"100%\" border=\"1\" cellpadding=\"5\"><tr><td>".$S."</td></tr></table>";
		echo $S;
	?>
</body>
</html>