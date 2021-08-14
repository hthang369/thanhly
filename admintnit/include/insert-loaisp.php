<?php include"../connect.php";?>
<div class="inserttop">Thêm loại sản phẩm</div>
<div class="insertcen">
<form action="include/xl_insert.php?act=inlsp" method="post" enctype="multipart/form-data" name="form1" target="_blank" id="form1">
<table>
  <tr>
    <td width="150px">Loại sản phẩm:</td>
    <td width="350px"><input type="text" name="loaisp" /></td>
  </tr>

  <tr>
    <td width="150px">Nhóm sản phẩm</td>
    <td width="350px"><?php $r1=mysql_query("select * from nhomsanpham") or die ("Lỗi db");
	echo " <select name=\"nhomsp\" style=\"width:200px\" >";
	echo "<option>--Chọn nhóm sản phẩm--</option>";
	while ($s1=mysql_fetch_array($r1))
		 echo "<option value=\"$s1[0]\">$s1[1]</option>";
	echo "</select>";?></td>
  </tr>
  <tr>
    <td id="td1" colspan="2"><input class="button" type="submit" name="them" value="Thêm" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'" />
   <input class="button" type="submit" name="xoa" value="Xóa" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'" /></td></tr>
</table>
</form>
