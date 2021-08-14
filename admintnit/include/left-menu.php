<div class="qlmn">Nhóm &amp; Loại sản phẩm</div>
<div id="Accordion1" class="Accordion" tabindex="0">
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">Nhóm sản phẩm</div>
    <div class="AccordionPanelContent">
      <a href="index.php?b=home&m=innsp">&raquo; Thêm nhóm sản phẩm</a><br />
      <a href="index.php?b=home&m=dsnsp">&raquo; Danh sách nhóm sản phẩm</a>
    </div>
  </div>
<div class="AccordionPanel">
    <div class="AccordionPanelTab">Loại sản phẩm</div>
    <div class="AccordionPanelContent"><a href="index.php?b=home&m=inlsp">&raquo; Thêm loại sản phẩm</a><br />
      <a href="index.php?b=home&m=lsp">&raquo; Danh sách loại sản phẩm</a></div>
  </div>
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">Loại SP theo nhóm</div>
    <div class="AccordionPanelContent"><?php 
	$sql=mysql_query("select * from nhomsanpham") or die ("loi db");
	while ($row = mysql_fetch_array($sql))
	{
	    $man=$row[0];
		echo "<a href='?b=home&m=dslnsp&idn=$man'>&raquo; $row[1]</a><br>";
	}
	 ?></div>
  </div>
</div>
<script type="text/javascript">
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
</script>
