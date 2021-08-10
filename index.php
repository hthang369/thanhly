<?php 
 include "include/session.php"; 
 require_once('connect.php');
 require_once("include/loadtitle.php");
 require_once("include/loaddes.php");
 require_once("include/loadurlimage.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TBXPKH');</script>
<!-- End Google Tag Manager -->
<base href="<?php echo get_domain_url(); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<link rel="shortcut icon" href="images/lovnn.png"/>
<meta name="description" content="<?php echo $des;?>" />
<meta property="og:description" content="<?php echo $des;?>" />
<meta property="og:image" content="<?php echo $urlimg;?>" />
<meta name="robots" content="index,follow">
<meta name="google-site-verification" content="zI3vsq7rWsWjiebX3l8K4WJlkSBz9YfqyscopeOA0zA" />
<meta name="google-site-verification" content="FajRaFki8PQoWbfTJs8mkYJNWePVY-sn5yrxOJIdHA0" />
<link href="https://plus.google.com/u/0/106207560550320331725" rel="author" />
<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="styles/style.css" />

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="script/bootstrap.min.js" type="text/javascript"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-33467087-1', 'auto');
  ga('send', 'pageview');

</script>

</head>
<body id="body">

<section class="container-fluid">
   <header class="container">
      <div id="iHeader" class="row"><?php include "include/banner.php"; ?></div>      
   </header>
   <nav class="bg-primary">
      <div id="iTopmenu" class="container"><?php include "include/top-mnresponsive.php"; ?></div>
   </nav>
   <content class="d-block container">
      <div class="row">
      <div id="iLeftmenu" class="col-3 d-none d-sm-block p-0 mt-2 text-light">
            <?php include "include/menuleft.php"; ?>   
            <?php include "include/menusp.php"; ?>
            <?php include "include/menu-sptb.php"; ?>
            <?php include "include/hotro.php"; ?>
             <?php include "include/counter.php"; ?>
         </div>
         <div id="iContent" class="col-md-9 col-sm-12 mt-2 pr-0">         
         <div class="card-body p-2"><?php include "include/menuslide.php"; ?></div>
            <div class="card">
            <?php include "include/trangchu.php"; ?>
            </div>
         </div>
      </div>
   </content>
   <footer class="container mt-2">
      <div id="iFooter"><?php include "include/footer_menu.php"; ?></div>
   </footer>

<div id="lkw" class="text-center">
<?php include "include/lienketweb.php"; ?>
</div>

<div><a style="position: fixed; Bottom: 55px; right: 9px;" href="#" title="Về đầu trang">
<img src="images/btnfirst.png"/></a>
<a style="position: fixed; Bottom: 5px; right: 9px;" href="javascript:scroll(0,9999999)" title="Xuống cuối trang">
<img src="images/btnlast.png"/></a>
</div>
</section>
<style>
#floating-phone { background-image:url(images/callhotline.png); display: none; position: fixed; left: 10px; bottom: 20px; height: 70px; width: 70px;  z-index: 99; font-size: 35px; line-height: 55px; text- align: center; border-radius: 50%; -webkit-box-shadow: 0 2px 5px rgba(0,0,0,.5); -moz-box-shadow: 0 2px 5px rgba(0,0,0,.5); box-shadow: 0 2px 5px rgba(0,0,0,.5); }
@media all and (min-width: 320px) { 
#floating-phone { display: block; } 
}
</style>
<a href="tel:0976112209" title="Gọi Hotline" onClick="_gaq.push(['_trackEvent', 'Contact', 'Call Now Button', 'Phone']);" id="floating-phone">
<i class="uk-icon-phone"></i></a>
<?php include "include/chatfb.php"; ?>
</body>

</html>