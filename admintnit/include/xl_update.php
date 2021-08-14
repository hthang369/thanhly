<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include "../../connect.php";
function update_lh($ma)
{
	$ten=$_REQUEST["ten"];
	$mail=$_REQUEST["mail"];
	$dc=$_REQUEST["dchi"];
	$dt=$_REQUEST["dient"];
	$nd=$_REQUEST["noid"];
	$nglh=$_REQUEST["nglh"];
	$sql=mysql_query("update lienhe set hoten='$ten', email='$mail', dienthoai='$dt', diachi='$dc', noidung='$nd', ngaylienhe='$nglh' where id_lienhe='$ma' ");
	if(!$sql)
		echo "<script>alert('1.Có lỗi trong lúc update!');window.history.go(-1);</script>";
	else
	{
		$n=mysql_affected_rows();
		echo "<script>alert('2.Đã update thành công $n thông tin liên hệ!');window.history.go(-2);</script>";
	}
}

function update_tv($matv)
{
	$user=$_REQUEST["mauser"];
	$pas=md5($_REQUEST["pass"]);
	$hten=$_REQUEST["ten"];
	$mail1=$_REQUEST["mail"];
	$dchi=$_REQUEST["dchi"];
	$dthoai=$_REQUEST["dient"];
	$capq=$_REQUEST["check"];
	$sql1=mysql_query("update thanhvien set pass='$pas',hoten='$hten',email='$mail1',diachi='$dchi',dienthoai='$dthoai',capquyen='$capq' where user='$matv'");
	if(!$sql1)
		echo "<script>alert('3.Có lỗi trong lúc update!');window.history.go(-1);</script>";
	else
	{
		$n=mysql_affected_rows($sql1);
		echo "<script>alert('4.Đã update thành công $n thông tin thành viên!');window.history.go(-2);</script>";
	}
}

function update_lsp($mal)
{
	$tenl=$_REQUEST["tenl"];
	$sql3=mysql_query("update loaisanpham set tenloai='$tenl' where id_loai='$mal'");
	if(!$sql3)
		echo "<script>alert('7.Có lỗi trong lúc update!');window.history.go(-1);</script>";
	else
	{
		$n=mysql_affected_rows($sql3);
		echo "<script>alert('8.Đã update thành công $n loại sản phẩm!');window.history.go(-2);</script>";
	}
}


function update_sp($masp)
{
   	$tensp=$_POST["tsp"];
	$msl=$_POST["loaisp"];
	$gsp=$_POST["gsp"];
	$mota=addslashes($_POST["mta"]);
	$triso=$_POST["triso"];
	$sl=$_POST["sl"];
	$baoh=$_POST["bhsp"];
	$km=$_POST["km"];
	$hinh=$_FILES["anh"];
	$hinhold=$_POST["oldimage"];
   
    if($_FILES["anh"]["name"]=='')
		 {
		 $sql11="update sanpham set id_sp='$masp',id_loai='$msl',id_khuyenmai=$km,tensp='$tensp',soluong='$sl',giaban='$gsp',hinhanh='$hinhold',mota='$mota',baohanh='$baoh',type='$triso' where id_sp='$masp'";	
$sql5=mysql_query($sql11);
print_r($sql11);
            if(!$sql5)
	           {
				 	echo $hinhold;			   
	           echo "<script>alert('10.Có lỗi trong lúc update!');window.history.go(-1);</script>";
	           }
	        else
	           {
	        	$n=mysql_affected_rows($sql5);
		        echo "<script>alert('10.Đã update thành công $n sản phẩm 1!');window.history.go(-2);</script>";
	           }
	      }
	    elseif($_FILES["anh"]["name"]!='')
	      {
		
           $file_name = $_FILES["anh"]["name"];
	       $tmp_name =  $_FILES["anh"]['tmp_name'];	
	       $imageInfo = explode('.',$file_name);  
	        //cắt chuỗi ở những nơi có dấu .	
	        //print_r($imageInfo);	
	       $newName = $masp.".".$imageInfo[1]; 		
		            switch($imageInfo[1])
			{
	        case "jpg":
		      $src = imagecreatefromjpeg($tmp_name);
	        break;
			
	        case "jpeg":
		      $src = imagecreatefromjpeg($tmp_name);
	        break;
	
	        case "gif":
		      $src = imagecreatefromgif($tmp_name);
	        break;
					
	        case "png":
		      $src = imagecreatefrompng($tmp_name);
	        break;	
	 }	
	      		
	   $sql11="update sanpham set id_sp='$masp',id_loai='$msl',id_khuyenmai=$km,tensp='$tensp',soluong='$sl',giaban='$gsp',hinhanh='$newName',mota='$mota',baohanh='$baoh',type='$triso' where id_sp='$masp'";	
$sql5=mysql_query($sql11);
		   if(!$sql5)
		   {
		     echo "<script>alert('11.Có lỗi trong lúc update!');window.history.go(-1);</script>";
		   }
	       else
	       {
   	        list($width,$height)=getimagesize($tmp_name);  //lấy kích thước của file
		    $newwidth=150;
		    $newheight=150;
		    $tmp=imagecreatetruecolor($newwidth,$newheight); //tạo kíck thước mới rồi gán vào 1 file hình
		    imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height); //chép hình từ file src ( ng ta gửi ) sang khung hình kíck thước mới
		    $pathfile="../../images/sanpham/".$newName;	
		    $pathfull="../../images/sanpham/small/".$newName;
		     move_uploaded_file($tmp_name, $pathfile);						
		     imagejpeg($tmp,$pathfull,100);		   //lưu hình tmp với đường dẫn là pathfull
		     imagedestroy($src); imagedestroy($tmp); //xóa hình tạm khỏi bộ nhớ 
			 			  
            $n=mysql_affected_rows($sql5);
		     echo "<script>alert('11.Đã update thành công $n sản phẩm 2!');window.history.go(-2);</script>";
	       }
		}
  }

