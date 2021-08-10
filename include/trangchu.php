<?php $b= isset($_REQUEST["b"])?$_REQUEST["b"]:"home";
	$filein = "include/content.php";
	if($b=="lsp")
		$filein = "include/loaisp.php";
    if($b=="bgia")
		$filein = "include/baogia.php";
	if($b=="ttsanpham")
	    $filein = "include/thongtinsanpham.php";	
	if($b=="hsp")
		$filein = "include/hieusp.php";
	if($b=="ctsp")
		$filein = "include/chitiet-sp.php";
	if($b=="dk")
		$filein = "include/register.php";
	if($b=="ctgh")
		$filein = "include/add-cart.php";
	if($b=="km")
		$filein = "include/khuyenmai.php";
	if($b=="lh")
		$filein = "include/lienhe.php";
	if($b=="dangky")
		$filein = "include/register.php";
	if($b=="quenmk")
		$filein = "include/quenpass.php";
	if($b=="ttcn")
		$filein = "include/thongtinct.php";
	if($b=="tkiem")
		$filein = "include/xl_timkiem.php";
	if($b=="gt")
		$filein = "include/gioithieu.php";
	if($b=="doimk")
		$filein = "include/doipass.php";
	if($b=="doittcn")
		$filein = "include/doittcn.php";
	if($b=="tintuc")
		$filein = "include/ndtintuc.php";
	if($b=="dstin")
		$filein = "include/dstintuc.php";
	if($b=="bv")
		$filein = "include/ndbaiviet.php";
	include_once $filein;
		 ?>