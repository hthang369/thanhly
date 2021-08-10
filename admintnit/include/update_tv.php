<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="inserttop">Cập nhật thông tin thành viên</div>
<div class="insertcen">
<?php 
if(isset($_REQUEST["matv"]))
{
	$ma=$_REQUEST["matv"];
	$sql=mysql_query("select * from thanhvien where user='$ma'") or die ("lỗi truy vấn");
	$row=mysql_fetch_array($sql);
	$user=$row["user"];
	$pass=md5($row["pass"]);
	$ten=$row["hoten"];
	$mail=$row["email"];
	$dc=$row["diachi"];
	$dt=$row["dienthoai"];
	$cquyen=$row["capquyen"];
}
?>
<form name="form1" method="post" action="include/xl_update.php?act=up_tv">
<table width="80%" align="center" cellpadding="0"cellspacing="0">
  <tr>
    <td>Tên truy nhập</td>
    <td>
      <input name="mauser" type="text" id="mauser" value="<?php echo $user; ?>" size="30" readonly="readonly">
    </td>
  </tr>
  <tr>
    <td>Pass</td>
    <td>
      <input name="pass" type="password" id="pass" size="30" value="<?php echo $pass; ?>">
    </td>
  </tr>
  <tr>
    <td>Họ tên</td>
    <td><input name="ten" type="text" id="ten" size="30" value="<?php echo $ten; ?>"></td>
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
    <td>Cấp quyền</td>
    <td> <select name="check" style="width:200px"> <?php if($cquyen==0)
	echo "<option value='0' selected='selected'>user</option>
    <option value='1' >admin</option>";
	else
		echo "<option value='0' >user</option>
    <option value='1' selected='selected'>admin</option>";
	 ?>
   </select> </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="gui" class="button" id="gui" value="Cập nhật" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'">
      <input type="reset" name="reset" class="button" id="reset" value="Nhập lại" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'"></td>
    </tr>
</table>
</form>
</div>