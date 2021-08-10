<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<table width="560" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="40" style="border-bottom:1px solid #333; background:url(../images/toplist-content.gif) repeat-x; padding-bottom:5px; font-weight:bold">
    <a href="index.php"><img src="../images/Home.gif" width="16" height="16" border="0"></a>
    <img src="images/towred1-r.gif" width="16" height="9">
    <a href="?b=nsp&idn="></a>        
    </td>
  </tr>
</table>
<div id="show">
<?php
include "../connect.php";
$sql=mysql_query("select * from loaisanpham") or die ("loi db");
$row=mysql_fetch_array($sql);
$idloai=$row["id_loai"];
$tenloai=$row["tenloai"]; 
echo $tenloai;
$sq=mysql_query("select * from sanpham where id_loai=$idloai") or die ("loi db");
while($r1=mysql_fetch_array($sq))
{
echo $r1["tensp"];
}
?>
</div>