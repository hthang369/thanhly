<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="script/boxover.js"></script>
<style type="text/css">
.tr1 td{text-align:center; background-color:#c8dbf0; border-right:1px solid #333; height:30px; width:25px;}
.tr2 td{text-align:center; border-bottom:1px solid #333; border-right:1px solid #333; height:25px;}
</style>
<?php  ?>
<div class="inserttop">Thông tin khuyến mãi</div>
<div class="insertcen"><table width="100%" cellspacing="0" cellpadding="0">
<tr class="tr1"><td width="25" style="border-left:1px solid #333;">STT</td><td>Nội dung</td></tr>
<?php $now=date("Y-m-d");
$sql=mysql_query("select * from khuyenmai") or die("lỗi truy vấn d12");
while($row=mysql_fetch_array($sql))
{	
	if($now >= $row["ngaybatdau"] && $row["ngayketthuc"] >= $now) {?>
  <tr class="tr2">
    <td style="border-left:1px solid #333;"><?php echo $row["id_khuyenmai"]; ?></td>
    <td><?php echo $row['thongtin']; ?></td>
  </tr>
<?php }
}?>
</table>
</div>
