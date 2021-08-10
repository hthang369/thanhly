<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="inserttop">Thông tin cá nhân của: <?php if(isset($_SESSION['mauser'])){
	echo $_SESSION["mauser"];} else { echo $_COOKIE['user'];} ?></div>
<div class="insertcen">
<?php 
$ma=(isset($_SESSION['mauser']))?$_SESSION["mauser"]:$_COOKIE['user'];
$sql=mysql_query("select * from thanhvien where user='$ma'") or die("lỗi truy vấn d4");
$row=mysql_fetch_array($sql); ?>
<form name="form1" method="post" action="include/xl_update.php?act=upttcn">
<table width="515px" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="35">Tên đăng nhập</td>
    <td><input name="tendn" type="text" id="tendn" value="<?php echo $_SESSION["mauser"]; ?>" readonly="readonly"></td>
  </tr>
  <tr>
    <td height="35">Họ tên</td>
    <td><input name="hten" type="text" id="hten" value="<?php echo $row["hoten"]; ?>"></td>
  </tr>
  <tr>
    <td height="35">Email</td>
    <td><input name="email" type="text" id="email" value="<?php echo $row["email"]; ?>"></td>
  </tr>
  <tr>
    <td height="35">Địa chỉ</td>
    <td><input name="dchi" type="text" id="dchi" value="<?php echo $row["diachi"]; ?>"></td>
  </tr>
  <tr>
    <td height="35">Điện thoại</td>
    <td><input name="dthoai" type="text" id="dthoai" value="<?php echo $row["dienthoai"]; ?>"></td>
  </tr>
  <tr>
  	<td colspan="2" align="center"><input type="submit" name="gui" id="gui" class="button" value="Cập nhật" onmousemove="style.background='url(images/button-2-o.gif)'" onmouseout="style.background='url(images/button-o.gif)'">
  	  <input type="reset" name="reset" class="button" id="reset" value="Reset" onmousemove="style.background='url(images/button-2-o.gif)'" onmouseout="style.background='url(images/button-o.gif)'"></td>
  </tr>
</table>
</form>
</div>