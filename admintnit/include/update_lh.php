<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../script/jquery-ui-1.8.9.custom.js"></script>
<script type="text/javascript" src="../../script/jquery-1.6.4.js"></script>

<link href="../styles/jquery-ui-1.8.9.custom.css" type="text/css" rel="stylesheet">

 <script type="text/javascript">
    $(function() {
		$( "#nglh" ).datepicker({
			showOn: "button",
			buttonImage: "../images/calendar.gif",
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd'
		});
	});
	</script> 
<div class="inserttop">Cập nhật thông tin liên hệ</div>
<div class="insertcen">
<?php 
if(isset($_REQUEST["idlh"]))
{
	$ma=$_REQUEST["idlh"];
	$sql=mysql_query("select * from lienhe where id_lienhe='$ma'") or die ("lỗi truy vấn");
	$row=mysql_fetch_array($sql);
	$idlh=$row["id_lienhe"];
	$nd=$row["noidung"];
	$ten=$row["hoten"];
	$mail=$row["email"];
	$dc=$row["diachi"];
	$dt=$row["dienthoai"];
	$nglh=$row["ngaylienhe"];
}
?>
<form name="form1" method="post" action="include/xl_update.php?act=up_lh">
<table width="80%" align="center" cellpadding="0"cellspacing="0">
  <tr>
    <td>Mã liên hệ</td>
    <td>
      <input name="malh" type="text" id="mauser" value="<?php echo $idlh; ?>" size="30" readonly="readonly">
    </td>
  </tr>
  <tr>
    <td>Họ tên</td>
    <td>
      <input name="ten" type="text" id="ten" size="30" value="<?php echo $ten; ?>">
    </td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input name="mail" type="text" id="mail" size="30" value="<?php echo $mail; ?>"></td>
  </tr>
  <tr>
    <td>Địa chỉ</td>
    <td><input name="dchi" type="text" id="dchi" size="30" value="<?php echo $dc; ?>"></td>
  </tr>
  <tr>
    <td>Điện thoại</td>
    <td><input name="dient" type="text" id="dient" size="30" value="<?php echo $dt; ?>"></td>
  </tr>
  <tr>
    <td>Nội dung</td>
    <td><input name="noid" type="text" id="noid" size="30" value="<?php echo $nd; ?>"></td>
  </tr>
  <tr>
    <td>Ngày liên hệ</td>
    <td><input name="nglh" type="text" id="nglh" size="30" value="<?php echo $nglh; ?>">
   </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="gui" class="button" id="gui" value="Cập nhật" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'">
      <input type="reset" name="reset" class="button" id="reset" value="Nhập lại" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'"></td>
    </tr>
</table>
</form>
</div>