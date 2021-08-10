<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="../script/jquery-ui-1.8.9.custom.js"></script>
<link href="../styles/jquery-ui-1.8.9.custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    $(function() {
		$( "#ngcn" ).datepicker({
			showOn: "button",
			buttonImage: "../images/calendar.gif",
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd'
		});
	});

	</script> 
<div class="inserttop">Thêm tin tức</div>
<div class="insertcen">
<form name="form1" method="post" action="include/xl_insert.php?act=intt" enctype="multipart/form-data">
  <table width="80%" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>tiêu đề</td>
      <td>
        <input name="td" type="text" id="td" size="30"></td>
    </tr>
    <tr>
      <td>Ngày cập nhật</td>
      <td>
        <input name="ngcn" type="text" id="ngcn" size="30"></td>
    </tr>
    <tr><td colspan="2">Nội dung:</td></tr>
    <tr>
    <td colspan="2" style="padding-left: 10px">
    <?php
	include("fckeditor/fckeditor.php") ;
	$oFCKeditor = new FCKeditor('ndtt') ;
	$oFCKeditor->BasePath = '../admintnit/fckeditor/' ;
	$oFCKeditor->Value = '' ;
	$oFCKeditor->Create() ;
	?>
    </td>
  </tr>
	  <tr>
      <td>ghi chú</td>
      <td>
        <input name="gc" type="text" id="gc" size="30"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="gui" class="button" id="gui" value="Gửi" onMouseMove="style.background='url(../images/button-2-o.gif)'" onMouseOut="style.background='url(../images/button-o.gif)'"><input type="reset" name="Reset" class="button" id="button" value="Nhập lại" onMouseMove="style.background='url(../images/button-2-o.gif)'" onMouseOut="style.background='url(../images/button-o.gif)'">
      </td>
    </tr>
  </table>
  </form>
</div>
