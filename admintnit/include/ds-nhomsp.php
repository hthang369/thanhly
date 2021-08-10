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
<div class="inserttop">Danh sách nhóm sản phẩm</div>
<div class="insertcen">
<?php include "../connect.php"; ?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr class="tr1"><td style="border-left:1px solid #333;">Tên nhóm</td><td>Sửa</td><td>Xóa</td></tr>
<?php $now=date('Y-m-d');  $sql=mysql_query("select * from nhomsanpham") or die ("loi db");
while($r=mysql_fetch_array($sql))
{
    $man=$r[0];
	echo "<tr class='tr2'><td style=\"border-left:1px solid #333;\">$r[1]</td><td><a href=\"?b=home&m=upnsp&idn=$man\" >Sửa</a></td><td><a href=\"include/delete.php?idn=$man&act=del_nsp\" onclick='return check()' >Xóa</a></td></tr>";
}?>
</table>
</div>
