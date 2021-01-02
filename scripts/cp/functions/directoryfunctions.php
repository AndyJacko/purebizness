<?php
function getdirectoryname($dir) {
	$con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
	$RSSDirName = mysql_query("SELECT * FROM tbl_purebiz_dir_scats WHERE tbl_id=".$dir);
	$row_RSSDirName = mysql_fetch_assoc($RSSDirName);
	$totalRows_RSSDirName = mysql_num_rows($RSSDirName);
	
	$RSDirName = mysql_query("SELECT * FROM tbl_purebiz_dir_cats WHERE tbl_id=".$row_RSSDirName["sub_cat"]);
	$row_RSDirName = mysql_fetch_assoc($RSDirName);
	$totalRows_RSDirName = mysql_num_rows($RSDirName);
	
	return $row_RSDirName["cat_disp_name"]." - ".$row_RSSDirName["sub_disp_name"];
}

function getdirectoryurl($dir) {
	$con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
	$RSSDirName = mysql_query("SELECT * FROM tbl_purebiz_dir_scats WHERE tbl_id=".$dir);
	$row_RSSDirName = mysql_fetch_assoc($RSSDirName);
	$totalRows_RSSDirName = mysql_num_rows($RSSDirName);
	
	$RSDirName = mysql_query("SELECT * FROM tbl_purebiz_dir_cats WHERE tbl_id=".$row_RSSDirName["sub_cat"]);
	$row_RSDirName = mysql_fetch_assoc($RSDirName);
	$totalRows_RSDirName = mysql_num_rows($RSDirName);
	
	return $row_RSDirName["cat_name"]."/".$row_RSSDirName["sub_name"];
}

function rrmdir($dir) {
	if (is_dir($dir)) {
	  $objects = scandir($dir);
	  foreach ($objects as $object) {
	    if ($object != "." && $object != "..") {
	      if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
	    }
	  }
	  reset($objects);
	  rmdir($dir);
	}
} 
?>