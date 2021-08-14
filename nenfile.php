<?php
ini_set('zlib_output_compression','On'); 
//if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); 
if( isset($_REQUEST['file']) ){ 
	$file = $_REQUEST['file'];
	if( goodfile($file) ){ 
		$arg_file = explode(".", $file);
		$ext = end($arg_file);
		switch($ext){ 
			case 'css':$contenttype = 'css';break; 
			case 'js':$contenttype = 'x-javascript';break; 
			default:die();break;
		} 
		//header ("cache-control: must-revalidate"); 
		$expires_offset = 60 * 60 * 24;
		header('Content-Type: text/'.$contenttype.'; charset=UTF-8');
		header('Expires: ' . gmdate( "D, d M Y H:i:s", time() + $expires_offset ) . ' GMT');
		header("Cache-Control: public, max-age=$expires_offset");
		$data = file_get_contents($file); 
		compress($data); 
		//$data; 
	} 
}

function goodfile($file){ 
	$invalidChars=array("",'"',";",">","<",".php"); 
	$file=str_replace($invalidChars,"",$file); 
	if( file_exists($file) ) return true; 
	return false; 
} 

function compress($buffer,$force_gzip=false) { 
	header('Vary: Accept-Encoding'); // Handle proxies
	if ( false !== stripos($_SERVER['HTTP_ACCEPT_ENCODING'], 'deflate') && function_exists('gzdeflate') && ! $force_gzip ) {
		header('Content-Encoding: deflate');
		//$buffer = gzdeflate( $buffer, 3 );
	} elseif ( false !== stripos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') && function_exists('gzencode') ) {
		header('Content-Encoding: gzip');
		$buffer = gzencode( $buffer, 3 );
	}
	echo $buffer;
}
?>