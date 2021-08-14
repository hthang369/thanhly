<?php
// $mysql_host = "localhost";
// $mysql_database = "u845651399_smv";
// $mysql_user = "u845651399_smvn";
// $mysql_password = "V7ppkhTvySP9";

require_once('db_connect.php');
$dbConn = new DBConnect();

if (!function_exists('mysql_query')) {
	function mysql_query($strQuery) {
		global $dbConn;
		return $dbConn->execute_query($strQuery);
	}
}

if (!function_exists('mysql_fetch_array')) {
	function mysql_fetch_array($result) {
		global $dbConn;
		return $dbConn->fetch_array($result);
	}
}

if (!function_exists('mysql_num_rows')) {
	function mysql_num_rows($result) {
		global $dbConn;
		return $dbConn->num_rows($result);
	}
}

if (!function_exists('mysql_affected_rows')) {
	function mysql_affected_rows($result) {
		global $dbConn;
		return $dbConn->affected_rows($result);
	}
}

if (!function_exists('get_domain_url')) {
	function get_domain_url() {
        $schema = $_SERVER['REQUEST_SCHEME'];
        $domain = $_SERVER['SERVER_NAME'];
        $port = $_SERVER['SERVER_PORT'];
        return sprintf('%s://%s%s/', $schema, $domain, ($port == 80) ? '' : ":$port");
	}
}

if (!function_exists('str_contains')) {
	function str_contains($haystack, $needles) {
		foreach ((array) $needles as $needle) {
            if ($needle !== '' && mb_strpos($haystack, $needle) !== false) {
                return true;
            }
        }

        return false;
	}
}
?>