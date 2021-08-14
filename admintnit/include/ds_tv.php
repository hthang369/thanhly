<script type="text/javascript">
	function check()
	{
		var thongbao=window.confirm("Bạn có chắc muốn xóa thông tin liên hệ này!");
		if(thongbao==true)
			return true;
		else
			return false;
	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="inserttop">Danh sách thành viên</div>
<div class="insertcen">
  <table width="100%" cellspacing="0" cellpadding="0">
    <tr class="tr1">
      <td style="border-left:1px solid #333;">Tên truy nhập</td>
      <td>Họ tên</td>
      <td>Email</td>
      <td>Địa chỉ</td>
      <td>Điện thoại</td>
      <td>Cấp quyền</td>
      <td>Sửa</td>
      <td>Xóa</td>
    </tr>
    <?php 
	$sql=mysql_query("select * from thanhvien") or die ("lỗi truy vấn");
	while($row=mysql_fetch_array($sql))
	{$ma=$row["user"];
		echo "<tr class='tr2'>
			  <td style=\"border-left:1px solid #333;\">$row[user]</td>
			  <td>$row[hoten]</td>
			  <td>$row[email]</td>
			  <td>$row[diachi]</td>
			  <td>$row[dienthoai]</td>
			  <td>$row[capquyen]</td>
			  <td><a href=\"?m=uptv&matv=$ma\">Sửa</a></td>
			  <td><a href='include/delete.php?idtv=$ma&act=del_tv' onclick='return check()'>Xóa</a></td>
			</tr>";
	}?>
  </table>
</div>