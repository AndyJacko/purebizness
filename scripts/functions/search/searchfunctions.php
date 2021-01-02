<?php
function getdirs($thesub) {
	$con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
	$RSSubName = mysql_query("SELECT * FROM tbl_purebiz_dir_scats WHERE tbl_id=".$thesub);
	$row_RSSubName = mysql_fetch_assoc($RSSubName);
	$totalRows_RSSubName = mysql_num_rows($RSSubName);
	
	$RSDirName = mysql_query("SELECT * FROM tbl_purebiz_dir_cats WHERE tbl_id=".$row_RSSubName["sub_cat"]);
	$row_RSDirName = mysql_fetch_assoc($RSDirName);
	$totalRows_RSDirName = mysql_num_rows($RSDirName);
	
	$thedirs = $row_RSDirName["cat_name"]."/".$row_RSSubName["sub_name"];
	
	mysql_free_result($RSDirName);
	mysql_free_result($RSSubName);
	
	return $thedirs;
}
function getdirname($thesub) {
	$con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
	$RSSubName = mysql_query("SELECT * FROM tbl_purebiz_dir_scats WHERE tbl_id=".$thesub);
	$row_RSSubName = mysql_fetch_assoc($RSSubName);
	$totalRows_RSSubName = mysql_num_rows($RSSubName);
	
	$RSDirName = mysql_query("SELECT * FROM tbl_purebiz_dir_cats WHERE tbl_id=".$row_RSSubName["sub_cat"]);
	$row_RSDirName = mysql_fetch_assoc($RSDirName);
	$totalRows_RSDirName = mysql_num_rows($RSDirName);
	
	$thedirs = ucwords($row_RSDirName["cat_disp_name"])." - ".ucwords($row_RSSubName["sub_disp_name"]);
	
	mysql_free_result($RSDirName);
	mysql_free_result($RSSubName);
	
	return $thedirs;
}

function getdirlink($thesub) {
	$con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
	$RSSubName = mysql_query("SELECT * FROM tbl_purebiz_dir_scats WHERE tbl_id=".$thesub);
	$row_RSSubName = mysql_fetch_assoc($RSSubName);
	$totalRows_RSSubName = mysql_num_rows($RSSubName);
	
	$RSDirName = mysql_query("SELECT * FROM tbl_purebiz_dir_cats WHERE tbl_id=".$row_RSSubName["sub_cat"]);
	$row_RSDirName = mysql_fetch_assoc($RSDirName);
	$totalRows_RSDirName = mysql_num_rows($RSDirName);
	
	$thedirs = "/adultdirectories/".$row_RSDirName["cat_name"]."/".$row_RSSubName["sub_name"];
	
	mysql_free_result($RSDirName);
	mysql_free_result($RSSubName);
	
	return $thedirs;
}

function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
  $sort_col = array();
  foreach ($arr as $key=> $row) {
    $sort_col[$key] = $row[$col];
  }
  array_multisort($sort_col, $dir, $arr);
}

function searchphrase($srch,$RSListings) {
	$row_RSListings = mysql_fetch_assoc($RSListings);
	$srch = strtolower($srch);
	$array = array();
	$i = 0;
	do {
		$desc = strtolower($row_RSListings["list_desc"]);
		$keys = strtolower($row_RSListings["list_keys"]);
	  if (substr_count($desc,$srch) > 0 || substr_count($keys,$srch) > 0) { 
      $array[$i]["tbl_id"] = $row_RSListings["tbl_id"];
      $array[$i]["list_sub"] = $row_RSListings["list_sub"];
      $array[$i]["list_name"] = $row_RSListings["list_name"];
      $array[$i]["list_title"] = $row_RSListings["list_title"];
      $array[$i]["list_desc"] = $row_RSListings["list_desc"];
      $array[$i]["list_country"] = $row_RSListings["list_country"];
      $array[$i]["list_area"] = $row_RSListings["list_area"];
      $array[$i]["list_ppic"] = $row_RSListings["list_ppic"];
      $array[$i]["count"] = substr_count($desc,$srch) + substr_count($keys,$srch);
		  $i++;
		}
	} while ($row_RSListings = mysql_fetch_assoc($RSListings));
	
	array_sort_by_column($array,"count");
	
	if (count($array) > 0) {
	  echo "Your Search For <strong class='pinkTxt'>&quot;".$srch."&quot;</strong> Returned The Following <strong class='pinkTxt'>".count($array)."</strong> Results:<br><br>";
		for ($p = 0; $p < count($array); $p++) {
			$andydirs = getdirs($array[$p]["list_sub"]);
			$listings .= "<div class='dirlisting'><div class='dirlistpic'><a href='/adultdirectories/viewdetails.php?name=".strtolower($array[$p]["list_name"])."&d=$andydirs&p=".$array[$p]["tbl_id"]."'><img src='/adultdirectories/$andydirs/".$array[$p]["list_title"]."/t/".$array[$p]["list_ppic"]."'></a></div>";	
			//$listings .= "<div class='dirinfo'>".$array[$p]["count"]." ".getflag(strtoupper($array[$p]["list_country"]))."&nbsp;&nbsp;<a href='/adultdirectories/viewdetails.php?name=".$array[$p]["list_name"]."&d=$andydirs&p=".$array[$p]["tbl_id"]."'>".strtoupper($array[$p]["list_name"])."</a>&nbsp;&nbsp;<strong>COUNTRY:</strong> ".strtoupper($array[$p]["list_country"])."&nbsp;&nbsp;<strong>AREA:</strong> ".strtoupper($array[$p]["list_area"]). "<br>";
			$listings .= "<div class='dirinfo'>".getflag(strtoupper($array[$p]["list_country"]))."&nbsp;&nbsp;<a href='/adultdirectories/viewdetails.php?name=".$array[$p]["list_name"]."&d=$andydirs&p=".$array[$p]["tbl_id"]."'>".strtoupper($array[$p]["list_name"])."</a>&nbsp;&nbsp;<strong>COUNTRY:</strong> ".strtoupper($array[$p]["list_country"])."&nbsp;&nbsp;<strong>AREA:</strong> ".strtoupper($array[$p]["list_area"]). "<br>";
			$listings .= $array[$p]["list_desc"]."</div>";
			$listings .= "<br class='clearfix'></div>";
		}
	  $listings .= "<br>";
	  echo $listings;
	} else {
		echo "Sorry Your Search For <strong class='pinkTxt'>&quot;".$srch."&quot;</strong> Returned No Results<br><br>";
	}
}

