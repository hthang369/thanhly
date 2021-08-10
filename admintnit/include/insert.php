<script>
$(function(){
$('#nhomsp').change(function(){
	$.post('include/xl_insert.php?act=load_sp','idnhom=' + $(this).val(),function(data){
		$('#loaisp').html(data);
	});
});
});
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="ckeditor/ckeditor.js"></script>
<div class="inserttop">Thêm sản phẩm</div>
<div class="insertcen">
<form action="include/xl_insert.php?act=insp" method="post" enctype="multipart/form-data" name="form1" id="form1">
<table>
  <tr>
    <td width="150px">Nhóm sản phẩm</td>
    <td width="350px">
    <select name="nhomsp" id="nhomsp" style="width:200px" >
	<?php
		$r1=mysql_query("select * from nhomsanpham") or die ("Lỗi db");
	echo "<option>--Chọn nhóm sản phẩm--</option>";
	while ($ss=mysql_fetch_array($r1))
		 echo "<option value=\"$ss[0]\">$ss[1]</option>";
	?></select></td>
	<td ><font color="#FF0000">lưu ý: Chọn số thứ tự của loại sản phẩm phải trùng với số thứ tự của nhóm sản phẩm</font> </td>
  </tr>
  <tr>
    <td>Loại Sản Phẩm</td>
    <td><select name="loaisp" id="loaisp" style="width:200px" >
    <option>--Chọn loại sản phẩm--</option>
	<?php
	$r = mysql_query("select * from loaisanpham ") or die ("loi dbl");
	 while($s = mysql_fetch_array($r))
         echo "<option value=\"$s[0]\">$s[1]</option>";
		?>
    </select>
	</td>
		  </tr>

  <tr><td>Mã sản phẩm:</td>
  <td><input type="text" name="masp"  /></td></tr>
  <tr><td>trị số sản phẩm</td>
  <td><input type="text" name="trs"  /></td>
  <td width="220px"><font color="#FF0000">-Trị số "0" sản phẩm bình thường<br />-Trị số "1" sản phẩm mới hay tiêu biểu</font>
  </td>
  </tr>
  <tr><td>Tên sản phẩm:</td>
  <td><input type="text" name="tensp"  /></td>
  </tr>
  <tr><td>Giá bán:</td>
  <td><input type="text" name="giasp"  /></td>
  </tr>
  <tr><td>Bảo hành:</td>
  <td><input type="text" name="bhsp"  /></td>
  </tr>
  <tr><td>Hình:</td>
  <td><input type="file" name="hinh"  /></td>
  </tr>
  <tr><td colspan="3">Mô tả:</td></tr>
  <tr>
  <td colspan="3" style="padding-left: 10px">
  <textarea name="motasp" id="motasp"></textarea>
    </td>
  </tr>
   <tr>
    <td>Khuyến mãi</td>
     <td><?php
	 $r = mysql_query("select * from khuyenmai") or die ("loi db");
	echo " <select name=\"km\" style=\"width:200px\" >";
	echo "<option>--chọn chế độ khuyến mãi--</option>";
	 while($s = mysql_fetch_array($r))
	   { 
        echo "<option value=\"$s[0]\">$s[1]</option>";
	   }
		echo "</select>";
	?> 
  <input type="checkbox" name="km" id="km" value="NULL" />Không khuyến mãi</td>
  </tr>
  <tr>
  <tr>
    <td id="td1" colspan="2"><input class="button" type="submit" name="them" value="Thêm" onmousemove="style.background='url(../../images/button-2-o.gif)'" onmouseout="style.background='url(../../images/button-o.gif)'" />
    <input class="button" type="reset" name="xoa" value="Xóa" onmousemove="style.background='url(../../images/button-2-o.gif)'" onmouseout="style.background='url(../../images/button-o.gif)'" /></td></tr>
</table></form></div>
<div id="insertbot"></div>
<script>
   CKEDITOR.replace('motasp');
</script>