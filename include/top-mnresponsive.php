
<?php 
$active = !isset($_SERVER['REDIRECT_URL']) ? 'active' : '';
$activeBG = isset($_SERVER['REDIRECT_URL']) && str_contains($_SERVER['REDIRECT_URL'], 'bao-gia') ? 'active text-danger' : '';
$activeGT = isset($_SERVER['REDIRECT_URL']) && str_contains($_SERVER['REDIRECT_URL'], 'gioi-thieu') ? 'active text-danger' : '';
$activeDV = isset($_SERVER['REDIRECT_URL']) && str_contains($_SERVER['REDIRECT_URL'], 'dich-vu') ? 'active text-danger' : '';
$activeLH = isset($_SERVER['REDIRECT_URL']) && str_contains($_SERVER['REDIRECT_URL'], 'lien-he') ? 'active text-danger' : '';
$activeTT = isset($_SERVER['REDIRECT_URL']) && str_contains($_SERVER['REDIRECT_URL'], 'tin-tuc') ? 'active text-danger' : '';

$result = mysql_query("select * from baiviet") or die ("lỗi bài viết");
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary py-1">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link <?php echo $active; ?> " href="">TRANG CHỦ</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link <?php echo $activeBG; ?> " href="bao-gia">BÁO GIÁ</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link <?php echo $activeGT; ?> " href="gioi-thieu">GIỚI THIỆU</a>
      </li>
      <li class="nav-item dropdown d-block d-sm-none">
        <a class="nav-link  <?php echo $activeDV; ?> dropdown-toggle " id="navDichVu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">DỊCH VỤ</a>
        <div class="dropdown-menu" aria-labelledby="navDichVu">
        <?php
          while($bv=mysql_fetch_array($result))
          {
          ?>
              <a class="dropdown-item" href="dich-vu/<?=khongdau($bv[1]);?>-<?php echo $bv[0]?>.html"><?php echo $bv[1];?></a>
            <?php } ?>
        </div>
      </li>
       <li class="nav-item ">
        <a class="nav-link <?php echo $activeTT; ?> " href="tin-tuc">TIN TỨC</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link <?php echo $activeLH; ?> " href="lien-he">LIÊN HỆ VỚI CHÚNG TÔI </a>
      </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
