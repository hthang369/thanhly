<script type="text/javascript">
	function check()
	{
		var thongbao=window.confirm("Bạn có chắc muốn xóa sản phẩm này!");
		if(thongbao==true)
			return true;
		else
			return false;
	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
$size=20;
$dem=mysql_query("select count(*) from baiviet") or die ("lỗi truy vấn");
$r=mysql_fetch_array($dem);
$num=$r[0];
$count=ceil($num/$size);
if (!isset($_GET["curr"]))
	$curr=1;
else
	$curr=$_GET["curr"];
$p=($curr-1)*$size;
 ?>
<div class="inserttop">Danh sách bài viết</div>
<div class="insertcen"><table cellpadding="0" cellspacing="0">
  <tr class="tr1">
    <td style="border-left:1px solid #333;" width="330px">Tiêu đề bài viết</td>
       <td width="auto">Ghi chú</td>
       <td width="50px">Sửa</td>
    <td width="50px">Xóa</td>
  </tr>
<?php $now=date('Y-m-d');
$sql=mysql_query("select * from baiviet limit $p,$size") or die("loi truy vấn");
while($row=mysql_fetch_array($sql))
{   $masphome=$row["id_baiviet"];
	$tieude=$row["tieude"];
	$mota=(strlen($row["noidung"])<=80?$row["noidung"]:substr($row["noidung"],0,80)."...");
	$ghichu=$row["ghichu"];
	echo "<tr class=\"tr2\"><td style=\"border-left:1px solid #333;\">$tieude</td>
	<td>$ghichu</td>
	<td><a href='?b=sphome&m=upsphome&masphome=$masphome' >Sửa</a></td>
	<td><a href='include/delete.php?idsphome=$masphome&act=del_sphome' onclick='return check()' >Xóa</a></td></tr>";
}
 ?>
</table>
</div>
<hr />
<?php  
if($count>1)
{echo "<div class=pagination><b>Chọn trang: ";
	for ($i=1;$i<=$count;$i++)
	{
		if($curr==$i)
			echo "<span class='current'>$i</span>";
		else
			echo "<span class='curr'><a href=\"index.php?b=sphome&m=dssphome&curr=$i\">$i</a>&nbsp;&nbsp;</span>";
	}
		
	echo "</div>";
}?>