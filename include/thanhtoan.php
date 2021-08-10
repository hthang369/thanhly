<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php session_start();
include "../connect.php";
if(!isset($_SESSION["mauser"]))
	echo "<script>alert('Bạn cần đăng nhập để mua hàng');window.history.go(-1);</script>";
else{
	if(count($_SESSION["cart"])==0)
		echo "<script>alert('Giỏ hàng của bạn hiện chưa có sản phẩm nào,mời bạn chọn sp cho vào giỏ hàng');window.history.go(-1);</script>";
	else{
		$hoten=$_SESSION["mauser"];
		$tong=$_SESSION["tong"];
		$now=date("Y-m-d");
		$sql=mysql_query("insert into hoadon values (NULL,'$tong','$now',NULL,'0','$hoten')") or die("lỗi insert d10");
		$chk=mysql_query("select * from hoadon where tongtien='$tong'") or die("lỗi truy vấn");
		$row=mysql_fetch_array($chk);
		$idhd=$row[0];
		$hoten=$_SESSION["mauser"];
		 foreach($_SESSION["cart"] as $k => $v)
		{
			$sql1=mysql_query("select * from sanpham where id_sp='$k'") or die("lỗi truy vấn");
			$r=mysql_fetch_array($sql1); $gia=$r["giaban"];
			$sql2=mysql_query("select * from loaisanpham where id_loai='$r[id_loai]'") or die ("loi db");
			$row1=mysql_fetch_array($sql2);
			if($row1["id_khuyenmai"]!=""){
				$sql2=mysql_query("select * from khuyenmai where id_khuyenmai='$row1[id_khuyenmai]'") or die ("loi db d7");
				$row2=mysql_fetch_array($sql2); $a=$row2["trisotrukhuyenmai"];
				if($now >= $row2['ngaybatdau'] && $row2['ngayketthuc'] >= $now){
					if($a!=0){
						$giamoi=$r["giaban"]*$a/100;
						$giane=$giamoi;
						$tt=$giane*$v;}
				} else {$giane=$gia; $tt=$giane*$v;}
			} else {$giane= $gia; $tt=$giane*$v; }
			$sq=mysql_query("insert into chitiethoadon values ('$idhd','$k','$hoten','$v','$giane','$tt')") or die("lỗi insert d20");
			print_r($sq);
		}
	}?>
    <div align="center" style="width:960px; margin:10 auto; border:1px solid #999;"><div style="background-color:#CCC; height:20px;"></div><div style="border:1px solid #999;">
<p>Cảm ơn quý khách đã mua hàng tại website của chúng tôi. Đơn hàng của quý khách đã được lưu trữ. Chúng tôi sẽ liên hệ với quý khách trong thời gian sớm nhất để xác nhận giao hàng. Mời quý khách vào mail của mình để xem lại thông tin giỏ hàng của mình vừa đặt.</p>
<p>Website sẽ tự động trở về trang chủ trong thời gian 10 giây và sẽ hủy đi lược mua hàng này của bạn. Nếu bạn muốn mua hàng nữa thì mời đăng nhập mua hàng tiếp sau 10 giây.</p>
<p>Trân trọng cảm ơn quý khách.</p>
<br>Nếu hệ thống không tự động chuyển về xin bạn nhấp vào đây <a href='../index.php'>Trở về trang chủ</a></p></div>
<meta http-equiv="refresh" content="10;URL=../index.php" />
<?php unset($_SESSION["cart"]);
}
?>