<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="border:0px solid #999; width:195px;"><table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td background="images/login1.png" class="td1" height="35px"><b>Xin chào:<?php echo (isset($_SESSION["mauser"]))?$_SESSION['mauser']:$_COOKIE['user']; ?></b></td>
  </tr>
  <tr>
  	<td background="images/toplist-content.gif" style="background-repeat:repeat-x;">
      <div class="b" align="center"><a href="index.php?b=ttcn">&raquo; Thông tin cá nhân</a><br />
        <a href="index.php?b=doimk">&raquo; Đổi mật khẩu</a><br>
        <a href="include/logout.php">Đăng xuất</a></div>
    </td>
  </tr>
</table></div>
