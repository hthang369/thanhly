<div id="td1" class="card-header">TIN TỨC CÔNG NGHỆ</div></div>
<div class="card-body">
	<div class="nav flex-column">
	<?php 
	$sql=mysql_query("select * from tintuc order by rand() limit 0,7") or die ("loi db");

	while($row=mysql_fetch_array($sql))
	{
		$tieude=$row["tieude"];
	?>
		<div class="nav-item">
        <a class="nav-link" href="tin-tuc/<?=khongdau($tieude)?>-<?php echo $row[0]?>.html"><font size="3"><img src="images\mt.gif"><?php echo $row[3]; ?></img></font></a><br><br>
		</div>
	<?php
    }
	?>
	</div>
</div>
