<script type="text/javascript" src="script/highslide-with-gallery.js"></script>
<link rel="stylesheet" type="text/css" href="styles/highslide.css" />
<script type="text/javascript">
	hs.graphicsDir = 'styles/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.wrapperClassName = 'dark borderless floating-caption';
	hs.fadeInOut = true;
	hs.dimmingOpacity = .75;

	// Add the controlbar
	if (hs.addSlideshow) hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		fixedControls: 'fit',
		overlayOptions: {
			opacity: .6,
			position: 'bottom center',
			hideOnMouseOut: true
		}
	});
</script>
<?php 
$idx=$_REQUEST["idsp"];
$idsp1 = explode('-',$idx);
$id =end($idsp1);
$now=date('Y-m-d');
$sql=mysql_query("select * from sanpham where id_sp='$id'") or die ("loi db");
$row=mysql_fetch_array($sql);
$sql1=mysql_query("select * from loaisanpham where id_loai='$row[id_loai]'") or die ("loi db");
$row1=mysql_fetch_array($sql1);
$masp = $row["id_sp"];
$tensp = $row["tensp"];
$gia = number_format($row["giaban"],0,'','.');
$mota = $row["mota"];
$hinh = $row["hinhanh"];
$baohanh = $row["baohanh"];
 ?>
<link href="../styles/highslide.css" rel="stylesheet" type="text/css" />

 <div class="inserttop">Chi tiết sản phẩm</div>
 <div style="width:570px; border:0px solid #999; padding:5px 10px;">
<table width="100%" cellpadding="5" cellspacing="0" >
   <tr >
     <td rowspan="4" style="border:1px solid #ccc;"><div class="highslide-gallery"> <a href="images/sanpham/<?php echo $hinh; ?>" class="highslide" onclick="return hs.expand(this)"><?php echo "<img src=\"images/sanpham/small/$hinh\" alt=\"Highslide JS\"
		title=\"Click to enlarge\" />"; ?> </a> <div class="highslide-caption">
	<?php echo $tensp; ?>
</div></div></td>
     <td style="border-right:1px solid #ccc; border-bottom:1px solid #CCC; height:40px; width:100px;"><b>Tên sản phẩm</b></td>
     <td style="border-bottom:1px solid #CCC;"><?php echo $tensp; ?></td>
   </tr>
   <tr>
     <td style="border-right:1px solid #ccc; border-bottom:1px solid #CCC; height:40px;"><b>Bảo hành</b></td>
     <td style="border-bottom:1px solid #CCC;"><?php echo $baohanh; ?> Tháng</td>
   </tr>
    <tr>
      <td style="border-right:1px solid #ccc; height:40px;"><b>Giá</b></td>
      <td style="color:#F00; font-weight:bold;"><?php if($row1["id_khuyenmai"]!=""){
										$sql2=mysql_query("select * from khuyenmai where id_khuyenmai='$row1[id_khuyenmai]'") or die ("loi db d7");
										$row2=mysql_fetch_array($sql2); $a=$row2["trisotrukhuyenmai"];
										if($now >= $row2['ngaybatdau'] && $row2['ngayketthuc'] >= $now){
											if($a!=0){
												$giamoi=number_format($row["giaban"]*$a/100,0,'','.');
												echo "Giá cũ: <b><strike>".$gia." VNĐ</strike></b><br>Giá mới: <b>".$giamoi." </b>";}
										} else {echo $gia;}
									} else echo $gia; ?> VNĐ</td>
    </tr>
    <tr style="border-bottom:1px solid #ccc;">
      <td colspan="3"><a href="index.php?b=ctgh&id=<?php echo $masp; ?>&action2=add"><img src="images/chovaogiohang.gif" /></a></td>
    </tr>
    <tr>
      <td colspan="3"><b>Thông tin chi tiết</b></td>
    </tr>
    <tr>
      <td colspan="3"><?php echo $mota; ?>
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_google_plusone" title="Chia sẽ lên Google+"></a>
<a class="addthis_button_facebook" title="Chia sẽ lên Facebook"></a>
<a class="addthis_button_zingme" title="Chia sẽ lên Zingme"></a>
<a class="addthis_button_twitter" title="Chia sẽ lên Twitter"></a>
<a class="addthis_button_favorites"></a>
<a class="addthis_button_google"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script  type="text/javascript"  src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e344ae31e7ef1cc"></script>
</td>
    </tr>
    <tr>
    	<td><b>Khuyến mãi</b></td><td colspan="2" style="color:#F00;">
		<?php if(isset($row2["ngaybatdau"],$row2["ngayketthuc"])){
					if($now >= $row2['ngaybatdau'] && $row2['ngayketthuc'] >= $now)
						echo "<b>".$row2["thongtin"]."</b>";
					else 
						echo "Hiện chưa có thông tin khuyến mãi nào! chúng tôi sẽ cập nhật sau.";
			}else
				 echo "Hiện chưa có thông tin khuyến mãi nào! chúng tôi sẽ cập nhật sau.";?></td>
    </tr>
</table>
</div>
