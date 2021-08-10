<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php  include "../connect.php";
function insert_sp()
{
	$loaisp=$_POST["loaisp"];
	$masp=$_POST["masp"];
	$bhsp=$_POST["bhsp"];
	$tensp=$_POST["tensp"];
	$mota =addslashes($_POST['motasp']);
	$sl=$_POST['sl'];
	$triso=$_POST["trs"];
	$km=$_POST['km'];
	$gia=$_POST["giasp"];
	$kt=mysql_query("select count(*) from sanpham where tensp='$tensp'");
	$r=mysql_fetch_array($kt);
	if($r[0]!=0){
		echo "<script>alert('Sản phẩm này đã có trong cơ sỡ dữ liệu');window.history.go(-1);</script>";}
	else{//(2)	
	$file_name = $_FILES["hinh"]["name"];
	$tmp_name = $_FILES['hinh']['tmp_name'];	
	$imageInfo = explode('.', $file_name);  //cắt chuỗi ở những nơi có dấu .		
	$newName = $masp.".".$imageInfo[1]; 			

	switch($imageInfo[1]){
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
		
	}//end - switch
	$sql="insert into sanpham(id_sp,id_loai,id_khuyenmai,tensp,soluong,giaban,hinhanh,mota,baohanh,type) values ('$masp','$loaisp','$km','$tensp','$sl','$gia','$newName','$mota','$bhsp','$triso')";}
	$kq=mysql_query($sql);
	if(!$kq){
	echo "<script>alert('Có lỗi trong quá trình sử lý dữ liệu! Nhập lại!');window.history.go(-1);</script>";		
	}
	else {//(4)
		
//********************************resize hinh ********************************//
	list($width,$height)=getimagesize($tmp_name);  //lấy kích thước của file
	$newwidth=170;
	$newheight=170;
	$tmp=imagecreatetruecolor($newwidth,$newheight); //tạo kíck thước mới rồi gán vào 1 file hình
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height); //chép hình từ file src ( ng ta gửi ) sang khung hình kíck thước mới
	$pathfile="../../images/sanpham/".$newName;	
	$pathfull="../../images/sanpham/small/".$newName;	
	move_uploaded_file($tmp_name, $pathfile);
	imagejpeg($tmp,$pathfull,100);		   //lưu hình tmp với đường dẫn là pathfull
	imagedestroy($src); imagedestroy($tmp); //xóa hình tạm khỏi bộ nhớ
//********************************resize hinh ********************************//	
		
		$n=mysql_affected_rows($kq);
		echo "<script>alert('Đã thêm $n sản phẩm!');window.history.go(-2)</script>";
	}//(4)
}

function insert_sanphamhome()
{
   	$td=$_POST["tieudebv"];
	$mota =stripslashes($_POST['ndbaiviet']);
	$ghichu=$_POST['ghichu'];
	$kt=mysql_query("select count(*) from baiviet where tieude='$td'");
	$r=mysql_fetch_array($kt);
	if($r[0]!=0){
		echo "<script>alert('bài viết này đã có trong cơ sỡ dữ liệu');window.history.go(-1);</script>";}
	else{
	$sql="insert into baiviet(tieude,noidung,ghichu) values ('$td','$mota','$ghichu')";}
	$kq=mysql_query($sql);
		print_r($sql);
	if(!$kq){
	echo "<script>alert('Có lỗi trong quá trình sử lý dữ liệu!');window.history.go(-1);</script>";		
	}
	else {
		
		$n=mysql_affected_rows($kt);
		echo "<script>alert('Đã thêm $n sản phẩm!');window.history.go(-2)</script>";
	}
}

function insert_hsp()
{
	$loaisp=$_POST["loaisp"];
	$ten=$_POST["hieusp"];	
	//$id=getidl();
	$sql1="insert into hieu(tenhieu,id_loai) values ('$ten','$loaisp')";
///	echo "$sql";
	$kq1=mysql_query($sql1);	
	if(!$kq1)
		echo "<script>alert('Có lỗi xảy ra trong quá trình xử lý');window.history.go(-1);</script>";
	else{
		$n=mysql_affected_rows($kq1);
		echo "<script>alert('Đã thêm $n hiệu sản phẩm');window.history.go(-2);</script>";
		$ten="";
	}
}