function searchwords($srch,$RSListings) {
	$row_RSListings = mysql_fetch_assoc($RSListings);
	$srch = strtolower($srch);
	$array = array();
	$words = explode(" ",$srch);
	$words = bannedwords($words);
	$i = 0;
	//echo "w=".count($words);
	
	do {
		$desc = strtolower($row_RSListings["list_desc"]);
		$keys = strtolower($row_RSListings["list_keys"]);
		
		for ($q=0; $q < count($words); $q++) {
			if (substr_count($desc,$words[$q]) > 0 || substr_count($keys,$words[$q]) > 0) {
				$wordscount = substr_count($desc,$words[$q]) + substr_count($keys,$words[$q]);
				//echo "wc=".$wordscount."<br>";
			}
		}

		if ($wordscount > 0) { 
      $array[$i]["tbl_id"] = $row_RSListings["tbl_id"];
      $array[$i]["list_sub"] = $row_RSListings["list_sub"];
      $array[$i]["list_name"] = $row_RSListings["list_name"];
      $array[$i]["list_title"] = $row_RSListings["list_title"];
      $array[$i]["list_desc"] = $row_RSListings["list_desc"];
      $array[$i]["list_country"] = $row_RSListings["list_country"];
      $array[$i]["list_area"] = $row_RSListings["list_area"];
      $array[$i]["list_ppic"] = $row_RSListings["list_ppic"];
      $array[$i]["count"] = $wordscount;
		  $i++;
		}
		$wordscount = 0;
	} while ($row_RSListings = mysql_fetch_assoc($RSListings));
	
	array_sort_by_column($array,"count");
	
	if (count($array) > 0) {
	  echo "Your search for <strong class='pinkTxt'>&quot;".$srch."&quot;</strong> returned the following <strong class='pinkTxt'>".count($array)."</strong> results:<br><br>";
		for ($p = 0; $p < count($array); $p++) {
			$andydirs = getdirs($array[$p]["list_sub"]);
			$listings .= "<div class='dirlisting'><div class='dirlistpic'><a href='/adultdirectories/viewdetails.php?name=".strtolower($array[$p]["list_name"])."&d=$andydirs&p=".$array[$p]["tbl_id"]."'><img src='/adultdirectories/$andydirs/".$array[$p]["list_title"]."/t/".$array[$p]["list_ppic"]."'></a></div>";	
			//$listings .= "<div class='dirinfo'>".$array[$p]["count"]." ".getflag(strtoupper($array[$p]["list_country"]))."&nbsp;&nbsp;<a href='/adultdirectories/viewdetails.php?name=".$array[$p]["list_name"]."&d=$andydirs&p=".$array[$p]["tbl_id"]."'>".strtoupper($array[$p]["list_name"])."</a>&nbsp;&nbsp;<strong>COUNTRY:</strong> ".strtoupper($array[$p]["list_country"])."&nbsp;&nbsp;<strong>AREA:</strong> ".strtoupper($array[$p]["list_area"]). "<br>";
			$listings .= "<div class='dirinfo'>".getflag(strtoupper($array[$p]["list_country"]))."&nbsp;&nbsp;<a href='/adultdirectories/viewdetails.php?name=".$array[$p]["list_name"]."&d=$andydirs&p=".$array[$p]["tbl_id"]."'>".strtoupper($array[$p]["list_name"])."</a>&nbsp;&nbsp;<strong>COUNTRY:</strong> ".strtoupper($array[$p]["list_country"])."&nbsp;&nbsp;<strong>AREA:</strong> ".strtoupper($array[$p]["list_area"]). "<br>";
			$listings .= "".$array[$p]["list_desc"]."</div>";
			$listings .= "<br class='clearfix'></div>";
		}
	  $listings .= "<br>";
	  echo $listings;
	} else {
		echo "<br><br>Sorry, your search for <strong class='pinkTxt'>&quot;".$srch."&quot;</strong> returned no results<br><br><br><br><strong>Please check your query is spelled correctly, or try other keywords.</strong><br><br><br><br>";
	}
}
function bannedwords($words) {
	$bannedwords = array("a","in","and","the","is","it");
	$words = array_diff($words,$bannedwords);
	$words = array_values($words);
	return $words;
}
?>