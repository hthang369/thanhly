<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="card-header py-2">TIN TỨC</div>
<div class="card-body px-0">
<div class="nav flex-column">

  <?php include"connect.php";
  $sq=mysql_query("select * from tintuc") or die ("loi db");
  
  while ($rott=mysql_fetch_array($sq))
	{
		$tieude=$rott["tieude"];
	?>
  <div class="nav-item">
	  <a class="nav-link" href="tin-tuc/<?=khongdau($tieude)?>-<?php echo $rott[0]?>.html"><img src="images\mt.gif"><?php echo $rott[3]; ?></img></a>
  </div>
<?php
    }
	?>
  
  </div>
</div>