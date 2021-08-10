<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../script/jquery-ui-1.8.9.custom.js"></script>
<script type="text/javascript" src="../../script/jquery-1.6.4.js"></script>
<link href="../styles/jquery-ui-1.8.9.custom.css" type="text/css" rel="stylesheet">

 <script type="text/javascript">
    $(function() {
		$( "#ngcn" ).datepicker({
			showOn: "button",
			buttonImage: "../images/calendar.gif",
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd'
		});
	});

	</script> 
<div class="inserttop">Cập nhật tin tức</div>
<div class="insertcen">
<?php 
if(isset($_REQUEST["idtt"]))
{
	$mat=$_REQUEST["idtt"];
	$sql=mysql_query("select * from tintuc where id_tintuc='$mat'") or die ("lỗi truy vấn");
	$row=mysql_fetch_array($sql);
	$idtt=$row["id_tintuc"];
	$ndt=$row["noidung"];
	$ngcn=$row["ngay_up"];
	$td=$row["tieude"];
	$gc=$row["ghichu"];
}
?>
<form name="form1" method="post" action="include/xl_update.php?act=up_tt">
<table width="80%" align="center" cellpadding="0"cellspacing="0">
  <tr>
    <td>id tin tức</td>
    <td>
      <input name="matt" type="text" id="mauser" value="<?php echo $idtt; ?>" size="30" readonly="readonly">
    </td>
  </tr>
    <tr><td colspan="2">Nội dung:</td></tr>
    <tr>
    <td colspan="2" style="padding-left: 10px">
    <?php
	include("fckeditor/fckeditor.php") ;
	$oFCKeditor = new FCKeditor('ndt') ;
	$sValue = stripslashes($row['noidung']);
	$oFCKeditor->BasePath = '../admintnit/fckeditor/' ;
	$oFCKeditor->Value = $sValue ;
	$oFCKeditor->Create() ;
	?>
    </td>
  </tr>
  <tr>
    <td>Ngày cập nhật</td>
    <td><input name="ngcn" type="text" id="ngcn" size="30" value="<?php echo $ngcn; ?>"></td>
  </tr>
  <tr>
    <td>Tiêu đề</td>
    <td><input name="td" type="text" id="td" size="30" value="<?php echo $td; ?>"></td>
  </tr>
  <tr><td>Ghi chú</td>
  <td><input name="gc" type="text" id="gc" size="30" value="<?php echo $gc; ?>"></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="gui" class="button" id="gui" value="Cập nhật" onMouseMove="style.background='url(../images/button-2-o.gif)'" onMouseOut="style.background='url(../images/button-o.gif)'">
      <input type="reset" name="reset" class="button" id="reset" value="Nhập lại" onMouseMove="style.background='url(../images/button-2-o.gif)'" onMouseOut="style.background='url(../images/button-o.gif)'"></td>
    </tr>
</table>
</form>
</div>