<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../script/jquery-ui-1.8.9.custom.js"></script>
<script type="text/javascript" src="../../script/jquery-1.6.4.js"></script>
<link href="../styles/jquery-ui-1.8.9.custom.css" type="text/css" rel="stylesheet">
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
<div class="inserttop">Danh sách thông tin đơn hàng đang chờ giải quyết</div>
<div class="insertcen">
<table width="100%" cellpadding="0" cellspacing="0">
  <tr class="tr1">
    <td style="border-left:1px solid #333;">Họ tên</td>
    <td >Ngày đặt</td>
    <td >Tổng tiền</td>
    <td>Xem</td>
    <td >Xóa</td>
  </tr>
<?php 
$sql=mysql_query("select * from hoadon where ngaygiao is NULL") or die("loi truy vấn");
while($row=mysql_fetch_array($sql))
{$mahd=$row["id_hoadon"];
	$sq=mysql_query("select * from chitiethoadon where id_hoadon='$mahd'") or die("loi truy vấn");
	$ro=mysql_fetch_array($sq);
	 ?>
    <form action="include/xl_update.php?act=uphd" method="post" name="frm<?php echo $mahd;?>" enctype="multipart/form-data">
	  <tr class="tr2"><td style="border-left:1px solid #333;"><?php echo $ro["hoten"]; ?></td>
		<td><?php echo $row["ngaylap"] ?></td>
		<td><?php echo $row["tongtien"] ?></td>
		<td><a href='?b=hd&m=cthd&idhd=<?php echo $mahd; ?>'> Xem</a></td>
		<td><a href='include/delete.php?idhd=<?php echo $mahd; ?>&act=del_hd' onclick='return check()' >Xóa</a></td></tr></form>
	<?php 
}
 ?></table></div>