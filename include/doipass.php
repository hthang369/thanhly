<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<script language="javascript">
		function kiemtramk()
		{
			if(document.getElementById("pass2").value!=document.getElementById("pass").value)
				alert("Mật khẩu xác nhận ko trùng mật khẩu vừa nhập");
			
		}
</script>
<form name="form1" method="post" action="include/xl_update.php?act=doipw">
  <div class="inserttop">Đổi mật khẩu</div>
  <div class="insertcen">
  <table align="center" cellpadding="0" cellspacing="0">
  <tr><td width="200">Tên truy nhập:</td><td width="200"> <input name="tenuser" type="text" value="<?php echo $_SESSION["mauser"]; ?>" size="30" readonly="readonly"></td></tr>
  <tr><td>Mật khẩu cũ:</td><td> <span id="sprypassword1">
  <input type="password" name="pwold" size="30">
  <span class="passwordRequiredMsg">Bạn chưa nhập mật khẩu.</span><span class="passwordMinCharsMsg">Mật khẩu phải ít nhất 6 ký tự.</span></span> 
    </td></tr>
  <tr><td>Mật khẩu mới:</td><td><span id="sprypassword2">
  <input type="password" name="pwnew" id="pass" size="30" />
  <span class="passwordRequiredMsg">Bạn chưa nhập mật khẩu mới.</span><span class="passwordMinCharsMsg">Mật khẩu phải ít nhất 6 ký tự.</span></span></td></tr>
  <tr><td>Xác nhận mật khẩu mới:</td><td><span id="sprypassword3">
  <input type="password" name="xnpwnew" id="pass2" size="30" onblur="kiemtramk()" />
  <span class="passwordRequiredMsg">Bạn chưa nhập mật khẩu xác nhận.</span><span class="passwordMinCharsMsg">Mật khẩu phải ít nhất 6 ký tự.</span></span></td></tr>
  <tr><td colspan="2" align="center"><input type="submit" name="button" class="button" id="button" value="Gửi" onmousemove="style.background='url(images/button-2-o.gif)'" onmouseout="style.background='url(images/button-o.gif)'">
  <input type="reset" name="button2" class="button" id="button2" value="Nhập lại" onmousemove="style.background='url(images/button-2-o.gif)'" onmouseout="style.background='url(images/button-o.gif)'"></td></tr>
  </table>
  </div>
</form>
<script type="text/javascript">
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {validateOn:["blur", "change"], minChars:6});
var sprypassword2 = new Spry.Widget.ValidationPassword("sprypassword2", {validateOn:["blur", "change"], minChars:6});
var sprypassword3 = new Spry.Widget.ValidationPassword("sprypassword3", {validateOn:["blur", "change"], minChars:6});
</script>
