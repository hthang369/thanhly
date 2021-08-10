<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../script/jquery-ui-1.8.9.custom.js"></script><!--hổ trợ lấy ngày tháng trên lịch(datepicker)-->
<link href="../styles/jquery-ui-1.8.9.custom.css" type="text/css" rel="stylesheet"><!--màu nền xám của datepicker-->
<script type="text/javascript">
	function check()
	{
		var thongbao=window.confirm("Bạn có chắc muốn xóa đơn hàng này!");
		if(thongbao==true)
			return true;
		else
			return false;
	}
	$(function() {
		$( ".ngga" ).datepicker({
			showOn: "button",
			buttonImage: "../images/calendar.gif",
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
<div class="inserttop">Danh sách thông tin chi tiết đơn hàng</div>
<div class="insertcen"><table width="100%" cellpadding="0" cellspacing="0">
  <tr class="tr1">
    <td style="border-left:1px solid #333;">STT</td>
    <td>Tên sản phẩm</td>
    <td >Giá bán</td>
    <td >Số lượng</td>
    <td>Thành tiền (VNĐ)</td>
    <td>Sửa</td>
  </tr>
<?php 
$idhd=$_REQUEST["idhd"];
$sql=mysql_query("select * from hoadon where id_hoadon='$idhd'") or die("loi truy vấn");
$row=mysql_fetch_array($sql);
$sq=mysql_query("select * from chitiethoadon where id_hoadon='$idhd'") or die("loi truy vấn d25");
$i=0;
while($ro=mysql_fetch_array($sq))
{$masp=$ro{"id_sp"};	$i++; $ht=$ro["hoten"];
	$sq1=mysql_query("select * from sanpham where id_sp='$masp'") or die("loi truy vấn");
	$ro1=mysql_fetch_array($sq1); ?>
	<tr class="tr2"><td style="border-left:1px solid #333;"><?php echo $i; ?></td>
	<td><?php echo $ro1['tensp']; ?></td>
	<td><?php echo $ro['giaban']; ?></td>
	<td><?php echo $ro['soluong']; ?></td>
	<td><?php echo $ro['thanhtien']; ?></td>
	<td><a href="include/xl_update.php?act=upcthd&idsp=<?php echo $masp; ?>">Sửa</a></td>
	</tr> <?php	
}
 ?>
 <tr class="tr2"><td colspan="4" style="border-left:1px solid #333;">Tổng tiền:</td><td style="color:#F00" align="right" colspan="2"><?php echo number_format($row["tongtien"],0,'','.'); ?> VNĐ</td></tr>
 </table>
 <br />
 <?php  $sql=mysql_query("select * from hoadon where ngaygiao is NULL") or die("loi truy vấn");
$rowct=mysql_fetch_array($sql);
$mahd=$rowct["id_hoadon"];
 $sq2=mysql_query("select * from thanhvien where user='$ht'") or die("loi truy vấn d42");
 $ro2=mysql_fetch_array($sq2); ?>
 <table width="100%" cellspacing="0" cellpadding="0" bordercolor="#CCCCCC" border="1">
   <tr>
     <td style="color:#0CF; font-weight:bold;">Họ tên:</td>
     <td><?php echo $ro2["hoten"]; ?></td>
   </tr>
   <tr>
     <td style="font-weight:bold;">Email:</td>
     <td><?php echo $ro2["email"]; ?></td>
   </tr>
   <tr>
     <td style="font-weight:bold;">Địa chỉ:</td>
     <td><?php echo $ro2["diachi"]; ?></td>
   </tr>
   <tr>
     <td style="font-weight:bold;">Điện thoại:</td>
     <td><?php echo $ro2["dienthoai"]; ?></td>
   </tr>
 </table><br />
 <table class="tr2">
  	    <tr >
		<td>ngày lập:</td>
		<td><?php echo $row["ngaylap"] ?></td>
		</tr>
<form action="include/xl_update.php?act=uphd" method="post" name="frm<?php echo $mahd;?>" enctype="multipart/form-data">
		<tr>
		<td>ngày giao:</td>
		<td><input name='nggiao' class='ngga' type='text'/><input type="hidden" name="idhd" value="<?php echo $mahd;?>">  
		</tr>
		<tr> 		
		<td colspan="2" align="center"><a href="#" onclick="document.frm<?php echo $mahd; ?>.submit()">Duyệt</a></td>
		</tr></form>
 </table>
<a href="?b=hd&amp;m=dshd">Trở về</a></div>