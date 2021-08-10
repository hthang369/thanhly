<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include "../connect.php";
if(isset($_REQUEST["masp"]))
{
	$ma=$_REQUEST["masp"];
	$sql=mysql_query("select * from sanpham where id_sp='$ma'") or die ("loi db");
	$row=mysql_fetch_array($sql);
	$masp=$row[0];
	$tensp=$row["tensp"];
	$gia=$row["giaban"];
	$hinh=$row["hinhanh"];
	$mota=$row["mota"];
	$bh=$row["baohanh"];
	$sl=$row["soluong"];
	$loai=$row["id_loai"];
	$km=$row["id_khuyenmai"];
	$triso=$row["type"];
}
 ?>
 <div class="inserttop">Cập nhật thông tin sản phẩm</div>
 <div class="insertcen">
  <table width="80%" align="center" cellpadding="0" cellspacing="0">
  <form action="include/xl_update.php?act=upsp" method="post" enctype="multipart/form-data">
  <tr>
    <td width="170">Mã SP</td>
    <td><input name="mssp" type="text" value="<?php echo $masp; ?>" size="30" readonly="readonly"/></td>
  </tr>
  <tr>
    <td>Tên SP</td>
    <td><input name="tsp" type="text" value="<?php echo $tensp; ?>" size="30"/></td>
  </tr>
  <tr>
    <td>Loại SP</td>
    <td><?php
	 $r = mysql_query("select * from loaisanpham") or die ("loi db");
	echo " <select name=\"loaisp\" style=\"width:200px\" >";
	echo "<option>--Chọn loại sản phẩm--</option>";
	 while($s = mysql_fetch_array($r))
	 {
		 if($s[0]==$loai)
		 	echo "<option value=\"$s[0]\" selected=\"selected\">$s[1]</option>";
		else 
         	echo "<option value=\"$s[0]\">$s[1]</option>";
	 }
	echo "</select>";
	?></td>
  </tr>
<tr>
    <td height="50px">trị số sản phẩm</td>
    <td colspan="2"><input name="triso" type="text" value="<?php echo $triso; ?>" size="30"/><font color="#FF0000"><br/>-Trị số "0" sản phẩm bình thường<br />-Trị số "1" sản phẩm mới hay tiêu biểu</font></td>
   </tr>
     <tr>
    <td height="50px">số lượng</td>
    <td colspan="2"><input name="sl" type="text" value="<?php echo $sl; ?>" size="30"/></td>
  </tr>
    <tr>
  <tr>
    <td>Giá bán</td>
    <td><input name="gsp" type="text" value="<?php echo $gia; ?>" size="30"/> VNĐ</td>
  </tr>
  <tr>
    <td>Hình ảnh</td>
        <td><input name="anh" type="file" /> 
    <?php echo "<img src=\"../images/sanpham/small/$row[hinhanh]\" width=\"200\" height=\"200\" />" ?>
     <input type="hidden" name="oldimage" value="<?php echo "$row[hinhanh]"; ?>"> </td>
  </tr>
  <tr>
    <td>Mô tả</td>
    <td colspan="3" style="padding-left: 10px">
    <?php
	include("fckeditor/fckeditor.php") ;
	$oFCKeditor = new FCKeditor('mta') ;
	$sValue = stripslashes($mota) ;
	$oFCKeditor->BasePath = '../admintnit/fckeditor/' ;
	$oFCKeditor->Value = $sValue;
	$oFCKeditor->Create() ;
	?>
    </td>
  </tr>
  <tr>
    <td>Bảo hành</td>
    <td><input name="bhsp" type="text" value="<?php echo $bh; ?>" size="30"/> Tháng</td>
  </tr>
  <tr>
    <td height="50px">Khuyến mãi</td>
	 <td colspan="2"><?php
	 $r = mysql_query("select * from khuyenmai") or die ("loi db");
	echo " <select name=\"km\" style=\"width:200px\" >";
	echo "<option>--chọn khuyến mãi nếu có!--</option>";
	 while($s = mysql_fetch_array($r))
	   { 
        echo "<option value=\"$s[0]\">$s[1]</option>";
	   }
		echo "</select>";
	?> 
  <input type="checkbox" name="km" id="km" value="NULL" />không khuyến mãi</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="sua" class="button" id="sua" value="Cập nhật" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'" />
      <input type="reset" name="xoa" class="button" id="xoa" value="Xóa" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'" /></td>
  </tr>
  </form>
</table>
</div>