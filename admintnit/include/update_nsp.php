<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="inserttop">Cập nhật thông tin nhóm sản phẩm</div>
<div class="insertcen">
<?php 
$man=$_REQUEST["idn"];
$sql=mysql_query("select * from nhomsanpham where id_nhom='$man'") or die("lỗi truy vấn");
$row=mysql_fetch_array($sql);
?>
<form name="form1" method="post" action="include/xl_update.php?act=upnsp">
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>Mã nhóm sản phẩm</td>
    <td><input name="man" type="text" id="man" value="<?php echo $row[0];?>" size="30" readonly="readonly"></td>
  </tr>
  <tr>
    <td>Tên nhóm sản phẩm</td>
    <td><input name="tenn" type="text" id="tenn" size="30" value="<?php echo $row[1];?>"></td>
  </tr>
   <tr>
    <td colspan="2" align="center"><input type="submit" class="button" name="gui" id="gui" value="Cập nhật" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'">
      <input type="reset" name="reset" id="reset" class="button" value="Nhập lại" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'"></td>
    </tr>
</table>
</form>
</div>