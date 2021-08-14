<?php
class DB {
	public $host='localhost';
	public $user='root';
	public $pass='';
	public $database='shoponline';
	public $result=NULL;
	
	function __construct(){
		mysql_connect($this->host,$this->user,$this->pass) or die('Lỗi kết nối CSDL');
		mysql_select_db($this->database) or die('Lỗi chọn DB');
		mysql_query("set names 'utf8'");
	}
	
	function check_log(){
		if(isset($_SESSION['success']) || isset($_COOKIE['success']))
			return true;
		else
			return false;
	}
	
	function getdata($str,$debug=''){
		if(!empty($debug) || $debug==true) return $str;
		$this->result=mysql_query($str) or die(mysql_error());
		return $this->result;
		mysql_close();
	}
	
	function result_array(){
		if (is_resource($this->result) ==false) return false;
		$arr=array();
   		for($i=0;$row = mysql_fetch_assoc($this->result);$i++){
			$arr[$i]=$row;
		}
		return $arr;
	}
	
	function row_array(){
		if (is_resource($this->result) ==false) return false;
		$row = mysql_fetch_assoc($this->result);
		return $row;
	}
	
	function num_rows(){
		if (is_resource($this->result) ==false) return false;
		$count = mysql_num_rows($this->result);
		return $count;
	}
	
	function insert($table,$detail,$val='',$debug=''){
		if(is_array($detail)){
			$value = null; 
			$colum=trim(implode(',',array_keys($detail)), ',');
			foreach ( array_values($detail) as $v )
			{
				$v_str = null;
				if ( is_numeric($v) )
					$v_str = "'{$v}'";
				else if ( is_null($v) )
					$v_str = 'NULL';
				else
					$v_str = "'" . EncodeSpecialChar($v) . "'";
	
				$value .= "$v_str,";
			}
			$value = trim($value, ',');
		}else{
			$colum=$detail; $value=$val;
		}
		$str="insert into $table($colum) values($value)";
		if(!empty($debug) || $debug==true) return $str;
		$sql = mysql_query($str);
		if(!$sql) return false;
		else return true;
		mysql_close();
	}
	
	function update($table,$detail,$dk,$debug=''){
		if(is_array($dk)){
			$dkname=$this->BuildCondition($dk);
		}else $dkname=$dk;
		$content = null;
		if(is_array($detail)){
			foreach($detail as $k => $v){
				$v_str = null;
				if ( is_numeric($v) )
					$v_str = "'{$v}'";
				else if ( is_null($v) )
					$v_str = 'NULL';
				else
					$v_str = "'" . EncodeSpecialChar($v) . "'";
	
				$content .= "$k=$v_str,";
			}
			$content = trim($content, ',');
		}else $content=$detail;
		$str="update $table set $content where $dkname";
		if(!empty($debug) || $debug==true) return $str;
		$sql = mysql_query($str);
		if(!$sql) return false;
		else return true;
		mysql_close();
	}
		
	function delete($table,$dk,$debug=''){
		if(is_array($dk)){
			$dkname=$this->BuildCondition($dk);
		}else $dkname=$dk;
		$str="delete from $table where $dkname";
		if(!empty($debug) || $debug==true) return $str;
		$sql = mysql_query($str);
		if(!$sql) return false;
		else return true;
		mysql_close();
	}
	
	function now(){
		$this->getdata('select curdate() now');
		$row=$this->row_array();
		return $row['now'];
	}
	
	function datenow(){
		$this->getdata('select now() datenow');
		$row=$this->row_array();
		return $row['datenow'];
	}
	
	function curtime(){
		$this->getdata('select curtime() curtime');
		$row=$this->row_array();
		return $row['curtime'];
	}
	
