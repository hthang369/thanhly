<style type="text/css">
#ta tr td{border:1px solid #999;}
.tr2 td{height:30px; text-align:center;}
</style>
<?php
//file chua cac function ve gio hang
function InGioHang($cart)
{
	?>
    <div class="inserttop">Thông tin giỏ hàng</div>
    <div class="insertcen">
    <table id="ta"  border="0" style="border:1px solid #CCC;" cellpadding="0" cellspacing="0">
  <tr class="tr2">
    <td width="82">STT</td>
    <td width="71">Mã SP</td>
    <td width="145">Tên SP</td>
    <td width="69">Giá</td>
    <td width="79">Số lượng</td>
    <td width="112">Thành Tiền</td>
    <td>Xóa</td>
  </tr>
  <?php
  $stt=0; $tong=0; $now=date('Y-m-d');
  foreach($cart as $masp=>$soluong)
  {  	$sql = "select * from sanpham where id_sp='$masp' ";
  		$result = mysql_query($sql);
  		$n = mysql_num_rows($result);
	  if ($n>0)
	  {  $r = mysql_fetch_array($result);
	  		$sql1=mysql_query("select * from loaisanpham where id_loai='$r[id_loai]'") or die ("loi db");
			$row1=mysql_fetch_array($sql1);
		 $tensp = $r["tensp"]; $gia=$r["giaban"];
		 $stt++;
		  ?>
          <form action="index.php" method="get" name="frm<?php echo $masp;?>">
	  	<tr>
            <td align="center"><?php echo $stt;?></td>
            <td><?php echo $masp;?></td>
            <td><?php echo $tensp;?></td>
            <td><?php if($row1["id_khuyenmai"]!=""){
						$sql2=mysql_query("select * from khuyenmai where id_khuyenmai='$row1[id_khuyenmai]'") or die ("loi db d7");
						$row2=mysql_fetch_array($sql2); $a=$row2["trisotrukhuyenmai"];
						if($now >= $row2['ngaybatdau'] && $row2['ngayketthuc'] >= $now){
							if($a!=0){
								$giamoi=$r["giaban"]*$a/100; echo $giane=$giamoi;}
						} else {$gia; echo $giane=$gia; }
					} else { $gia;  echo $giane=$gia;}?></td>
            <td>
			<input type="hidden" name="id" value="<?php echo $masp;?>">
            <input type="hidden" name="b" value="ctgh">
            <input type="hidden" name="action2" value="update">
            <input name="soluong" type="text" value="<?php echo $soluong;?>" size="10">            
            </td>
            <td><?php $tt=$soluong*$giane; echo $tt; $tong += $tt;?></td>
            <td><a href="#" onclick="document.frm<?php echo $masp; ?>.submit()" >Update</a>&nbsp;<a href="?b=ctgh&action2=del&id=<?php echo $masp;?>">Xóa</a></td>
	  	</tr>
        </form>
        
	  <?php
	  }
  }
	?>
  		<tr><td colspan="5">Tổng Tiền:</td>
  		    <td colspan="2"><font color="#FF0000"><b><?php echo number_format($tong,0,'','.'); $_SESSION["tong"]=$tong; ?> VNĐ</b></font></td>
        </tr>
	</table>
    </div>
    <?php	
  }
  
function xoaSP($masp, &$cart)
{
	unset($cart[$masp]);	
}
  
function themSP($masp, $soluong, &$cart)
{
	if ($masp=="") return;
	if (!isset($cart[$masp])) //san pham moi
	{
		$cart[$masp] = $soluong;
	}
	else
  	$cart[$masp] = $cart[$masp] + $soluong;
}

function updateSP($masp, $soluong, &$cart)
{
	if (isset($cart[$masp]))
	{
		if ($soluong<=0) unset($cart[$masp]);
		else $cart[$masp]=$soluong;
	}	
}

?>

<pre>
<font color="#FF0000">LƯU Ý</font><font color="#3333FF">
>>nếu bạn thấy giá cả và sản phẩm phù hợp thì bạn ấn "Thanh Toán" bên 
 dưới và đơn hàng này sẽ được gửi đến ban quản trị web.Chúng tôi sẽ 
 xác nhận lại đơn hàng và thông tin thành viên của bạn rồi gọi lại để
 giao hàng cho bạn.
>>bạn có thể liên hệ trực tiếp đường dây nóng:<font color="#FF0000">0976.1122.09</font>
 để mua hàng và được giao hàng nhanh nhất.
>>hệ thống của tôi không áp dụng thanh toán thông qua thẻ chuyển khoản.
 vì muốn có sự rõ ràng trong khâu giao hàng và thanh toán,với tiêu chí
"sản phẩm đến tay khách hàng ngay khi khách hàng thanh toán".
>>rất mong được hợp tác của bạn.
>>chúc bạn vui vẽ và hài lòng với sản phẩm của chúng tôi.</font> 
</pre>