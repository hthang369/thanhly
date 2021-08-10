
<div id="cont" class="card-body">
<?php

$sqlch=mysql_query('select * from noidunghome');
$rch=mysql_fetch_array($sqlch);
echo stripslashes($rch['noidung']);
?>
</div>
<iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=450&layout=standard&action=like&size=small&share=true&height=35&appId=604707156661427" width="400" height="35" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_google_plusone" title="Chia sẽ lên Google+"></a>
<a class="addthis_button_twitter" title="Chia sẽ lên Twitter"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>

