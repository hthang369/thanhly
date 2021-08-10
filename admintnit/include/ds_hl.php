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
<div class="inserttop">Danh sách hiệu sản phẩm theo loại</div>
<div class="insertcen"><table width="100%" cellpadding="0" cellspacing="0">
  <tr class="tr1">
    <td style="border-left:1px solid #333;">Tên loại sản phẩm</td>
    <td >Tên hiệu sản phẩm</td>
    <td >Sửa</td>
    <td >Xóa</td>
  </tr>
<?php 
$idh=$_REQUEST["idh"];
$sql=mysql_query("select loaisanpham.*,hieu.* from loaisanpham,hieu where loaisanpham.id_loai=hieu.id_loai and hieu.id_loai='$idh'") or die("loi truy vấn");
while($row=mysql_fetch_array($sql))
{$mah=$row["id_hieu"];
	echo "<tr class=\"tr2\"><td style=\"border-left:1px solid #333;\">$row[tenloai]</td>
	<td>$row[tenhieu]</td>
	<td><a href='?b=hsp&m=uphsp&idh=$mah' >Sửa</a></td>
	<td><a href='include/delete.php?idh=$mah&act=del_hsp' onclick='return check()' >Xóa</a></td></tr>";
}
 ?>
</table>
</div>