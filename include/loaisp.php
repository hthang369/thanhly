<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="script/boxover.js"></script>
<?php 
$idx=$_REQUEST["idl"];
$idl1 = explode('-',$idx);
$id =end($idl1);
$now=date('Y-m-d');
$sql=mysql_query("select * from loaisanpham where id_loai='$id'") or die ("loi db");
$row=mysql_fetch_array($sql);
$size=9;
$sql1=mysql_query("select count(*) from sanpham where id_loai=$row[0]") or die ("loi tv");
$r=mysql_fetch_array($sql1);
$num=$r[0];
if($num > $size)
{
$count=ceil($num/$size);
}
else
{
$count=1;
}

if (!isset($_GET["curr"]) || (int)$_GET["curr"]<=0)
	$curr=1;
else
	$curr=$_GET["curr"];
$p=($curr-1)*$size;

echo"<div class=\"inserttop\">$row[1]</div>" ?>
<div class="insertcen"><?php $sq=mysql_query("select * from sanpham where id_loai=$row[0] order by rand() limit $p,$size") or die ("loi db");
while ($ro=mysql_fetch_array($sq))
{	
	$tensp=$ro["tensp"];$mota=$ro["mota"];
	$gia=number_format($ro["giaban"],0,'','.'); ?>
	<div class="showlsp" ><div class="item"><table width="170" height="220" background='images/1nen-sp.jpg' style="border:0px dotted #999" cellpadding='0' cellspacing='0'><tr>
		<td height="120"><a href="san-pham/<?=khongdau($tensp)?>-<?php echo $ro[0]?>.html"><img src="images/sanpham/small/<?php echo $ro["hinhanh"] ?>" width=140 height=130 /></a></td></tr>
		<tr><td width="128" height="auto"><a href="san-pham/<?=khongdau($tensp)?>-<?php echo $ro[0]?>.html"><?php echo $tensp ?></a></td></tr>
		<tr><td style='color:#F00; font-weight:bold;'><a href="san-pham/<?=khongdau($tensp)?>-<?php echo $ro[0]?>.html"><font color='#FF0000'><?php  if($row["id_khuyenmai"]!=""){
			$sql2=mysql_query("select * from khuyenmai where id_khuyenmai='$row[id_khuyenmai]'") or die ("loi db d7");
										$row2=mysql_fetch_array($sql2); $a=$row2["trisotrukhuyenmai"];
										if($now >= $row2['ngaybatdau'] && $row2['ngayketthuc'] >= $now){
											if($a!=0){
												$giamoi=number_format($ro["giaban"]*$a/100,0,'','.');
												echo "<sup><strike>".$gia." VNĐ</strike></sup><img src=\"images/cooltext598006493.gif\" width=\"35\" height=\"12\" /><br>".$giamoi." VNĐ";}
										} else {echo $gia." VNĐ";}
									}else echo $gia. " VNĐ"; ?></font></a></td></tr></table></div></div><?php
}?> </div>

<?php  
if($num==0)
{
	echo "<div class=pagination><b>Xin thông cảm! chúng tôi Chưa cập nhật loại sản phẩm này</div>";
 }
if($num>=1 && $num<=15)
{
	echo "<div class=pagination><b>Chỉ có: ";
    echo"<span class='current'>$num</span><b>sản phẩm</div>";
}
if($count>1)
{echo "<div class=pagination><b>Chọn trang: ";
	for ($i=1;$i<=$count;$i++)
	{
		if($curr==$i)
			echo "<span class='current'>$i</span>";
		else
			echo "<span class='curr'><a href=\"index.php?b=lsp&idl=$id&curr=$i\">$i</a>&nbsp;</span>";
	}
		
	echo "</div>";
}?>
 