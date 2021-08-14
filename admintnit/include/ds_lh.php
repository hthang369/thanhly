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
<div class="inserttop">Danh sách thông tin liên hệ</div>
<div class="insertcen">
<form id="form1" name="form1" method="post" action="">
<table width="100%" cellspacing="0" cellpadding="0">
  <tr class="tr1">
    <td style="border-left:1px solid #333;">Họ tên</td>
    <td>Email</td>
    <td>Điện thoại</td>
    <td>Địa chỉ</td>
    <td>Nội dung</td>
    <td>Ngày liên hệ</td>
    <td>Sửa</td>
    <td>Xóa</td>
  </tr>
  <?php 
  $sql=mysql_query("select * from lienhe") or die ("lỗi truy vấn");
  while($row=mysql_fetch_array($sql))
  {
	  $idlh=$row["id_lienhe"];
	  ?>
	 <tr class="tr2">
    <td style="border-left:1px solid #333;"><?php echo $row["hoten"]?></td>
    <td><?php echo $row["email"]?></td>
    <td><?php echo $row["dienthoai"]?></td>
    <td><?php echo $row["diachi"]?></td>
    <td><?php echo $row["noidung"]?></td>
    <td><?php echo $row["ngaylienhe"]?></td>
	<td><a href="?m=uplh&idlh=<?php echo $idlh ?>" >Sửa</a></td>
	<td><a href="include/delete.php?idlh=<?php echo $idlh ?>&act=del_lh" onclick="return check()">Xóa</a></td>
  </tr>
  <?php	  
  }
	?>
</table>
</form>
</div>