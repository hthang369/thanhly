<script type="text/javascript">
	function check()
	{
		var thongbao=window.confirm("Bạn có chắc muốn xóa sp này!");
		if(thongbao==true)
			return true;
		else
			return false;
	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
$size=20;
$dem=mysql_query("select count(*) from sanpham") or die ("lỗi truy vấn");
$r=mysql_fetch_array($dem);
$num=$r[0];
$count=ceil($num/$size);
if (!isset($_GET["curr"]))
	$curr=1;
else
	$curr=$_GET["curr"];
$p=($curr-1)*$size; ?>
<div class="inserttop">Danh sách sản phẩm</div>
<div class="insertcen"><table cellpadding="0" cellspacing="0" border="1">
  <tr class="tr1">
    <td style="border-left:1px solid #333;" width="140px">Tên sản phẩm</td>
    <td width="70px">Loại sản phẩm</td>
    <td width="100">Giá (VNĐ)</td>
    <td width="250px">hình ảnh</td>
    <td width="70px">khuyến mãi</td>
    <td width="50px">Sửa</td>
    <td width="50px">Xóa</td>
  </tr>
<?php $now=date('Y-m-d');
$sql=mysql_query("select * from sanpham limit $p,$size") or die("loi truy vấn");
while($row=mysql_fetch_array($sql))
{
	$km=$row['id_khuyenmai'];
	$gia=number_format($row["giaban"],0,'','.');
	$masp=$row["id_sp"];
    $ten=$row['tensp'];
    $loai=
	$mota=(strlen($row["mota"])<=80?$row["mota"]:substr($row["mota"],0,80)."...");
	
    $idl=$row['id_loai'];
    $sq=mysql_query("select * from loaisanpham where id_loai='$idl'") or die("lỗi truy vấn loại");
    $r1=mysql_fetch_array($sq);
	echo "<tr class=\"tr2\">
    <td style=\"border-left:1px solid #333;\">$ten</td>
	<td>$r1[tenloai]</td>
	<td>$gia</td>
	<td><img src=\"../images/sanpham/small/$row[hinhanh]\" width=\"145px\" height=\"165px\" /></td>
	<td>$km</td>
	<td><a href='?b=sp&m=upsp&masp=$masp' >Sửa</a></td>
	<td><a href='include/delete.php?idsp=$masp&act=del_sp' onclick='return check()' >Xóa</a></td></tr>";
}
 ?>
</table>
</div>
<hr />
<?php  
if($count>1)
{echo "<div class=pagination><b>Chọn trang: ";
	for ($i=1;$i<=$count;$i++)
	{
		if($curr==$i)
			echo "<span class='current'>$i</span>";
		else
			echo "<span class='curr'><a href=\"index.php?b=sp&amp;m=dssp&curr=$i\">$i</a>&nbsp;&nbsp;</span>";
	}
		
	echo "</div>";
}?>