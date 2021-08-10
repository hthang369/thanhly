<div id="demodd" style="overflow:hidden; width:580px; height:220px;">
   <table bgcolor="#ffffff" border="0" cellpadding="0">
   <tr> 
   <td id="demodd1" width="1400px"> 
      <table bgcolor="#c4c4c4" cellpadding="0" cellspacing="0">
        <tr bgcolor="#ffffff" >
         
 <?php	
	$sql=mysql_query("select * from sanpham where type=1 order by rand() limit 0,8") or die ("loi db");
	while($ro=mysql_fetch_array($sql))
	{
		//echo "<img src=\"images/sanpham/small/$row[hinhanh]\" />";
	$tensp=$ro["tensp"];
	$mota=$ro["mota"];
	$gia=number_format($ro["giaban"],0,'','.');
?>
<td align="left">    
<div class="show" >
<div class="item">
<table width="190" height="auto" style="border:0px dashed #999; background-image:url(images/spiphd.png); border-radius:10px; background-repeat:no-repeat;" cellpadding='0' cellspacing='0'>
<tr><td height="32px" align="center"></td></tr>
<tr><td align="center"><a href="index.php?b=ctsp&idsp=<?php echo "$ro[0]"; ?>" title="<?php echo $ro["tensp"]; ?>"><img src="images/sanpham/small/<?php echo $ro["hinhanh"] ?>" width=140 height=130 /></a>
</td></tr>
<tr><td style="font-size:14px; text-align:center;">
<a href="index.php?b=ctsp&idsp=<?php echo "$ro[0]"; ?>" title="<?php echo $ro["tensp"]; ?>"><?php echo $tensp ?></a></td></tr>
<tr><td style='color:#F00; font-weight:bold; text-align:center;'><a href="index.php?b=ctsp&idsp=<?php echo "$ro[0]"; ?>"><font color='#FF0000'><?php  if($ro["id_khuyenmai"]!=""){
			$sql2=mysql_query("select * from khuyenmai where id_khuyenmai='$ro[id_khuyenmai]'") or die ("loi db d7");
										$row2=mysql_fetch_array($sql2); $a=$row2["trisotrukhuyenmai"];
										if($now >= $row2['ngaybatdau'] && $row2['ngayketthuc'] >= $now){
											if($a!=0){
												$giamoi=number_format($ro["giaban"]*$a/100,0,'','.');
												echo "<sup><strike>".$gia." VNĐ</strike></sup><img src=\"images/cooltext598006493.gif\" width=\"35\" height=\"12\" /><br>".$giamoi." VNĐ";}
										} else {echo $gia." VNĐ";}
									}else echo $gia. " VNĐ"; ?></font></a></td></tr></table></div></div>
</td>
	<?php }?>
</tr>
</table>
 </td>
     
            <td id="demodd2" width="19"> 
              <table align="left" bgcolor="#c4c4c4" border="0" cellpadding="0" cellspacing="0">
                   <tr bgcolor="#ffffff" >


	<?php	
	$sql=mysql_query("select * from sanpham where type=1 order by rand() limit 0,8") or die ("loi db");
	while($ro=mysql_fetch_array($sql))
	{
		//echo "<img src=\"images/sanpham/small/$row[hinhanh]\" />";
	$tensp=$ro["tensp"];
	$mota=$ro["mota"];
	$gia=number_format($ro["giaban"],0,'','.');
	?>
<td align="left"> 
<div class="show" >
<div class="iitem">
<table width="190" height="auto" style="border:0px dashed #999; background-image:url(images/nen-sp1111.jpg); border-radius:10px; background-repeat:no-repeat; " cellpadding='0' cellspacing='0'>
<tr><td height="32px" align="center"></td></tr>
<tr><td align="center">
<a href="index.php?b=ctsp&idsp=<?php echo "$ro[0]"; ?>" title="<?php echo $ro["tensp"]; ?>"><img src="images/sanpham/small/<?php echo $ro["hinhanh"] ?>" width=140 height=130 /></a>
</td></tr>
<tr><td style="font-size:14px; text-align:center;">
<a href="index.php?b=ctsp&idsp=<?php echo "$ro[0]"; ?>" title="<?php echo $ro["tensp"]; ?>"><?php echo $tensp ?></a></td></tr>
<tr><td style='color:#F00; font-weight:bold; text-align:center;'><a href="index.php?b=ctsp&idsp=<?php echo "$ro[0]"; ?>"><font color='#FF0000'><?php  if($ro["id_khuyenmai"]!=""){
			$sql2=mysql_query("select * from khuyenmai where id_khuyenmai='$ro[id_khuyenmai]'") or die ("loi db d7");
										$row2=mysql_fetch_array($sql2); $a=$row2["trisotrukhuyenmai"];
										if($now >= $row2['ngaybatdau'] && $row2['ngayketthuc'] >= $now){
											if($a!=0){
												$giamoi=number_format($ro["giaban"]*$a/100,0,'','.');
												echo "<sup><strike>".$gia." VNĐ</strike></sup><img src=\"images/cooltext598006493.gif\" width=\"35\" height=\"12\" /><br>".$giamoi." VNĐ";}
										} else {echo $gia." VNĐ";}
									}else echo $gia. " VNĐ"; ?></font></a></td></tr>
</table></div></div>
</td>
<?php }?>
</tr>
</table> 
</td>
          </tr>
      </table>
</div>

<script>
var speed=15
demodd2.innerHTML=demodd1.innerHTML
function Marqueedd1(){
if(demodd2.offsetWidth-demodd.scrollLeft<=0)
demodd.scrollLeft-=demodd1.offsetWidth
else{
demodd.scrollLeft++
}
}
var MyMardd1=setInterval(Marqueedd1,speed)
demodd.onmouseover=function() {clearInterval(MyMardd1)}
demodd.onmouseout=function() {MyMardd1=setInterval(Marqueedd1,speed)}
</script>