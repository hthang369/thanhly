<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../script/jquery-ui-1.8.9.custom.js"></script>
<script type="text/javascript" src="../../script/jquery-1.6.4.js"></script>
<link href="../styles/jquery-ui-1.8.9.custom.css" type="text/css" rel="stylesheet">

 <script type="text/javascript">
    $(function() {
		$( "#ngbd" ).datepicker({
			showOn: "button",
			buttonImage: "../images/calendar.gif",
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd'
		});
	});
	$(function() {
		$( "#ngkt" ).datepicker({
			showOn: "button",
			buttonImage: "../images/calendar.gif",
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd'
		});
	});
	</script> 
<div class="inserttop">Cập nhật thông tin khuyến mãi</div>
<div class="insertcen">
<?php 
if(isset($_REQUEST["idkm"]))
{
	$ma=$_REQUEST["idkm"];
	$sql=mysql_query("select * from khuyenmai where id_khuyenmai='$ma'") or die ("lỗi truy vấn");
	$row=mysql_fetch_array($sql);
	$idkm=$row["id_khuyenmai"];
	$tt=$row["thongtin"];
	$ngbd=$row["ngaybatdau"];
	$ngkt=$row["ngayketthuc"];
	$triso=$row["trisotrukhuyenmai"];
}
?>
<form name="form1" method="post" action="include/xl_update.php?act=up_km">
<table width="80%" align="center" cellpadding="0"cellspacing="0">
  <tr>
    <td>id khuyến mãi</td>
    <td>
      <input name="makm" type="text" id="mauser" value="<?php echo $idkm; ?>" size="30" readonly="readonly">
    </td>
  </tr>
  <tr>
    <td>Thông tin khuyến mãi</td>
    <td>
      <input name="tt" type="text" id="tt" size="30" value="<?php echo $tt; ?>">
    </td>
  </tr>
  <tr>
    <td>Ngày bắt đầu</td>
    <td><input name="ngbd" type="text" id="ngbd" size="30" value="<?php echo $ngbd; ?>"></td>
  </tr>
  <tr>
    <td>Ngày kết thúc</td>
    <td><input name="ngkt" type="text" id="ngkt" size="30" value="<?php echo $ngkt; ?>"></td>
  </tr>
  <tr><td>Trị số trừ khuyến mãi</td>
  <td><input name="triso" type="text" id="triso" size="30" value="<?php echo $triso; ?>"></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="gui" class="button" id="gui" value="Cập nhật" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'">
      <input type="reset" name="reset" class="button" id="reset" value="Nhập lại" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'"></td>
    </tr>
</table>
</form>
</div>