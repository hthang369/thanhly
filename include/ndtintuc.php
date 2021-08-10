<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php 
$idx=$_REQUEST["idtt"];
$idtt1 = explode('-',$idx);
$id =end($idtt1);
$now=date('Y-m-d');
$sql=mysql_query("select * from tintuc where id_tintuc='$id'") or die ("loi db");
$row=mysql_fetch_array($sql);
$idtin = $row["id_tintuc"];
$ndtin=$row["noidung"];
$tieude = $row["tieude"];
$ngayup=$row["ngay_up"];
 ?>

 <div class="card-header py-2">Nội dung tin tức</div>
 <div class="card-body">
      <h4 class="card-title"><font color="#0000CC"><?php echo $tieude; ?></font></h4>
	  <p class="card-text">Ngày cập nhật:<?php echo $ngayup;?></p>
      <p class="card-text"><?php echo $ndtin; ?></p>
</div>
