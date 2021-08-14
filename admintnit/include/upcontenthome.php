<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../script/jquery-ui-1.8.9.custom.js"></script>
<link href="../styles/jquery-ui-1.8.9.custom.css" rel="stylesheet" type="text/css" /><!--đổi theme màu xám cho lịch-->
<script type="text/javascript">
    $(function() {
		$( "#ngup" ).datepicker({
			showOn: "button",
			buttonImage: "../images/calendar.gif",
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd'
		});
	});
	</script>
<script src="ckeditor/ckeditor.js"></script>    
<?php include "../connect.php";
	$sql=mysql_query("select * from noidunghome") or die ("loi db");
	$row=mysql_fetch_array($sql);
	$ngcn=$row["ngaycapnhat"];
 ?>
 <div class="inserttop">CẬP NHẬT THÔNG TIN TRANG CHỦ</div>
 <div class="insertcen">
  <table align="center" cellpadding="0" cellspacing="0">
  <form action="include/xl_upcontenthome.php" method="post" enctype="multipart/form-data">
    <tr>
    <td>NGÀY CẬP NHẬT</td>
    <td><input name="ngup" type="text" id="ngup" size="30" value="<?php echo $ngcn; ?>"></td>
  </tr>
 
     <tr><td colspan="2">NỘI DUNG:</td></tr>
    <tr>
    <td colspan="2" style="padding-left: 10px">
    <textarea name="noidung" id="noidung"><?php echo stripslashes($row['noidung']); ?></textarea>
    </td>

  <tr>
    <td colspan="2" align="center"><input type="submit" name="sua" class="button" id="sua" value="Cập nhật" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'" />
      <input type="reset" name="xoa" class="button" id="xoa" value="Xóa" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'" /></td>
  </tr>
  </form>
</table>
</div>
<script>
   CKEDITOR.replace('noidung');
</script>