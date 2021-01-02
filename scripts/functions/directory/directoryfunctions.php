<?php
$dirURL = $_SERVER['PHP_SELF'];
$dirURL = str_replace("/adultdirectories/","",$dirURL);
$dirURL = str_replace("/index.php","",$dirURL);
$dir = substr($dirURL,0,strpos($dirURL,"/",0));
$sub = substr($dirURL,(strpos($dirURL,"/",0)+1),(strlen($dirURL)-strpos($dirURL,"/",0)));

$con = mysql_connect("dbHost","dbUser","dbPass");
mysql_select_db("db", $con);
$RSDirName = mysql_query("SELECT * FROM tbl_purebiz_dir_cats WHERE cat_name='".$dir."'");
$row_RSDirName = mysql_fetch_assoc($RSDirName);
$totalRows_RSDirName = mysql_num_rows($RSDirName);

$RSSubName = mysql_query("SELECT * FROM tbl_purebiz_dir_scats WHERE sub_name='".$sub."' AND sub_cat=".$row_RSDirName["tbl_id"]);
$row_RSSubName = mysql_fetch_assoc($RSSubName);
$totalRows_RSSubName = mysql_num_rows($RSSubName);

$getmetas .= "<meta name='description' content='".$row_RSSubName["sub_desc"]."' >\r";
$getmetas .= "<meta name='keywords' content='".$row_RSSubName["sub_keys"]."' >\r";
$getmetas .= "<title>".$row_RSSubName["sub_title"]."</title>\r";
$getheader = $row_RSDirName["cat_disp_name"].": ".$row_RSSubName["sub_disp_name"];
$getblurbs = $row_RSSubName["sub_blurb"];

mysql_free_result($RSDirName);
mysql_free_result($RSSubName);

function getotherdirs() {
  $con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
  $RSDirCats = mysql_query("SELECT * FROM tbl_purebiz_dir_cats ORDER BY cat_name ASC");
  $row_RSDirCats = mysql_fetch_assoc($RSDirCats);
  $totalRows_RSDirCats = mysql_num_rows($RSDirCats);

  $getorherdirs = "<h2>Other Adult Directories</h2><br>";
  $getorherdirs .= "<hr><br>";
  
  do {
	$getorherdirs .= getsubcatsother($row_RSDirCats["tbl_id"],$row_RSDirCats["cat_name"]);
  } while ($row_RSDirCats = mysql_fetch_assoc($RSDirCats));
  mysql_free_result($RSDirCats);
  
  $getorherdirs .= "<br>";
  $getorherdirs .= "<div class='dirmenu'>";
  $getorherdirs .= "<a href='http://www.purebizness.net'>HOMEPAGE</a>";
  $getorherdirs .= "<a href='/adultdirectories/addyourlisting.php'>ADD YOUR LISTING</a>";
  $getorherdirs .= "<a href='/adultdirectories/adultadvertising.php'>SPONSORED LISTING</a>";
  $getorherdirs .= "<a href='/chat_lines/adult-chat-lines.php'>CHAT LINES</a>";
  $getorherdirs .= "</div>";
	
  return $getorherdirs;
}

function getsubcatsother($catid,$filepath) {
  $con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
  $RSDirSub = mysql_query("SELECT * FROM tbl_purebiz_dir_scats WHERE sub_cat=".$catid." ORDER BY sub_name ASC");
  $row_RSDirSub = mysql_fetch_assoc($RSDirSub);
  $totalRows_RSDirSub = mysql_num_rows($RSDirSub);
  
  do {
	if ($row_RSDirSub["sub_cat"] == $catid) {
	  $getsubcats .= "<div class='otherdirectories'>";
      $getsubcats .= "<img src='/images/directories/foldericons/smallicon.gif' align='absmiddle'>&nbsp;<a href='/adultdirectories/".$filepath."/".$row_RSDirSub["sub_name"]."'><strong>".$row_RSDirSub["sub_disp_name"]."</strong></a><br>";
	  $getsubcats .= "</div>";
	}
  } while ($row_RSDirSub = mysql_fetch_assoc($RSDirSub));
  mysql_free_result($RSDirSub);
  return $getsubcats;
}

function getgender($gender) {
	return $getgender;
}





?>