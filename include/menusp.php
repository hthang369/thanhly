<?php  

  $result = mysql_query("select * from nhomsanpham") or die ("error database nsp !");
?>
<div class="card">
  <div id="td1" class="card-header bg-primary py-2 mt-2">SẢN PHẨM</div>
  <ul id="qm0" class="nav flex-column">
<?php
	while($nsp=mysql_fetch_array($result))
	{
    $sql =mysql_query("select * from loaisanpham where id_nhom=$nsp[0]") or die ("error database lsp !");
   ?>
    <li class="nav-item dropright">
      <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo $nsp[1]; ?></a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <?php while($lsp=mysql_fetch_array($sql)) 
      {?>
        <a class="dropdown-item qmloai" href="danh-muc/<?php echo khongdau($lsp[1]).$lsp[0]; ?>.html">
          <?php echo $lsp[1]; ?>
        </a><?php } ?>  
      </div>
    </li>
<?php } ?>  
  </ul>
</div>
