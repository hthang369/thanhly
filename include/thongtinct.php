<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="inserttop">Thông tin cá nhân của: <?php if(isset($_SESSION['mauser'])){
	echo $_SESSION["mauser"];} else { echo $_COOKIE['user'];} ?></div>
<div class="insertcen"><?php 
$ma=(isset($_SESSION['mauser']))?$_SESSION["mauser"]:$_COOKIE['user'];
$sql=mysql_query("select * from thanhvien where user='$ma'") or die("lỗi truy vấn d4");
$row=mysql_fetch_array($sql); ?>
<table width="515px" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="35">Tên đăng nhập</td>
    <td><?php echo $_SESSION["mauser"]; ?></td>
  </tr>
  <tr>
    <td height="35">Họ tên</td>
    <td><?php echo $row["hoten"]; ?></td>
  </tr>
  <tr>
    <td height="35">Email</td>
    <td><?php echo $row["email"]; ?></td>
  </tr>
  <tr>
    <td height="35">Địa chỉ</td>
    <td><?php echo $row["diachi"]; ?></td>
  </tr>
  <tr>
    <td height="35">Điện thoại</td>
    <td><?php echo $row["dienthoai"]; ?></td>
  </tr>
</table>
<div style="float:right;"><a class="b" href="index.php?b=doittcn">Đổi thông tin cá nhân</a></div>
</div>