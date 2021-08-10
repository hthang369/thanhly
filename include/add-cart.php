<?php
include_once "connect.php";
include "include/chitiet-giohang.php";

if (!isset($_SESSION)) session_start();
//unset($_SESSION["cart"]);//Xoa tat ca gio hang
if (isset($_SESSION["cart"]))
  $cart = $_SESSION["cart"]; //cart: Bien trung gian
else
  $cart = array();//Chua co gio hang,tao gio hang rong
  
  $masp = isset($_REQUEST["id"])?$_REQUEST["id"]:"";
  $soluong =isset($_REQUEST["soluong"])?$_REQUEST["soluong"]:1;
  $action2 = isset($_REQUEST["action2"])?$_REQUEST["action2"]:"";
  $soluong = floor($soluong *1);
  /*soluong=1.5 => chuyen thanh 1.
  $soluong *1: neu soluong='a1' => soluong *1 = 0.
  */
  
  if ($soluong<0) $soluong=0;
  
  if ($action2=="add")
  {
	  themSP($masp, $soluong, $cart);
	  
  }
  if ($action2=="del")
  {
	  xoaSP($masp, $cart);
  }

  if ($action2=="update")
  {
	  updateSP($masp, $soluong, $cart);
  }
$_SESSION["cart"] = $cart;
//  print_r($_SESSION["cart"]);//In de debug gio hang

InGioHang($cart);
?>
<hr>
<a href="index.php">Mua Tiếp</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="include/thanhtoan.php">Thanh Toán</a>
