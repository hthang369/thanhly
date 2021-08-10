<?php  
  $result = mysql_query("select * from baiviet order by id_baiviet") or die ("lỗi bài viết");
?>
<div class="card">
  <div class="card-header bg-primary py-2" id="td1">DỊCH VỤ</div>
  <ul class="nav flex-column">
  <?php
	while($bv=mysql_fetch_array($result))
	{
   ?>
    <li class="nav-item">
      <a class="nav-link Width 25%" href="dich-vu/<?=khongdau($bv[1]);?>-<?php echo $bv[0]?>.html"><?php echo $bv[1];?></a>
    </li>
    <?php } ?>
  </ul>
</div>