function insert_lsp()
{
	$nhomsp=$_REQUEST["nhomsp"];
	$tenn=$_REQUEST["loaisp"];
	//$idl=$_REQUEST["idloai"];	
	//$id=getidl();
	$check=mysql_query("select * from loaisanpham where id_nhom='$nhomsp' and tenloai='$tenn'");
	$r=mysql_fetch_array($check);
	$n=$r['tenloai'];
	if($tenn==$n)
		echo "<script>alert('Loại sản phẩm này đã có trong cơ sở dữ liệu!');window.history.go(-1);</script>";
	else{
	$sql2="insert into loaisanpham(tenloai,id_nhom) values ('$tenn','$nhomsp')";
///	echo "$sql";
	$kq2=mysql_query($sql2);	
	if(!$kq2)
		echo "<script>alert('Có lỗi xảy ra trong quá trình xử lý');window.history.go(-1);</script>";
	else{
		echo "<script>alert('Đã thêm');window.history.go(-1);</script>";
		$tenn="";
	}
	}
}

function insert_nsp()
{
	$ten=$_REQUEST["nhomsp"];	
	$check2=mysql_query("select * from nhomsanpham where tennhom='$ten'");
	$r2=mysql_fetch_array($check2);
	$n=$r2['tennhom'];
	if($ten==$n)
		echo "<script>alert('Lỗi!! Nhóm sản phẩm này đã có trong cơ sở dữ liệu!');window.history.go(-1);</script>";
	else{
	$sql3="insert into nhomsanpham(tennhom) values ('$ten')";
///	echo "$sql";
	$kq3=mysql_query($sql3);	
	if(!$kq3)
		echo "<script>alert('Có lỗi xảy ra trong quá trình xử lý');window.history.go(-1);</script>";
	else{
		echo "<script>alert('Đã thêm');window.history.go(-1);</script>";
		$ten="";
	}
	}
}

function insert_km()
{
	$tt=$_REQUEST["tt"];
	$ngbd=$_REQUEST["ngbd"];
	$ngkt=$_REQUEST["ngkt"];
	$tstkm=$_REQUEST["tstkm"];
	$sqlkm="insert into khuyenmai(thongtin,ngaybatdau,ngayketthuc,trisotrukhuyenmai) values ('$tt','$ngbd','$ngkt','$tstkm')";
	$km=mysql_query($sqlkm);
	if(!$km)
		echo "<script>alert('Có lỗi xảy ra trong quá trình xử lý thêm thông tin khuyến mãi!');window.history.go(-2);</script>";
	else
	{
		$n=mysql_affected_rows($km);
		echo "<script>alert('Đã thêm $n thông tin khuyến mãi!');window.history.go(-2);</script>";
	}
}
function insert_tt()
{   
	$ndtt=$_REQUEST["ndtt"];
	$gc=$_REQUEST["gc"];
	$ngcn=$_REQUEST["ngcn"];
	$td=$_REQUEST["td"];
    
	$sqltt="insert into tintuc(noidung,ghichu,tieude,ngay_up) values ('$ndtt','$gc','$td','$ngcn')";
	$tt=mysql_query($sqltt);
	if(!$tt)
		echo "<script>alert('Có lỗi xảy ra trong quá trình xử lý thêm tin tức!');window.history.go(-2);</script>";
	else
	{
		echo "<script>alert('Đã thêm tin tức mới!');window.history.go(-2);</script>";
	}
}

function load_sp(){
	$idnhom = $_POST['idnhom'];
	$tt=mysql_query("SELECT * FROM loaisanpham where id_nhom=$idnhom ") or die('');
	$html = '';
	while ($ss=mysql_fetch_array($tt))
		$html .= "<option value=\"$ss[0]\">$ss[0].$ss[1]</option>";
	echo $html;
	//print_r($_POST);
}


$act=$_REQUEST["act"];
if($act=="insp")
{
	insert_sp();
}
if($act=="insanphamhome")
{
	insert_sanphamhome();
}
if($act=="inlsp")
{
	insert_lsp();
}
if($act=="innsp")
{
	insert_nsp();
}
if($act=="inhsp")
{
	insert_hsp();
}
if($act=="intt")
{
    insert_tt();
}
if($act=="inkm")
{
	insert_km();
}
if($act=="load_sp")
{
	load_sp();
}
?>