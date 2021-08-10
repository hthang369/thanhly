<script type="text/javascript" src="script/boxover.js"></script>
<div class="card">
	<div class="card-header bg-primary py-2 mt-2" id="td1">SẢN PHẨM TIÊU BIỂU</div>
	<div class="list-group list-group-flush" id="demotn">
	<?php $sql=mysql_query("select * from sanpham order by rand() limit 0,10") or die ("loi db");
		while($ro=mysql_fetch_array($sql))
		{
			//echo "<img src=\"images/sanpham/small/$row[hinhanh]\" />";
		$tensp=$ro["tensp"];$mota=$ro["mota"];
		$gia=number_format($ro["giaban"],0,'','.');
	?>
		<div class="list-group-item px-0" id="demotn1">
			<div class="card">
				<a href="san-pham/<?=khongdau($tensp)?>-<?php echo $ro[0]?>.html">
					<img class="card-img-top" src="images/sanpham/small/<?php echo $ro["hinhanh"] ?>" width="170" height="150" />
				</a>
				<div class="card-body">
					<h5 class="card-title">
						<a href="san-pham/<?=khongdau($tensp)?>-<?php echo $ro[0]?>.html">
							<?php echo $tensp ?>
						</a>
					</h5>
					<p class="card-text">
						<a href="san-pham/<?=khongdau($tensp)?>-<?php echo $ro[0]?>.html">
							<?php echo $gia." VNĐ" ?>
						</a>
					</p>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php	
		$sql=mysql_query("select * from sanpham order by rand() limit 0,10") or die ("loi db");
		while($ro=mysql_fetch_array($sql))
		{
			//echo "<img src=\"images/sanpham/small/$row[hinhanh]\" />";
		$tensp=$ro["tensp"];$mota=$ro["mota"];
		?>
		<div class="list-group-item px-0" id="demotn2">
			<div class="card">
				<a href="san-pham/<?php echo khongdau($tensp); echo -$ro[0]; ?>.html">
					<img class="card-img-top" src="images/sanpham/small/<?php echo $ro["hinhanh"] ?>" width="170" height="150" />
				</a>
				<div class="card-body">
					<h5 class="card-title">
						<a href="san-pham/<?php echo khongdau($tensp); echo -$ro[0]; ?>.html">
							<?php echo $tensp; ?>
						</a>
					</h5>
					<p class="card-text">
						<a href="san-pham/<?=khongdau($tensp)?>-<?php echo $ro[0]?>.html">
							<?php echo $ro['giaban']." VNĐ" ?>
						</a>
					</p>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>
</div>

<script>
var speed=20;
var demotn1 = $('#demotn1');
var demotn2 = $('#demotn2');
var demotn = $('#demotn');
demotn2.innerHTML=demotn1.innerHTML
function Marquee(){
	if(demotn2.offsetHeight-demotn.scrollTop<=0)
		demotn.scrollTop-=demotn1.offsetHeight;
	else{
		demotn.scrollTop++;
	}
}
	var MyMar=setInterval(Marquee,speed)
	demotn.onmouseover=function() 
	{clearInterval(MyMar)}
	demotn.onmouseout=function() 
	{MyMar=setInterval(Marquee,speed)}
</script>