function update_sphome($masp)
{
    $ndt=addslashes($_REQUEST["mota"]);
	$gc=$_REQUEST["gc"];
	$uimg=$_REQUEST["uimg"];
	$td=$_REQUEST["tsp"];
$sqltt=mysql_query("update baiviet set id_baiviet='$masp',tieude='$td',noidung='$ndt',ghichu='$gc',urlimage='$uimg' where id_baiviet='$masp'");
		if(!$sqltt)
		echo "<script>alert('13.Có lỗi trong lúc update!');window.history.go(-1);</script>";
	else
	{
		$n=mysql_affected_rows($sqltt);
		echo "<script>alert('14.Đã update thành công $n tin tức!');window.history.go(-2);</script>";
	}
}

function update_tt($matt)
{
	$ndt=$_REQUEST["ndt"];
	$gc=$_REQUEST["gc"];
	$td=$_REQUEST["td"];
	$ngcn=$_REQUEST["ngcn"];
		
		$sqltt=mysql_query("update tintuc set id_tintuc='$matt', noidung='$ndt',ghichu='$gc',tieude='$td',ngay_up='$ngcn' where id_tintuc='$matt'");
		if(!$sqltt)
		echo "<script>alert('13.Có lỗi trong lúc update!');window.history.go(-1);</script>";
	else
	{
		$n=mysql_affected_rows($sqltt);
		echo "<script>alert('14.Đã update thành công $n tin tức!');window.history.go(-2);</script>";
	}
}

function update_hd($mahd)
{
	$ngaygiao=$_REQUEST["nggiao"];
	if($ngaygiao=="")
		echo "<script>alert('Ngày giao ko được để trống!');window.history.go(-1);</script>";
	else{
		$sql7=mysql_query("update hoadon set ngaygiao='$ngaygiao' where id_hoadon='$mahd'");
		if(!$sql7)
			echo "<script>alert('17.Có lỗi trong lúc update!');window.history.go(-1);</script>";
		else
		{
			$n=mysql_affected_rows($sql7);
			echo "<script>alert('18.Đã duyệt thành công $n hóa đơn!');window.location='../index.php?b=hd&m=dsgq';</script>";
		}
	}
}

function update_cthd($idsp)
{
	$sql8=mysql_query("select * from chitiethoadon where id_sp='$idsp'") or die("lỗi truy vấn d168");
	$row8=mysql_fetch_array($sql8);
	$gia=$row8["giaban"]; $sl=$row8["soluong"];
	$tt=$gia * $sl;
	$sql9=mysql_query("update chitiethoadon set thanhtien='$tt' where id_sp='$idsp'");
	if(!$sql9)
		echo "<script>alert('Có lỗi trong lúc update!');window.history.go(-1);</script>";
	else{
		$n=mysql_affected_rows($sql9);
		echo "<script>alert('Đã update thành công $n chi tiết hóa đơn!');window.history.go(-1);</script>";
	}
}

$act=isset($_REQUEST["act"])?$_REQUEST["act"]:"";
if($act=="up_lh")
{
	$ma=$_REQUEST["malh"];
	update_lh($ma);
}

if($act=="up_tv")
{
	$matv=$_REQUEST["mauser"];
	update_tv($matv);
}

if($act=="up_sphome")
{
	$masp=$_REQUEST["mssp"];
	update_sphome($masp);
}


if($act=="uplsp")
{
	$mal=$_REQUEST["mal"];
	update_lsp($mal);
}


if($act=="upsp")
{
	$masp=$_REQUEST["mssp"];
	update_sp($masp);
}

if($act=="up_tt")
{
	$matt=$_REQUEST["matt"];
	update_tt($matt);
}


if($act=="uphd")
{
	$mahd=$_REQUEST["idhd"];
	update_hd($mahd);
}

if($act=="upcthd")
{
	$idsp=$_REQUEST["idsp"];
	update_cthd($idsp);
}
//mysql_query("update sanpham set id_sp=$mssp, tensp=$tsp, ");
?>

