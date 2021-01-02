<?php require("../../db/connection.php"); ?>
<?php session_start(); ?>
<?php
if (isset($_GET["u"])) {
	$mydomain = "www.purebizness.net"; 
	ini_set (default_socket_timeout, "5");
	if (strlen($_GET["u"])) {
		if (strpos (file_get_contents($_GET["u"]), $mydomain) != false) {
				echo 1;
		} else {
				echo 0;
		}
	}
} else {
  echo 0;
}
?>