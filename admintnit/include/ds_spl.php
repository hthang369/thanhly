<script type="text/javascript">
	function check()
	{
		var thongbao=window.confirm("Bạn có chắc muốn xóa nhóm sp này!");
		if(thongbao==true)
			return true;
		else
			return false;
	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
$size=20;
$idl=$_REQUEST["idl"];
$dem=mysql_query("select count(*) from sanpham where id_loai='$idl'") or die ("lỗi truy vấn");
$r=mysql_fetch_array($dem);
$num=$r[0];
$count=ceil($num/$size);
if (!isset($_GET["curr"]))
	$curr=1;
else
	$curr=$_GET["curr"];
$p=($curr-1)*$size;
 ?>
<div class="inserttop">Danh sách sản phẩm</div>
<div class="insertcen"><table cellpadding="0" cellspacing="0">
  <tr class="tr1">
    <td style="border-left:1px solid #333;" width="100px">Tên sản phẩm</td>
    <td width="100px">Loại sản phẩm</td>
    <td width="130px">Hiệu sản phẩm</td>
    <td width="100px">Giá (VNĐ)</td>
    <td width="100px">Hình ảnh</td>
    <td width="100px">Mô tả</td>
    <td width="100px">Bảo hành</td>
    <td width="100px">Khuyến mãi</td>
    <td width="50px">Sửa</td>
    <td width="50px">Xóa</td>
  </tr>
<?php $now=date('Y-m-d');
$sql=mysql_query("select sanpham.*,loaisanpham.*,hieu.* from sanpham,loaisanpham,hieu where loaisanpham.id_loai=sanpham.id_loai and hieu.id_hieu=sanpham.id_hieu and sanpham.id_loai='$idl' limit $p,$size") or die("loi truy vấn");
while($row=mysql_fetch_array($sql))
{
	$idkm=$row["id_khuyenmai"];
	$sql1=mysql_query("select * from khuyenmai where id_khuyenmai='$idkm'") or die("lỗi truy vấn d19");
	$row1=mysql_fetch_array($sql1);
	if($row1["id_khuyenmai"]!=0){
		if($now >= $row1['ngaybatdau'] && $row1['ngayketthuc'] >= $now)
			$ttkm="Có";
		else
			$ttkm="Không";
	}
	else
		$ttkm="Không";
	$gia=number_format($row["giaban"],0,'','.');$masp=$row["id_sp"];
	$mota=(strlen($row["mota"])<=80?$row["mota"]:substr($row["mota"],0,80)."...");$bh=($row["baohanh"])?$row["baohanh"]."  Tháng":"Không bảo hành";
	echo "<tr class=\"tr2\"><td style=\"border-left:1px solid #333;\">$row[tensp]</td>
	<td>$row[tenloai]</td>
	<td>$row[tenhieu]</td>
	<td>$gia</td>
	<td><img src=\"../images/sanpham/small/$row[hinhanh]\" width=\"100px\" height=\"100px\" /></td>
	<td>$mota</td>
	<td>$bh</td>
	<td>$ttkm</td>
	<td><a href='?b=sp&m=upsp&masp=$masp' >Sửa</a></td>
	<td><a href='include/delete.php?idsp=$masp&act=del_sp' onclick='return check()' >Xóa</a></td></tr>";
}
 ?>
</table>
</div>
<hr />
<?php  
if($count>1)
{echo "<div class=pagination><b>Chọn trang: ";
	for ($i=1;$i<=$count;$i++)
	{
		if($curr==$i)
			echo "<span class='current'>$i</span>";
		else
			echo "<span class='curr'><a href=\"index.php?b=sp&m=dsspl&idl=$idl&curr=$i\">$i</a>&nbsp;&nbsp;</span>";
	}
		
	echo "</div>";
}?>