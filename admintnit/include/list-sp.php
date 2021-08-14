<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td>Tên SP</td>
    <td>Hãng sản xuất</td>
    <td>Giá bán</td>
    <td>Hình ảnh</td>
    <td>Mô tả</td>
    <td>Bảo hành</td>
  </tr>
  <?php include "../connect.php";
   $sql=mysql_query("select * from sanpham") or die ("loi db");
  while($row=mysql_fetch_array($sql))
  {	$hieu=$row["id_hieu"];
	  echo "<tr><td><a href=\"update-sp.php?masp=$row[id_sp]\">$row[tensp]</a></td>";
	$sq=mysql_query("select tenhieu from hieu where id_hieu=$hieu") or die ("loi db");
	while($r=mysql_fetch_array($sq))
	{
		echo "<td>$r[tenhieu]</td>";
	}
		echo "<td>$row[giaban]</td>
			<td><img src=\"../../images/sanpham/small/$row[hinhanh]\"></td>
			<td>$row[mota]</td>
			<td>$row[baohanh] Tháng</td></tr>";
  }?>
</table>

</body>
</html>