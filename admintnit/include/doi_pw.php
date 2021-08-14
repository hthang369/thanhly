<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	function kt_pw()
	{
		if(document.getElementById("pwnad").value!=document.getElementById("xnpw").value)
			alert("Mật khẩu xác nhận ko trùng mật khẩu vừa nhập");
	}
</script>
<div class="inserttop">Đổi mật khẩu</div>
<div class="insertcen">
<form name="form1" method="post" action="include/xl_doipw.php?act=dpwad">
  <table width="80%" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>Tên truy nhập</td>
      <td><input name="userad" type="text" id="userad" value="<?php echo $_SESSION["user_admin"]; ?>" size="30" readonly="readonly" /></td>
    </tr>
    <tr>
      <td>Mật khẩu cũ</td>
      <td><span id="sprypassword1">
      <input type="password" name="pwad" id="pwad" size="30" />
      <span class="passwordRequiredMsg">Bạn chưa nhập password cũ.</span><span class="passwordMinCharsMsg">Pass có ít nhất 6 ký tự.</span></span></td>
    </tr>
    <tr>
      <td>Mật khẩu mới</td>
      <td><span id="sprypassword2">
      <input type="password" name="pwnad" id="pwnad" size="30" />
      <span class="passwordRequiredMsg">Bạn chưa nhập password mới.</span><span class="passwordMinCharsMsg">Pass có ít nhất 6 ký tự.</span></span></td>
    </tr>
    <tr>
      <td>Xác nhận mật khẩu mới</td>
      <td>
        <span id="sprypassword3">
        <input type="password" name="xnpw" id="xnpw" size="30" onblur="kt_pw()"/>
        <span class="passwordRequiredMsg">Bạn chưa nhập lại password mới.</span><span class="passwordMinCharsMsg">Pass có ít nhất 6 ký tự.</span></span></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="gui" class="button" value="Gửi" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'">
        <input type="reset" name="Reset" class="button" value="Nhập lại" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'">
      </td>
    </tr>
  </table></form>
</div>
<script type="text/javascript">
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {validateOn:["blur", "change"], minChars:6});
var sprypassword2 = new Spry.Widget.ValidationPassword("sprypassword2", {validateOn:["blur", "change"], minChars:6});
var sprypassword3 = new Spry.Widget.ValidationPassword("sprypassword3", {validateOn:["blur", "change"], minChars:6});
</script>
