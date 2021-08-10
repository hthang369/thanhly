<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="script/boxover.js"></script>
<?php 
$idloai = isset($_REQUEST["id_loai"])?$_REQUEST["id_loai"]:"";
$tk = isset($_REQUEST["tk"])?$_REQUEST["tk"]:"tsp";
$gia=isset($_REQUEST["gia"])?$_REQUEST["gia"]:"g1";
$text=$_REQUEST["text"];
	$now=date('Y-m-d');
	if(strlen($text)==0)
		echo "<script>alert('Bạn chưa nhập từ khóa cần tìm');window.history.go(-1);</script>";
    echo"<div class=inserttop>Kết quả tìm kiếm với từ khóa:".$text."</div>";
$r="";
if($idloai!="")
$r.= " and id_loai='$idloai'";
 $size=12;
if($tk=="tsp")
{
		if($gia=="g1")
		{
			$r.="and tensp like '%$text%' and giaban<=1000000000";
		}
	    else if($gia=="g2")
			{ 
				$r.="and tensp like '%$text%' and giaban<=2000000000";
			}
		else if($gia=="g3")
			{
    			$r.="and tensp like '%$text%' and giaban<=3000000000";
			}
		else if($gia=="g4")
			{
   				$r.="and tensp like '%$text%' and giaban<=4000000000";
			}
		else if($gia=="g5")
			{
   				$r.="and tensp like '%$text%' and giaban>=4000000000";
			}
		else{
   				$r.= "and tensp like '%$text%'";
			}
		}
		else{
			$r.="and mota like '%$text%'";
			}
		//hiển thị sản phẩm kiếm được ra màng hình
		$dem=mysql_query("select count(*) from sanpham where 1 $r") or die ("lỗi truy vấn 154");
		while($r1=mysql_fetch_array($dem))
		{$num=$r1[0];
		$count=ceil($num/$size);
		(!isset($_GET["cur"]))?$cur=1:$cur=$_GET["cur"];
		$p=($cur-1)*$size;
		}
	
   echo"<div class=insertcen>";

	$sql=mysql_query("select * from sanpham where 1 $r limit $p,$size")or die ("lỗi truy vấn 155");
			while($row=mysql_fetch_array($sql))
			{
				$gia=number_format($row["giaban"],0,'','.');
				$tensp=$row["tensp"];
				$mota=$row["mota"]; ?>
				<div class="show" ><div class="item">
	<table width="128" height="220" background='images/nen-sp.jpg' style="border:1px dotted #999" cellpadding='0' cellspacing='0'>       
	 <tr><td><a href="index.php?b=ctsp&id=<?php echo $row[0]; ?>"><img src="images/sanpham/small/<?php echo $row["hinhanh"]; ?>" width=128 height=120 /></a></td></tr>
		<tr><td><a href="index.php?b=ctsp&id=<?php echo $row[0]; ?>"><?php echo $tensp ?></a></td></tr>
		<tr><td style='color:#F00; font-weight:bold;'><a href="index.php?b=ctsp&id=<?php echo $row[0]; ?>"><font color='#FF0000'><?php  if($row["id_khuyenmai"]!=""){
										if($now >= $row3['ngaybatdau'] && $row3['ngayketthuc'] >= $now){
											if($a!=0){
												$giamoi=number_format($row["giaban"]*$a/100,0,'','.');
										echo "<sup><strike>".$gia." VNĐ</strike></sup><img src=\"images/cooltext598006493.gif\" width=\"35\" height=\"12\" /><br>".$giamoi." VNĐ";}
										} 
										else {echo $gia." VNĐ";}
									}else echo $gia. " VNĐ"; ?></font></a></td></tr></table></div></div>
		<?php	}

		echo "</div><hr>";
		if(!isset($num))
			echo "Không có sản phẩm nào phù hợp với từ khóa:<b style='color:#F00;'> $text </b>";
		else
		{
			if($count>1)
			{echo "<div class=pagination><b>Chọn trang: ";
				for ($i=1;$i<=$count;$i++)
				{
					if($cur==$i)
						echo "<span class='current'>$i</span>";
					else{
						if($_REQUEST["tk"]=="tsp")
							echo "<span class='cur'><a href=\"index.php?b=tkiem&text=$text&tk=tsp&cur=$i\">$i</a>&nbsp;&nbsp;</span>";
						else
							echo "<span class='cur'><a href=\"index.php?b=tkiem&text=$text&tk=ttsp&cur=$i\">$i</a>&nbsp;&nbsp;</span>";
					}
				}	
				echo "</div>";
			}
		}
?>
