<div class="card">
<div id="td1" class="card-header bg-primary py-2 mt-2">LƯỢT TRUY CẬP</div>
<table width="195">
  <tr>
    <td >
    <div align="center"><div id="clock"></div> <?php

if ( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) )

{

$X_FORWARDED_FOR=explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);

$REMOTE_ADDR=trim($X_FORWARDED_FOR[0]); //lấy giá trị đầu tiên
} else {

$REMOTE_ADDR=$_SERVER['REMOTE_ADDR'];

}
$PHP_SELF=$_SERVER['PHP_SELF'];

$tg=time();

$tgout=600;

$tgnew=$tg - $tgout;

include"connect.php";
$now=date("Y-m-d");
$nowht = gmdate("H:i:s", $tg + 7*3600);
$sql1=mysql_query("insert into useronline(tgtmp,ip,local,time) values('$tg','$REMOTE_ADDR','$PHP_SELF','$nowht')");
$sql2="delete from useronline where tgtmp < $tgnew";

$query2=mysql_query($sql2);

$sql3=mysql_query("SELECT DISTINCT ip FROM useronline");

$user = mysql_num_rows($sql3);
echo "<div style=\"text-align:left;\">đang online: $user<br/></div>";

$home=mysql_query("select count(*) as tong from counter_online where date='$now'");
$home1=mysql_fetch_array($home);
$home2=$home1['tong'];

echo"<div style=\"text-align:left;\">online hôm nay: $home2</div>";


$kt=mysql_query("select count(*) from useronline where ip='$REMOTE_ADDR'");
$us=mysql_fetch_array($kt);
if($us[0]==1)
{
$sql4=mysql_query("insert into counter_online(counter,date) values('1','$now')");

}
$home=mysql_query("select count(*) as tong from counter_online where date <'$now'");
$home1=mysql_fetch_array($home);
$home2=$home1['tong'];

$sql51=mysql_query("SELECT * FROM tongonline");
$rt=mysql_fetch_array($sql51);
$tt=$rt['sum'];
echo"<div style=\"text-align:left;\">tổng số truy cập: $tt</div>";

if($home2 >0)
{
$sqltt=mysql_query("update tongonline set sum=$tt + $home2, date='$now'");
$sqldd=mysql_query("DELETE FROM counter_online where date < '$now'");
}
?>
    </div><br></td>
  </tr>
</table>
</div>