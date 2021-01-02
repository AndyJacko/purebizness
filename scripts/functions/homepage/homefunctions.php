<?php
function getdirectory ($id) {
  $con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
  $RSDirCats = mysql_query("SELECT * FROM tbl_purebiz_dir_cats WHERE tbl_id=$id");
  $row_RSDirCats = mysql_fetch_assoc($RSDirCats);
  $totalRows_RSDirCats = mysql_num_rows($RSDirCats);
	
	$getdirectory = $row_RSDirCats["cat_disp_name"];
  mysql_free_result($RSDirCats);
	return $getdirectory;
}

function getlistings($id) {
  $con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
  $RSDirCats = mysql_query("SELECT tbl_id FROM tbl_purebiz_listings WHERE list_active=1 AND list_sub=$id");
  $row_RSDirCats = mysql_fetch_assoc($RSDirCats);
  $totalRows_RSDirCats = mysql_num_rows($RSDirCats);
	$getlistings = $totalRows_RSDirCats;
  mysql_free_result($RSDirCats);
	return $getlistings;
}

function getlink($id) {
  $con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
  $RSDirSCats = mysql_query("SELECT * FROM tbl_purebiz_dir_scats WHERE tbl_id=$id");
  $row_RSDirSCats = mysql_fetch_assoc($RSDirSCats);
  $totalRows_RSDirSCats = mysql_num_rows($RSDirSCats);

	$RSDirCats = mysql_query("SELECT * FROM tbl_purebiz_dir_cats WHERE tbl_id=".$row_RSDirSCats["sub_cat"]);
  $row_RSDirCats = mysql_fetch_assoc($RSDirCats);
  $totalRows_RSDirCats = mysql_num_rows($RSDirCats);
	
	$getdirectory = $row_RSDirCats["cat_name"]."/".$row_RSDirSCats["sub_name"];
  mysql_free_result($RSDirCats);
  mysql_free_result($RSDirSCats);
	return $getdirectory;
}

function getlink2($id) {
  $con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
	
  $RSDirSCats = mysql_query("SELECT * FROM tbl_purebiz_dir_scats WHERE tbl_id=$id");
  $row_RSDirSCats = mysql_fetch_assoc($RSDirSCats);
  $totalRows_RSDirSCats = mysql_num_rows($RSDirSCats);

	$RSDirCats = mysql_query("SELECT * FROM tbl_purebiz_dir_cats WHERE tbl_id=".$row_RSDirSCats["sub_cat"]);
  $row_RSDirCats = mysql_fetch_assoc($RSDirCats);
  $totalRows_RSDirCats = mysql_num_rows($RSDirCats);
	
	$getdirectory = $row_RSDirCats["cat_disp_name"]." / ".$row_RSDirSCats["sub_disp_name"];
  mysql_free_result($RSDirCats);
  mysql_free_result($RSDirSCats);
	return $getdirectory;
}

function getupdated($id) {
  $con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
  $RSUpdated = mysql_query("SELECT sub_updated FROM tbl_purebiz_dir_scats WHERE tbl_id=$id");
  $row_RSUpdated = mysql_fetch_assoc($RSUpdated);
  $totalRows_RSDirCats = mysql_num_rows($RSUpdated);
	
	if ($row_RSUpdated["sub_updated"] == "") {
		$upd8d = "2011/1/1";
	} else {
	  $upd = explode("/",$row_RSUpdated["sub_updated"]);
		$upd8d = $upd[2]."/".$upd[1]."/".$upd[0];
	}
	$d8now = gmdate("Y/m/d");
	
  $getupdated = (strtotime($d8now) - strtotime($upd8d)) / (60 * 60 * 24);
  switch ($getupdated) {
		case 0:
		  $getupdated = "<img src='/images/directories/foldericons/redfolder.png'>";
			break;
		case 1:
		  $getupdated = "<img src='/images/directories/foldericons/greenfolder.png'>";
			break;
		case 2:
		  $getupdated = "<img src='/images/directories/foldericons/greenfolder.png'>";
			break;
		case 3:
		  $getupdated = "<img src='/images/directories/foldericons/greenfolder.png'>";
			break;
		case 4:
		  $getupdated = "<img src='/images/directories/foldericons/bluefolder.png'>";
			break;
		case 5:
		  $getupdated = "<img src='/images/directories/foldericons/bluefolder.png'>";
			break;
		case 6:
		  $getupdated = "<img src='/images/directories/foldericons/bluefolder.png'>";
			break;
		case 7:
		  $getupdated = "<img src='/images/directories/foldericons/bluefolder.png'>";
			break;
		default:
		  $getupdated = "<img src='/images/directories/foldericons/yellowfolder.png'>";
	}
	
  mysql_free_result($RSUpdated);
	return $getupdated;
}
?>