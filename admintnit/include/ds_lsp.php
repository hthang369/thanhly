<script type="text/javascript">
	function check()
	{
		var thongbao=window.confirm("Bạn có chắc muốn xóa loại sản phẩm này!");
		if(thongbao==true)
			return true;
		else
			return false;
	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="inserttop">Danh sách loại sản phẩm</div>
<div class="insertcen"><table width="100%" cellpadding="0" cellspacing="0">
  <tr class="tr1">
    <td style="border-left:1px solid #333;">mã loại sản phẩm</td>
    <td >Tên loại sản phẩm</td>
    <td >Sửa</td>
    <td >Xóa</td>
  </tr>
<?php 
$now=date('Y-m-d');  
$sql=mysql_query("select * from loaisanpham") or die ("loi db");
while($row=mysql_fetch_array($sql))
{   $mal=$row["id_loai"];
	echo "<tr class=\"tr2\"><td style=\"border-left:1px solid #333;\">$row[id_loai]</td>
	<td>$row[tenloai]</td>
	<td><a href='?b=home&m=uplsp&idl=$mal' >Sửa</a></td>
	<td><a href='include/delete.php?idl=$mal&act=del_lsp' onclick='return check()' >Xóa</a></td></tr>";
}
 ?>
</table>
</div>