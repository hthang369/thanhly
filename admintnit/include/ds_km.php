<script type="text/javascript">
	function check()
	{
		var thongbao=window.confirm("Bạn có chắc muốn xóa thông tin khuyến mãi này!");
		if(thongbao==true)
			return true;
		else
			return false;
	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="inserttop">Danh sách thông tin khuyến mãi</div>
<div class="insertcen"><table width="100%" cellpadding="0" cellspacing="0">
  <tr class="tr1">
  <td style="border-left:1px solid #333;">id khuyến mãi</td>
    <td style="border-left:1px solid #333;">Thông tin khuyếm mãi</td>
    <td >Ngày bắt đầu</td>
    <td >Ngày kết thúc</td>
    <td >Sửa</td>
    <td >Xóa</td>
  </tr>
<?php 
$sql=mysql_query("select * from khuyenmai") or die("loi truy vấn");
while($row=mysql_fetch_array($sql))
{$makm=$row["id_khuyenmai"];
$ttkm=$row["thongtin"];
$nl=$row["ngaybatdau"];
$nkt=$row["ngayketthuc"];
	echo "<tr class=\"tr2\">
	<td style=\"border-left:1px solid #333;\">$row[id_khuyenmai]</td>
	<td style=\"border-left:1px solid #333;\">$row[thongtin]</td>
	<td>$row[ngaybatdau]</td>
	<td>$row[ngayketthuc]</td>
	<td><a href='?b=km&m=upkm&idkm=$makm' >Sửa</a></td>
	<td><a href='include/delete.php?idkm=$makm&act=del_km' onclick='return check()' >Xóa</a></td></tr>";
}
 ?>
</table>
</div>