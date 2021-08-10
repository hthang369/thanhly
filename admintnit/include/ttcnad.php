<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="inserttop">Thông tin cá nhân: <b><?php echo $_SESSION["user_admin"]; ?></b> </div>
<div class="insertcen">
<?php 
$user=$_SESSION["user_admin"];
$sql=mysql_query("select * from thanhvien where user='$user'") or die("lỗi truy vấn d5");
$row=mysql_fetch_array($sql); ?>
  <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
    <tr>
      <td height="30">Tên đăng nhập:</td>
      <td><?php echo $user; ?></td>
    </tr>
    <tr>
      <td height="30">Họ tên: </td>
      <td><?php echo $row["hoten"]; ?></td>
    </tr>
    <tr>
      <td height="30">Email:</td>
      <td><?php echo $row["email"]; ?></td>
    </tr>
    <tr>
      <td height="30">Địa chỉ:</td>
      <td><?php echo $row["diachi"]; ?></td>
    </tr>
    <tr>
      <td height="30">Điện thoại:</td>
      <td><?php echo $row["dienthoai"]; ?></td>
    </tr>
  </table>
</div>