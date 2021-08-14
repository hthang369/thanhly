<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../script/jquery-ui-1.8.9.custom.js"></script>
<link href="../styles/jquery-ui-1.8.9.custom.css" rel="stylesheet" type="text/css" /><!--đổi theme màu xám cho lịch-->
<script type="text/javascript">
    $(function() {
		$( "#ngayup" ).datepicker({
			showOn: "button",
			buttonImage: "../images/calendar.gif",
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd'
		});
	});
	</script> 
<script src="ckeditor/ckeditor.js"></script>    
<div class="inserttop">Thêm bài viết cho danh mục</div>
<div class="insertcen">
<form action="include/xl_insert.php?act=insanphamhome" method="post" enctype="multipart/form-data" name="form1" id="form1" target="_blank">
<table>
  <tr><td>Tiêu đề bài viết:</td>
  <td><input type="text" name="tieudebv"  /></td>
  </tr>
  <tr><td colspan="3">Mô tả:</td></tr>
  <tr><td colspan="3" style="padding-left: 10px">
  <textarea name="ndbaiviet" id="ndbaiviet"></textarea>
    </td>
  <tr><td>Ghi chú:</td>
  <td><input type="text" name="ghichu"  /></td>
  </tr>
  </tr>
  <tr>
    <td id="td1" colspan="2"><input class="button" type="submit" name="them" value="Thêm" onmousemove="style.background='url(../../images/button-2-o.gif)'" onmouseout="style.background='url(../../images/button-o.gif)'" />
    <input class="button" type="reset" name="xoa" value="Xóa" onmousemove="style.background='url(../../images/button-2-o.gif)'" onmouseout="style.background='url(../../images/button-o.gif)'" /></td></tr>
</table></form></div>
<div id="insertbot"></div>
<script>
   CKEDITOR.replace('ndbaiviet');
</script>