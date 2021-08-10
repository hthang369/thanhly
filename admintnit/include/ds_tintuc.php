<script type="text/javascript">
	function check()
	{
		var thongbao=window.confirm("Bạn có chắc muốn xóa tin này không?");
		if(thongbao==true)
			return true;
		else
			return false;
	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="inserttop">Danh sách tin tức</div>
<div class="insertcen"><table widht="100%" cellpadding="0" cellspacing="0" border="1">
  <tr class="tr1">
  <td style="border-left:1px solid #333; width:40px;">id tin</td>
    <td width="350">nội dung</td>
    <td width="120">Ngày cập nhật</td>
	<td width="150" >tiêu đề</td>
    <td width="150" >ghi chú</td>
    <td width="40" >Sửa</td>
    <td width="40" >Xóa</td>
  </tr>
<?php 
$sql=mysql_query("select * from tintuc") or die("loi truy vấn");
while($row=mysql_fetch_array($sql))
{$matt=$row["id_tintuc"];
	echo "<tr class=\"tr2\">
	<td style=\"border-left:1px solid #333;\">$row[id_tintuc]</td>
	<td style=\"border-left:1px solid #333; overflow:scroll; display:block; height:200px; width:400px;\">$row[noidung]</td>
	<td>$row[ngay_up]</td>
	<td>$row[tieude]</td>
	<td>$row[ghichu]</td>
	<td><a href='?b=tintuc&m=up_tt&idtt=$matt'>Sửa</a></td>
	<td><a href='include/delete.php?idtt=$matt&act=del_tt' onclick='return check()'>Xóa</a></td></tr>";
}
 ?>
</table>
</div>