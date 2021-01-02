<?php
function getdirectories() {
  $con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
  $RSDirCats = mysql_query("SELECT * FROM tbl_purebiz_dir_cats ORDER BY cat_name ASC");
  $row_RSDirCats = mysql_fetch_assoc($RSDirCats);
  $totalRows_RSDirCats = mysql_num_rows($RSDirCats);

  $catcode = "<ul>";
  do {
		$catcode .= "<li><span class='toggle'><strong>".strtoupper($row_RSDirCats["cat_disp_name"])."</strong></span><ul>";
		$catcode .= getsubcats($row_RSDirCats["tbl_id"],$row_RSDirCats["cat_name"]);
		$catcode .= "</ul></li>";
  } while ($row_RSDirCats = mysql_fetch_assoc($RSDirCats));
  $catcode .= "</ul>";
  mysql_free_result($RSDirCats);
  return $catcode;
}

function getsubcats($catid,$filepath) {
  $con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
  $RSDirSub = mysql_query("SELECT * FROM tbl_purebiz_dir_scats WHERE sub_cat=".$catid." ORDER BY sub_name ASC");
  $row_RSDirSub = mysql_fetch_assoc($RSDirSub);
  $totalRows_RSDirSub = mysql_num_rows($RSDirSub);
  
  do {
	if ($row_RSDirSub["sub_cat"] == $catid) {
    $getsubcats .= "<li><a href='/adultdirectories/".$filepath."/".$row_RSDirSub["sub_name"]."'><strong>".strtoupper($row_RSDirSub["sub_disp_name"])."</strong></a></li>";
	}
  } while ($row_RSDirSub = mysql_fetch_assoc($RSDirSub));
  mysql_free_result($RSDirSub);
  return $getsubcats;
}

function getdirectoriescp() {
  $con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
  $RSDirCats = mysql_query("SELECT * FROM tbl_purebiz_dir_cats ORDER BY cat_name ASC");
  $row_RSDirCats = mysql_fetch_assoc($RSDirCats);
  $totalRows_RSDirCats = mysql_num_rows($RSDirCats);

  $catcode = "<ul>";
  do {
		$catcode .= "<li><span class='toggle'><strong>".strtoupper($row_RSDirCats["cat_disp_name"])."</strong></span><ul>";
		$catcode .= getsubcatscp($row_RSDirCats["tbl_id"],$row_RSDirCats["cat_name"]);
		$catcode .= "</ul></li>";
  } while ($row_RSDirCats = mysql_fetch_assoc($RSDirCats));
  $catcode .= "</ul>";
  mysql_free_result($RSDirCats);
  return $catcode;
}

function getsubcatscp($catid,$filepath) {
  $con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
  $RSDirSub = mysql_query("SELECT * FROM tbl_purebiz_dir_scats WHERE sub_cat=".$catid." ORDER BY sub_name ASC");
  $row_RSDirSub = mysql_fetch_assoc($RSDirSub);
  $totalRows_RSDirSub = mysql_num_rows($RSDirSub);
  
  do {
	if ($row_RSDirSub["sub_cat"] == $catid) {
    $getsubcats .= "<li><a href='/cp/directories/directory.php?dir=".$row_RSDirSub["tbl_id"]."'><strong>".strtoupper($row_RSDirSub["sub_disp_name"])."</strong></a></li>";
	}
  } while ($row_RSDirSub = mysql_fetch_assoc($RSDirSub));
  mysql_free_result($RSDirSub);
  return $getsubcats;
}
?>
