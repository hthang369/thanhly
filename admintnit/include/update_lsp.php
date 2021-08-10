<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="inserttop">Cập nhật thông tin loại sản phẩm</div>
<div class="insertcen">
<?php 
$mal=$_REQUEST["idl"];
$sql=mysql_query("select * from loaisanpham where id_loai='$mal'") or die("lỗi truy vấn");
$row=mysql_fetch_array($sql);

?>
<form name="form1" method="post" action="include/xl_update.php?act=uplsp">
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>Mã loại sản phẩm</td>
    <td><input name="mal" type="text" id="mal" value="<?php echo $row[0];?>" size="30" readonly="readonly"></td>
  </tr>
  <tr>
    <td>Tên loại sản phẩm</td>
    <td><input name="tenl" type="text" id="tenl" size="30" value="<?php echo $row[1];?>"></td>
  </tr>
    <tr>
    <td colspan="2" align="center"><input type="submit" class="button" name="gui" id="gui" value="Cập nhật" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'">
      <input type="reset" name="reset" id="reset" class="button" value="Nhập lại" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'"></td>
    </tr>
</table>
</form>
</div>