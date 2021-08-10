<?php 
$idx=$_REQUEST["idbv"];
$idbv1 = explode('-',$idx);
$id =end($idbv1);
$now=date('Y-m-d');;
$sql=mysql_query("select * from baiviet where id_baiviet='$id'") or die ("loi db");
$row=mysql_fetch_array($sql);
$idbv = $row["id_baiviet"];
$ndbv=$row["noidung"];
$tieude = $row["tieude"];
$ghichu=$row["ghichu"];
 ?>
<div class="card-header py-2 bg-primary "><?php echo $tieude; ?></div>
<div id="cont" class="card-body"><?php echo stripslashes($ndbv);?></div>
<div class="fb-share-button" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" >Chia sẻ</a></div>
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_google_plusone" title="Chia sẽ lên Google+"></a>
<a class="addthis_button_twitter" title="Chia sẽ lên Twitter"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script  type="text/javascript"  src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e344ae31e7ef1cc"></script>

