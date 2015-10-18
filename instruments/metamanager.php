<?php 
define('MAINDIR', dirname(__DIR__));
session_set_cookie_params(2678400, '/');
session_start();
if (isset($_SESSION["is_auth"]) && $_SESSION["is_auth"] == true) {
	
if (!empty($_GET['service']) && !empty($_GET['action'])) {
	include MAINDIR .'config.php';
	$sql = new MySQLi($config['mysql']['host'],$config['mysql']['user'],$config['mysql']['password'],$config['mysql']['database']);
	if ($_GET['service'] == 'tvdb') {
		include MAINDIR .'/metamodules/tvdb/tvdb.php';
	}
}
} else {
	die('not logged in.');
}
?>