	function BuildCondition($condition=array(), $logic='AND')
	{
		if ( is_string( $condition ) || is_null($condition) )
			return $condition;

		$logic = strtoupper( $logic );
		$content = null;
		foreach ( $condition as $k => $v )
		{
			$v_str = null;
			$v_connect = '=';

			if ( is_numeric($k) )
			{
				$content .= $logic . ' (' . $this->BuildCondition( $v, $logic ) . ')';
				continue;
			}

			$maybe_logic = strtoupper($k);
			if ( in_array($maybe_logic, array('AND','OR')))
			{
				$content .= $logic . ' (' . $this->BuildCondition( $v, $maybe_logic ) . ')';
				continue;
			}

			if ( is_numeric($v) ) {
				$v_str = "'{$v}'";
			}
			else if ( is_null($v) ) {
				$v_connect = ' IS ';
				$v_str = ' NULL';
			}
			else if ( is_array($v) ) {
				if ( isset($v[0]) ) {
					$v_str = null;
					foreach($v AS $one) {
						if (is_numeric($one)) {
							$v_str .= ','.$one;
						} else {
							$v_str .= ',\''.EncodeSpecialChar($one).'\'';
						}
					}
					$v_str = '(' . trim($v_str, ',') .')';
					$v_connect = 'IN';
				} else if ( empty($v) ) {
					$v_str = $k;
					$v_connect = '<>';
				} else {
					$v_connect = array_shift(array_keys($v));
					$v_s = array_shift(array_values($v));
					$v_str = "'".EncodeSpecialChar($v_s)."'";
                    $v_str = is_numeric($v_s) ? "'{$v_s}'" : $v_str ;
				}
			} 
			else {
				$v_str = "'".EncodeSpecialChar($v)."'";
			}
			$content .= " $logic $k $v_connect $v_str ";
		}

		$content = preg_replace( '/^\s*'.$logic.'\s*/', '', $content );
		$content = preg_replace( '/\s*'.$logic.'\s*$/', '', $content );
		$content = trim($content);

		return $content;
	}
	
	function showerror($string){
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		echo "<script>alert('$string');window.history.go(-1);</script>";
	}
	
	function showdone($string,$url){
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		echo "<script>alert('$string');window.location='../$url';</script>";
	}
	
	function page_list($str,$size){
		$this->getdata($str);
		$num=$this->num_rows();
		$count=ceil($num/$size);
		if (!isset($_REQUEST["page"]) || intval($_REQUEST["page"])<=0 || intval($_REQUEST["page"])>$count)
			$curr=1;
		else
			$curr=intval($_REQUEST["page"]);
		$p=($curr-1)*$size;
		return array($p,$count,$curr,$num);
	}
	
