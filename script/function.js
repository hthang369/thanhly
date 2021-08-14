/*************************************************	so sanh san pham *********************************************************************/
	function explodeArray(str,delimiter) { 
		var myString = new String(str); 
		var myArray = myString.split(delimiter);
		return myArray;		
	}//explodeArray
	
	//Gan lai su kien
	function callBack() {
		//remove san pham so sanh
		$(".btnRemove").click(function() {
			var idSS= $(this).attr("idSS");
			var count= $("#sum").val();
			$("#sp_" + idSS).text("");
			$("#search_" + idSS).css("display", "");
			for(i= 1; i < count; i++) {
				$("#t" + idSS + "_" + i).html("&nbsp;");
			}//for
		});//end btnRemove
		
	}//callBack
	$(document).ready(function() {
		$(".select_sp").change(function() {
			var idSS= $(this).attr("idSS");
			var idSP= $(this).val();
			if(idSP != -1) {
				$("#search_" + idSS).css('display', 'none');
				$.ajax({
					url: ('load/compare.php'),
					type: "POST",
					data: "idSP=" + idSP + "&idSS=" + idSS,
					cache: false,
					success: function(data) {
					
						$("#sp_" + idSS).html(data);
						callBack();
					}//function	
				});//$.ajax
				$.ajax({
					url: ('load/laycttn.php'),
					type: "POST",
					data: "idSP=" + idSP,
					cache: false,
					success: function(data) {	
						$.each(explodeArray(data, "=>"), function(i, val) {
							$("#t"+ idSS + "_" + i).html(val);
						});
					}//function
				});//$.ajax
			}//if
		});
		
		//To mau tinh nang khac nhau
		$("#highlight").click(function() {
			var count= $("#sum").val();
			var err= false;
			for(i=1; i<= count; i++) {
				txt1= $("#t1_" + i).text();
				txt2= $("#t2_" + i).text();
				txt3= $("#t3_" + i).text();
				
				if(txt1 != txt2) {
					$("#t1_" + i).css("background-color", "#FFE401");
					$("#t2_" + i).css("background-color", "#FFE401");
					$("#t3_" + i).css("background-color", "#FFE401");
					err= true
				}
			}//for

			if(err == false) alert("Các sản phẩm điều có tính năng giống nhau");
		});

	});
	
/*************************************************	so sanh san pham *********************************************************************/	
		