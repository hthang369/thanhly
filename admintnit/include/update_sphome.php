<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../script/jquery-ui-1.8.9.custom.js"></script>
<link href="../styles/jquery-ui-1.8.9.custom.css" rel="stylesheet" type="text/css" /><!--đổi theme màu xám cho lịch-->
<script type="text/javascript">
    $(function() {
		$( "#ngayup" ).datepicker({
			showOn: "button",
			buttonImage: "../images/calendar.gif",
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd'
		});
	});
	</script>
<?php include "../connect.php";
if(isset($_REQUEST["masphome"]))
{
	$ma=$_REQUEST["masphome"];
	$sql=mysql_query("select * from baiviet where id_baiviet='$ma'") or die ("loi db");
	$row=mysql_fetch_array($sql);
	$masp=$row[0];
	$tensp=$row["tieude"];
	$mota=$row["noidung"];
	$gc=$row["ghichu"];
    $uimg=$row["urlimage"];
	}
 ?>
 <div class="inserttop">Cập nhật thông tin bài viết</div>
 <div class="insertcen">
  <table width="80%" align="center" cellpadding="0" cellspacing="0">
  <form action="include/xl_update.php?act=up_sphome" method="post" enctype="multipart/form-data">
  <tr>
    <td width="170">Id bài viết</td>
    <td><input name="mssp" type="text" value="<?php echo $masp; ?>" size="30" readonly="readonly"/></td>
  </tr>
  <tr>
    <td>Tiêu đề</td>
    <td><input name="tsp" type="text" value="<?php echo $tensp; ?>" size="30"/></td>
  </tr>
   <tr><td colspan="2">Nội dung:</td></tr>
    <tr>
    <td colspan="2" style="padding-left: 10px">
    <?php
	include("fckeditor/fckeditor.php") ;
	$oFCKeditor = new FCKeditor('mota') ;
	$sValue = stripslashes($mota);
	$oFCKeditor->BasePath = '../admintnit/fckeditor/' ;
	$oFCKeditor->Value = $sValue;
	$oFCKeditor->Create() ;
	?>
    </td>
  </tr>
  <tr>
    <td>Ghi chú</td>
    <td><input name="gc" type="text" value="<?php echo $gc; ?>" size="120"/></td>
  </tr>
 <tr>
    <td>URL IMAGE</td>
    <td><input name="uimg" type="text" value="<?php echo $uimg; ?>" size="90"/></td>
  </tr>
   <tr>
    <td colspan="2" align="center"><input type="submit" name="sua" class="button" id="sua" value="Cập nhật" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'" />
      <input type="reset" name="xoa" class="button" id="xoa" value="Xóa" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'" /></td>
  </tr>
  </form>
</table>
</div>