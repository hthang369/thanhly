 <script type="text/javascript">
 function createXmlHttpRequestObject() {
    var xmlHttp;
	try {
		xmlHttp = new XMLHttpRequest();
	}
	catch (e) {
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
    if (!xmlHttp)
        alert("Error creating the XMLHttpRequest object.");
    else
        return xmlHttp;
}

var xmlHttp = new createXmlHttpRequestObject();
function kt_user() {
    
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0) {
		tenuser = encodeURIComponent(document.getElementById("user").value);
        xmlHttp.open("GET", "include/kt_user.php?user=" + tenuser, true);
        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == 4) {
                if (xmlHttp.status == 200) {
                    document.getElementById("ktuser").innerHTML = xmlHttp.responseText;
                }

            }
        }
        xmlHttp.send(null);
    }
   
}

 		function kiemtramk()
		{
			if(document.getElementById("pass2").value!=document.getElementById("pass").value)
				alert("Mật khẩu xác nhận ko trùng mật khẩu vừa nhập");
		}
		function ktemail()
		{
			if(document.getElementById("xnemail").value!=document.getElementById("email").value)
				alert("Email xác nhận ko trùng email vừa nhập");
		}
 </script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" /> 
<div id="ht"><div class="inserttop">Đăng ký thành viên</div>
  <div class="insertcen">
  <form name="frmdangkithanhvien" action="include/do_dk.php" method="post" >
  <table>
    <tr><td width="200">Tên đăng nhập</td>
      <td><span id="sprytextfield1">
      <input type="text" name="user" id="user" size="30" onkeyup="kt_user()" onfocus="this.value=''"/>
      <span class="textfieldRequiredMsg">Bạn hãy nhập tên đăng nhập.</span><span class="textfieldMinCharsMsg">User ít nhất 6 ký tự.</span></span><div id="ktuser" style="color:#F00"></div></td>
      </tr>
    <tr><td width="200">Mật khẩu</td>
      <td><span id="sprypassword1">
      <input type="password" name="pass" id="pass" size="30" onfocus="this.value=''"/>
      <span class="passwordRequiredMsg">Bạn hãy nhập mật khẩu.</span><span class="passwordMinCharsMsg">Pass ít nhất 6 ký tự.</span></span></td>
      </tr>
      <tr><td width="200">Xác nhận mật khẩu</td>
      <td><span id="sprypassword2">
        <input type="password" name="pass2" id="pass2" size="30" onchange="kiemtramk()"/>
        <span class="passwordRequiredMsg">Bạn hãy nhập mật khẩu.</span><span class="passwordMinCharsMsg">Pass ít nhất 6 ký tự.</span></span></td>
      </tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr><td colspan="2"><b>THÔNG TIN CÁ NHÂN</b></td></tr> 	
    <tr><td width="200">Địa chỉ email</td>
      <td><span id="sprytextfield2">
      <input type="text" name="nmEmailAdd" id="email" size="40" />
      <span class="textfieldRequiredMsg">Sai cấu trúc Email</span><span class="textfieldInvalidFormatMsg">.</span></span></td>
      </tr>
    <tr><td width="200">Xác nhận địa chỉ email</td>
      <td><span id="sprytextfield3">
      <input type="text" name="nmVerifyEmailAdd" id="xnemail" size="40" onchange="ktemail()" />
      <span class="textfieldRequiredMsg">Sai cấu trúc Email</span><span class="textfieldInvalidFormatMsg">.</span></span></td>
      </tr>
  <tr><td width="200">Họ tên</td>
    <td>
      <input type="text" name="nmFullName" id="ten" size="40"/>
      </td>
    </tr>
    <tr><td width="200">Địa chỉ</td>
      <td><textarea name="nmAddress" id="diac" cols="40" rows="5"></textarea></td>
      </tr>
    <tr><td width="200">Điện thoại</td>
      <td><span id="sprytextfield4">
      <input type="text" name="nmNumber" id="dthoai" size="40"/>
      <span class="textfieldInvalidFormatMsg">Sai số điện thoại.</span></span></td>
      </tr>
    <tr><td width="200">Mã xác nhận</td><td><img src="include/captcha.php" /></td></tr>
    <tr><td>&nbsp;</td><td><input name="maxn" type="text" /></td></tr>
    <tr>
      <td colspan="2">Tôi đã đọc và đồng ý với điều khoản sử dụng 
        <span id="sprycheckbox1">
        <input type="checkbox" name="nmAgreePolicy" />
        <span class="checkboxRequiredMsg">Bạn chưa đánh dấu chọn.</span></span></td></tr>            
    <tr>
      <td colspan="2" align="center"><input class="button" type="submit" name="dangky" value="Đăng ký" onmousemove="style.background='url(images/button-2-o.gif)'" onmouseout="style.background='url(images/button-o.gif)'" />
        <input class="button" type="reset" name="xoa" value="Xóa" onmousemove="style.background='url(images/button-2-o.gif)'" onmouseout="style.background='url(images/button-o.gif)'" /></td></tr>
  </table>
  <input type="hidden" name="act" /></form></div>
</div>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"], minChars:6});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {validateOn:["blur", "change"], minChars:6});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email", {validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {validateOn:["blur", "change"]});
var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1", {validateOn:["blur", "change"]});
var sprypassword2 = new Spry.Widget.ValidationPassword("sprypassword2");
</script>