	function create_captcha($data = '', $img_path = '', $img_url = '', $font_path = '')
	{
		$defaults = array('word' => '', 'img_path' => '', 'img_url' => '', 'img_width' => '150', 'img_height' => '30', 'font_path' => '', 'expiration' => 7200);

		foreach ($defaults as $key => $val)
		{
			if ( ! is_array($data))
			{
				if ( ! isset($$key) OR $$key == '')
					$$key = $val;
			}
			else
				$$key = ( ! isset($data[$key])) ? $val : $data[$key];
		}

		if ($img_path == '' OR $img_url == '') return FALSE;

		if ( ! @is_dir($img_path)) return FALSE;

		if ( ! is_writable($img_path)) return FALSE;

		if ( ! extension_loaded('gd')) return FALSE;

		list($usec, $sec) = explode(" ", microtime());
		$now = ((float)$usec + (float)$sec);

		$current_dir = @opendir($img_path);

		while ($filename = @readdir($current_dir))
		{
			if ($filename != "." and $filename != ".." and $filename != "index.html")
			{
				$name = str_replace(".jpg", "", $filename);

				if (($name + $expiration) < $now)
					@unlink($img_path.$filename);
			}
		}

		@closedir($current_dir);

	   if ($word == '')
	   {
			$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

			$str = '';
			for ($i = 0; $i < 6; $i++){
				$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
			}

			$word = $str;
	   }
	   
	   $length	= strlen($word);
		$angle	= ($length >= 6) ? rand(-($length-6), ($length-6)) : 0;
		$x_axis	= rand(6, (360/$length)-16);
		$y_axis = ($angle >= 0 ) ? rand($img_height, $img_width) : rand(6, $img_height);
		
		if (function_exists('imagecreatetruecolor'))
			$im = imagecreatetruecolor($img_width, $img_height);
		else
			$im = imagecreate($img_width, $img_height);
			
		$bg_color		= imagecolorallocate ($im, 255, 255, 255);
		$border_color	= imagecolorallocate ($im, 153, 102, 102);
		$text_color		= imagecolorallocate ($im, 204, 0, 0);
		$grid_color		= imagecolorallocate($im, 255, 182, 182);
		$shadow_color	= imagecolorallocate($im, 255, 240, 240);

		imagefilledrectangle($im, 0, 0, $img_width, $img_height, $bg_color);

		$theta		= 1;
		$thetac		= 7;
		$radius		= 16;
		$circles	= 20;
		$points		= 32;

		for ($i = 0; $i < ($circles * $points) - 1; $i++){
			$theta = $theta + $thetac;
			$rad = $radius * ($i / $points );
			$x = ($rad * cos($theta)) + $x_axis;
			$y = ($rad * sin($theta)) + $y_axis;
			$theta = $theta + $thetac;
			$rad1 = $radius * (($i + 1) / $points);
			$x1 = ($rad1 * cos($theta)) + $x_axis;
			$y1 = ($rad1 * sin($theta )) + $y_axis;
			imageline($im, $x, $y, $x1, $y1, $grid_color);
			$theta = $theta - $thetac;
		}

		$use_font = ($font_path != '' AND file_exists($font_path) AND function_exists('imagettftext')) ? TRUE : FALSE;

		if ($use_font == FALSE){
			$font_size = 7;
			$x = rand(0, $img_width/($length/3));
			$y = 0;
		}
		else{
			$font_size	= 16;
			$x = rand(0, $img_width/($length/1.5));
			$y = $font_size+2;
		}

		for ($i = 0; $i < strlen($word); $i++)
		{
			if ($use_font == FALSE){
				$y = rand(0 , $img_height/2);
				imagestring($im, $font_size, $x, $y, substr($word, $i, 1), $text_color);
				$x += ($font_size*2);
			}
			else{
				$y = rand($img_height/2, $img_height-3);
				imagettftext($im, $font_size, $angle, $x, $y, $text_color, $font_path, substr($word, $i, 1));
				$x += $font_size;
			}
		}

		imagerectangle($im, 0, 0, $img_width-1, $img_height-1, $border_color);

		$img_name = $now.'.jpg';

		imagejpeg($im, $img_path.$img_name);

		$img = "<img src=\"$img_url$img_name\" width=\"$img_width\" height=\"$img_height\" style=\"border:0;\" alt=\" \" />";

		imagedestroy($im);

		return array('word' => $word, 'time' => $now, 'image' => $img);
	}
	
	function smtpmailer($to, $from, $from_name, $subject, $body, $username, $password, $path='') {
		include_once "class.phpmailer.php";
		global $error;
		$mail = new PHPMailer();  // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->IsHTML(true);
		$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true;  // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		$mail->Username = $username;
		$mail->Password = $password;
		$mail->SetFrom($from, $from_name);
		$mail->Subject = $subject;
		$mail->Body = $body;
		$mail->AddAddress($to);
		$mail->AddAttachment($path);
		$mail->CharSet="utf-8";
		$mail->IsHTML(true);
		if(!$mail->Send()) {
			echo $error = 'Mail error: '.$mail->ErrorInfo; 
			return false;
		} else {
			//echo $error = 'Send successful';
			return true;
		}
	}//function
}
?>