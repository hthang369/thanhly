<div>
<div id="td1"><div style="padding-top:10px; padding-left:70px;">GIỎ HÀNG</div></div>
<table width="195">
  <tr>
    <td>&raquo;Số Sản Phẩm Bạn Đã Chọn Mua:
    <?php 
	echo isset($_SESSION["cart"])?count($_SESSION["cart"]):0;
?><br>
    <div class="b"><a href="index.php?b=ctgh">&raquo;Xem Giỏ Hàng Của Bạn</a></div><br></td>
  </tr>
</table>
</div>