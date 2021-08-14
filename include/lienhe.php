<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="javascript">
function tieude_Onblur() {
        td=formlienhe.txttieude.value;
        var loitd=document.getElementById("IDtieude");
        
        if(td=="") {
            loitd.innerHTML="Tiêu đề không được bỏ trống !";
            formlienhe.txttieude.focus();
            return;
        }
        loitd.innerHTML="";
    }
function hoten_Onblur() {
        ht=formlienhe.hoten.value;
        var loiht=document.getElementById("IDhoten");
        
        if(ht=="") {
            loiht.innerHTML="Họ tên không được bỏ trống !";
            formlienhe.hoten.focus();
            return;
        }
		if(!isNaN(ht)){
			loiht.innerHTML="Họ tên không được nhập số !";
			formlienhe.hoten.focus();
			return;
		}
		if(ht.length<6) {
            loiht.innerHTML="Họ tên phải ít nhất 6 ký tự !";
            formlienhe.hoten.focus();
            return;
        }	
        loiht.innerHTML="<img src='images/true.png' />";
    }
function diachi_Onblur() {
        dc=formlienhe.diachi.value;
        var loidc=document.getElementById("IDdiachi");
        
        if(dc=="") {
            loidc.innerHTML="Địa chỉ không được bỏ trống !";
            formlienhe.diachi.focus();
            return;
        }
        loidc.innerHTML="<img src='images/true.png' />";
    }
function dienthoai_Onblur() {
        dt=formlienhe.dienthoai.value;
        var loidt=document.getElementById("IDdienthoai");
        
        if(dt=="") {
            loidt.innerHTML="Điện thoại không được bỏ trống !";
            formlienhe.dienthoai.focus();
            return;
        }
           
        if(isNaN(dt)) {
            loidt.innerHTML="Bạn phải nhập vào là số !";
            formlienhe.dienthoai.focus();
            return;
        }
		if(dt.length<9){
			loidt.innerHTML="số điện thoại phải ít nhất có 9 số !";
			formlienhe.dienthoai.focus();
			return;
			}
        loidt.innerHTML="<img src='images/true.png' />";
        
    }
		
function email_Onblur() {
        mailc=formlienhe.email.value;
		mail=document.formlienhe.email;
        var loimail=document.getElementById("IDemail");
        dangmail= /^([a-zA-Z0-9_\.\-])*@[\w\d.]+.\w{2,4}$/;
        kq=dangmail.test(mail.value);
        if(mailc=="") {
            loimail.innerHTML="Email không được bỏ trống !";
            formlienhe.email.focus();
            return;
        }
        if(!kq) {
           loimail.innerHTML="Sai định dạng mail !<br/>Ví Dụ: abc@gmail.com hoặc abc@yahoo.com";
            mail.focus();
            return false;
        }
        loimail.innerHTML="<img src='images/true.png' />";      
    }
	
function noidung_Onblur() {
        nd=formlienhe.noidung.value;
        var loind=document.getElementById("IDnoidung");
        
        if(nd=="") {
            loind.innerHTML="Nội dung không được bỏ trống !";
            formlienhe.noidung.focus();
            return;
        }
        loind.innerHTML="<img src='images/true.png' />";
        
    }
	
	function checkinput(){
		email=formlienhe.email.value;
		ht=formlienhe.hoten.value;
		diachi=formlienhe.diachi.value;
		dienthoai=formlienhe.dienthoai.value;
		nd=formlienhe.noidung.value;
               
        if(ht==""){
            alert("Bạn chưa nhập họ tên !");
            ht.focus();
            return false;
        }
		 if(email==""){
            alert("Bạn chưa nhập email !");
            email.focus();
            return false;
        }
        if(diachi==""){
            alert("Bạn chưa nhập địa chỉ !");
            diachi.focus();
            return false;
        }
        if(dienthoai==""){
            alert("Bạn chưa nhập số điện thoại");
            dienthoai.focus();
            return false;
        }
        if(nd==""){
            alert("Bạn chưa nhập nội dung liên hệ !");
            noidung.focus();
            return false;
        }
        else alert('OK, đã nhập đúng dữ liệu');
        return true;
    }
	
 formlienhe.submit();
</script>

<div class="card-header py-2">Liên hệ trực tuyến</div>
<div class="card-body">
    <form name="formlienhe" method="post" action="include/xl_lienhe.php" onsubmit="return checkinput();">
      <div class="form-group">
        <label for="input-hoten">Họ Tên :</label>
        <input type="text" class="form-control" name="ht" size="40" id="hoten" maxlength="30" onblur="hoten_Onblur()" /></fieldset>
      </div>
      <div class="form-group">
        <label for="input-hoten">Giới tính :</label>
        <div class="form-row">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="gt1" id="check-gt1" onblur="hoten_Onblur()" />
            <label class="custom-control-label" for="check-gt1">Nam</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="gt0" id="check-gt0" onblur="hoten_Onblur()" />
            <label class="custom-control-label" for="check-gt0">Nữ <small>(không bắc buộc)</small></label>
        </div>
        </div>
      </div>
      <div class="form-group">
        <label for="diachi">Địa chỉ :</label>
        <input type="text" class="form-control" name="dc" size="50" id="diachi" onblur="diachi_Onblur()">
      </div>
      <div class="form-group">
        <label for="dienthoai">Điện thoại :</label>
        <input type="text" class="form-control" name="dt" size="30" id="dienthoai" maxlength="12" onblur="dienthoai_Onblur()" />
      </div>
      <div class="form-group">
        <label for="email">Email :</label>
        <input type="text" class="form-control" name="ema" size="50" id="email" onblur="email_Onblur()"/>
      </div>
      <div class="form-group">
        <label for="email">Nội dung :</label>
        <textarea name="nd" class="form-control" id="noidung" cols="46" rows="5" onblur="noidung_Onblur()"></textarea>
      </div>
      <div class="form-group">
        <input type="submit" name="gui" id="button" value="gửi" class="btn btn-sm btn-primary" />        
        <input type="reset" class="btn btn-sm btn-danger" name="reset" id="button2" value="Nhập lại" />
      </div>
    </form>
</div>
