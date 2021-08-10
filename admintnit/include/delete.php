<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include "../connect.php";
function del_sp($ma)
{
	$sql=mysql_query("delete from sanpham where id_sp='$ma'"); 
	if(!$sql)
		echo "<script>alert('Có lỗi trong quá trình xử lý!');window.history.go(-1);</script>";
	else
		echo "<script>alert('Đã xóa thành công!');window.history.go(-1);</script>";
}
function del_sphome($masphome)
{
	$sql=mysql_query("delete from baiviet where id_baiviet='$masphome'"); 
	if(!$sql)
		echo "<script>alert('Có lỗi trong quá trình xử lý!');window.history.go(-1);</script>";
	else
		echo "<script>alert('Đã xóa thành công!');window.history.go(-1);</script>";
}

function del_lh($malh)
{
	$sql2=mysql_query("delete from lienhe where id_lienhe='$malh'");
	if(!$sql2)
			echo "<script>alert('Có lỗi trong quá trình xóa!');window.history.go(-1);</script>";
		else
			echo "<script>alert('Đã xóa thành công!');window.history.go(-1);</script>";
}
function del_hieu($mah)
{
	$check=mysql_query("select count(*) from sanpham where id_hieu='$mah'") or die("lỗi truy vấn");
	$r1=mysql_fetch_array($check);
	if($r1[0]!=0)
		echo "<script>alert('Không thể xóa vì có sản phẩm thuộc hiệu sản phẩm này!!');window.history.go(-1)';</script>";
	else
	{
		$sql3=mysql_query("delete from hieu where id_hieu='$mah'");
		if(!$sql3)
			echo "<script>alert('Có lỗi trong quá trình xóa!');window.history.go(-1);</script>";
		else
			echo "<script>alert('Đã xóa thành công!');window.history.go(-1);</script>";
	}
}
function del_lsp($mal)
{
       $sql4=mysql_query("delete from loaisanpham where id_loai='$mal'");
		if(!$sql4)
			echo "<script>alert('Có lỗi trong quá trình xóa!');window.history.go(-1);</script>";
		else
			echo "<script>alert('Đã xóa thành công!');window.history.go(-1);</script>";

}
function del_tv($matv)
{
	$sql5=mysql_query("delete from thanhvien where user='$matv'");
	if(!$sql5)
		echo "<script>alert('Có lỗi trong quá trình xóa!');window.history.go(-1);</script>";
	else{
		$n=mysql_affected_rows($sql5);
		echo "<script>alert('Đã xóa thành công $n thành viên!');window.history.go(-1);</script>";
	}
}

function del_hd($mahd)
{
	$sql6=mysql_query("delete from chitiethoadon where id_hoadon='$mahd'") or die ("lỗi xóa cthd");
	$sql7=mysql_query("delete from hoadon where id_hoadon='$mahd'");
	if(!$sql7)
		echo "<script>alert('Có lỗi trong quá trình xóa hd!');window.history.go(-1);</script>";
	else{
		$n=mysql_affected_rows($sql7);
		echo "<script>alert('Đã xóa thành công $n hóa đơn!');window.history.go(-1);</script>";
	}
}

function del_km($makm)
{
	$sql5=mysql_query("delete from khuyenmai where id_khuyenmai='$makm'");
	if(!$sql5)
		echo "<script>alert('Có lỗi trong quá trình xóa!');window.history.go(-1);</script>";
	else{
		$n=mysql_affected_rows($sql5);
		echo "<script>alert('Đã xóa thành công $n');window.history.go(-1);</script>";
	}
}

function del_tt($matt)
{
//$s= "delete from tintuc where id_tintuc='$matt' ";
//echo $s;
//exit;
	$sql5=mysql_query("delete from tintuc where id_tintuc='$matt'");
	print_r($sql5);
	
	if(!$sql5)
		echo "<script>alert('Có lỗi trong quá trình xóa!');window.history.go(-1);</script>";
	else{
		$n=mysql_affected_rows($sql5);
		echo "<script>alert('Đã xóa thành công $n');window.history.go(-1);</script>";
	}
}

$act=$_REQUEST["act"];
if($act=="del_sp")
{
	$ma=$_REQUEST["idsp"];
	del_sp($ma);
}
if($act=="del_sphome")
{
	$masphome=$_REQUEST["idsphome"];
	del_sphome($masphome);
}
if($act=="del_lh")
{
	$malh=$_REQUEST["idlh"];
	del_lh($malh);
}
if($act=="del_tv")
{
	$matv=$_REQUEST["idtv"];
	del_tv($matv);
}
if($act=="del_km")
{
	$makm=$_REQUEST["idkm"];
	del_km($makm);
}
if($act=="del_tt")
{
	$matt=$_REQUEST["idtt"];
	del_tt($matt);
}
if($act=="del_lsp")
{
	$mal=$_REQUEST["idl"];
	del_lsp($mal);
}
if($act=="del_hsp")
{
	$mah=$_REQUEST["idh"];
	del_hieu($mah);
}
if($act=="del_hd")
{
	$mahd=$_REQUEST["idhd"];
	del_hd($mahd);
}
?>