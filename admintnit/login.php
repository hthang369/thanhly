<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>administrator</title>
<link href="../styles/style-admin.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
   
        function onload()
        {
            document.getElementById('uname').focus();
        }
    
    </script>
</head>
<body onload="onload();">
<div id="ad">
<p style="font-size:21px;">LOGIN</p>
  <form id="form1" name="form1" method="post" action="do_login.php?act=do">
<table align="center">
<tr>
<td height="60px"><font size="+2">Username</font></td>
<td><input type="text" name="adname" id="uname"/></td>
</tr>
<tr> 
<td height="60px"><font size="+2">Password</font></td>
<td><input type="password" name="adword" id="pword"/></td>
</tr>
<tr>
<td colspan="2" align="center" height="50px"><input type="submit" name="button" id="button" value="Đăng Nhập" /></td>
</tr>
</table>
 </form>
</div>
</body>
</html>