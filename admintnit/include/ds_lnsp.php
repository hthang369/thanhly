<script type="text/javascript">
	function check()
	{
		var thongbao=window.confirm("Bạn có chắc muốn xóa nhóm sp này!");
		if(thongbao==true)
			return true;
		else
			return false;
	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="inserttop">Danh sách sản phẩm theo loại</div>
<div class="insertcen"><table width="100%" cellpadding="0" cellspacing="0">
  <tr class="tr1">
    <td style="border-left:1px solid #333;" width="100px">Tên sản phẩm</td>
    <td width="100">tên loại</td>
    <td width="70">Giá (VNĐ)</td>
    <td width="200px">nội dung</td>
    <td width="150px">hình ảnh</td>
    <td width="50px">Sửa</td>
    <td width="50px">Xóa</td>
  </tr>
<?php 
$idn=$_REQUEST["idn"];
$sql=mysql_query("select * from sanpham where id_loai=$idn") or die("loi truy vấn");
while($row=mysql_fetch_array($sql))
{
$gia=number_format($row["giaban"],0,'','.');
	$masp=$row["id_sp"];
	$mota=(strlen($row["mota"])<=80?$row["mota"]:substr($row["mota"],0,80)."...");
    $idl=$row['id_loai'];
    $sq=mysql_query("select * from loaisanpham where id_loai='$idl'") or die("lỗi truy vấn loại");
    $r1=mysql_fetch_array($sq);
	echo "<tr class=\"tr2\"><td style=\"border-left:1px solid #333;\">$row[tensp]</td>
	<td>$r1[tenloai]</td>
	<td>$gia</td>
	<td>$mota</td>
	<td><img src=\"../images/sanpham/small/$row[hinhanh]\" width=\"145px\" height=\"165px\" /></td>
	<td><a href='?b=home&m=upsp&masp=$masp' >Sửa</a></td>
	<td><a href='include/delete.php?idsp=$masp&act=del_sp' onclick='return check()' >Xóa</a></td></tr>";
}
 ?>
</table>
</div>