<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../script/jquery-1.6.4.js"></script>
<script type="text/javascript" src="../script/jquery-ui-1.8.9.custom.js"></script>
<link href="../styles/jquery-ui-1.8.9.custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    $(function() {
		$( "#ngbd" ).datepicker({
			showOn: "button",
			buttonImage: "../images/calendar.gif",
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd'
		});
	});
	$(function() {
		$( "#ngkt" ).datepicker({
			showOn: "button",
			buttonImage: "../images/calendar.gif",
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd'
		});
	});
	</script> 
<div class="inserttop">Thêm thông tin khuyến mãi</div>
<div class="insertcen">
<form name="form1" method="post" action="include/xl_insert.php?act=inkm">
  <table width="80%" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>Thông tin khuyến mãi</td>
      <td>
        <input name="tt" type="text" id="tt" size="30"></td>
    </tr>
    <tr>
      <td>Ngày bắt đầu</td>
      <td>
        <input name="ngbd" type="text" id="ngbd" size="30"></td>
    </tr>
    <tr>
      <td>Ngày kết thúc</td>
      <td>
        <input name="ngkt" type="text" id="ngkt" size="30"></td>
    </tr>
	  <tr>
      <td>trị số trừ khuyến mãi</td>
      <td>
        <input name="tstkm" type="text" id="tstkm" size="30"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="gui" class="button" id="gui" value="Gửi" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'"><input type="reset" name="Reset" class="button" id="button" value="Nhập lại" onmousemove="style.background='url(../images/button-2-o.gif)'" onmouseout="style.background='url(../images/button-o.gif)'">
      </td>
    </tr>
  </table>
  </form>
</div>