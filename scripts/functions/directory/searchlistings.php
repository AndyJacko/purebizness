<?php require("getflag.php"); ?>
<?php
$thisUrl = $_SERVER['PHP_SELF'];
if (isset($_SESSION["thispage"])) {
  if ($_SESSION["thispage"] != $thisUrl) {
	 require("killdirsessions.php"); 
	 $_SESSION["thispage"] = $thisUrl;
  }
} else {
  $_SESSION["thispage"] = $thisUrl;	
}
if (isset($_GET["o"])) {
  if ($_GET["o"] == 1) {
    $_SESSION["order"] = "list_name";	
  } else {
    $_SESSION["order"] = "tbl_id";	
  }	
} else {
  if (!isset($_SESSION["order"])) {
	 $_SESSION["order"] = "list_name";
  }
}
if (isset($_GET["d"])) {
  if ($_GET["d"] == 1) {
    $_SESSION["direction"] = "ASC";	
  } else {
    $_SESSION["direction"] = "DESC";	
  }	
} else {
  if (!isset($_SESSION["direction"])) {
	 $_SESSION["direction"] = "ASC";
  }
}
if (isset($_GET["n"])) {
  $_SESSION["maxrows"] = $_GET["n"];
} else {
  if (!isset($_SESSION["maxrows"])) {
	$_SESSION["maxrows"] = 10;
  }
}
if (isset($_GET["c"])) {
  $_SESSION["country"] = $_GET["c"];
} else {
  $_SESSION["country"] = "all";
}
$p = 0;
if (isset($_GET['p'])) {
  $p = $_GET['p'];
}
$startRow_RSListings = $p * $_SESSION["maxrows"];

$RSCountries = mysql_query("SELECT DISTINCT list_country FROM tbl_purebiz_listings WHERE list_active=1 AND list_sub=".$row_RSSubName["tbl_id"]);
$row_RSCountries = mysql_fetch_assoc($RSCountries);
$totalRows_RSCountries = mysql_num_rows($RSCountries);

$RSSponsored = mysql_query("SELECT *,rand() AS random_row FROM tbl_purebiz_listings WHERE list_active=1 AND list_sponsored=1 AND list_sub=".$row_RSSubName["tbl_id"]. "  ORDER BY ".random_row." LIMIT 7");
$row_RSSponsored = mysql_fetch_assoc($RSSponsored);
$totalRows_RSSponsored = mysql_num_rows($RSSponsored);

if (isset($_GET['t'])) {
  $t = $_GET['t'];
} else {
  $all_RSListings = mysql_query($query_RSListings);
  $t = mysql_num_rows($all_RSListings);
}
$totalPages_RSListings = ceil($t/$_SESSION["maxrows"])-1;

$queryString_RSListings = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
	if (stristr($param, "p") == false && 
		stristr($param, "t") == false) {
	  array_push($newParams, $param);
	}
  }
  if (count($newParams) != 0) {
	$queryString_RSListings = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RSListings = sprintf("&t=%d%s", $t, $queryString_RSListings);

if ($totalRows_RSListings > 0) {
  if ($totalRows_RSCountries > 1) {
	  $listings .= "<a href='?c=all'><img src='/images/directories/flags/globe.jpg' class='globepic' alt='Worldwide'></a>&nbsp;";
		do {
			$listings .= "<a href='?c=".$row_RSCountries["list_country"]."'>".getflag(strtoupper($row_RSCountries["list_country"]))."</a>&nbsp;";
		} while ($row_RSCountries = mysql_fetch_assoc($RSCountries));
  }  
  $listings .= "<div class='dirnavoptions'>";
  $listings .= "Total Profiles:&nbsp;".$t."&nbsp;&nbsp;";
  $listings .= "Page:&nbsp;";
  if ($p > 0) { $listings .= "<a href='?p=0".$queryString_RSListings."'><span class='img firstn'></span></a>"; } else { $listings .= "<span class='img firsto'></span>"; } 
  if ($p > 0) { $listings .= "&nbsp;<a href='?p=".max(0, $p - 1).$queryString_RSListings."'><span class='img prevn'></span></a>"; } else { $listings .= "&nbsp;<span class='img prevo'></span>"; }
  if ($p < $totalPages_RSListings) { $listings .= "&nbsp;<a href='?p=".min($totalPages_RSListings, $p + 1).$queryString_RSListings."'><span class='img nextn'></span></a>"; } else { $listings .= "&nbsp;<span class='img nexto'></span>"; }
  if ($p < $totalPages_RSListings) { $listings .= "&nbsp;<a href='?p=".$totalPages_RSListings.$queryString_RSListings."'><span class='img lastn'></span></a>"; } else { $listings .= "&nbsp;<span class='img lasto'></span>"; }
  $listings .= "&nbsp;&nbsp;";
  $listings .= "Show:&nbsp;";
  if ($_SESSION["maxrows"] != 5) { $listings .= "<a href='?n=5'><span class='img fiveo'></span></a>"; } else { $listings .= "<span class='img fiven'></span>"; }
  if ($_SESSION["maxrows"] != 10) { $listings .= "&nbsp;<a href='?n=10'><span class='img teno'></span></a>"; } else { $listings .= "&nbsp;<span class='img tenn'></span>"; }
  if ($_SESSION["maxrows"] != 20) { $listings .= "&nbsp;<a href='?n=20'><span class='img tweno'></span></a>"; } else { $listings .= "&nbsp;<span class='img twenn'></span>"; }
  if ($_SESSION["maxrows"] != 50) { $listings .= "&nbsp;<a href='?n=50'><span class='img fiftyo'></span></a>"; } else { $listings .= "&nbsp;<span class='img fiftyn'></span>"; }
  $listings .= "&nbsp;&nbsp;";
  $listings .= "Order:&nbsp;";
  if ($_SESSION["order"] != "list_name") { $listings .= "<a href='?o=1'><span class='img alphao'></span></a>"; } else { $listings .= "<span class='img alphan'></span>"; }
  if ($_SESSION["order"] != "tbl_id") { $listings .= "&nbsp;<a href='?o=2'><span class='img numbo'></span></a>"; } else { $listings .= "&nbsp;<span class='img numbn'></span>"; }
  if ($_SESSION["direction"] != "ASC") { $listings .= "&nbsp;<a href='?d=1'><span class='img upo'></span></a>"; } else { $listings .= "&nbsp;<span class='img upn'></span>"; }
  if ($_SESSION["direction"] != "DESC") { $listings .= "&nbsp;<a href='?d=2'><span class='img dwno'></span></a>"; } else { $listings .= "&nbsp;<span class='img dwnn'></span>"; }
  $listings .= "</div>";
	if ($totalRows_RSSponsored > 0) {
		$listings .= "<br><h1>SPONSORED LISTINGS</h1>";
		if ($totalRows_RSSponsored > 1) {
			for ($i=0;$i < 2; $i++) {
				$listings .= "<div class='dirlisting sponbg'><div class='dirlistpic'><a href='/adultdirectories/viewdetails.php?name=".strtolower($row_RSSponsored["list_name"])."&d=$dir/$sub&p=".$row_RSSponsored["tbl_id"]."'><img src='/adultdirectories/$dir/$sub/".$row_RSSponsored["list_title"]."/t/".$row_RSSponsored["list_ppic"]."'></a></div>";	
				$listings .= "<div class='dirinfo sponbg'>".getflag(strtoupper($row_RSSponsored["list_country"]))."&nbsp;&nbsp;<a href='/adultdirectories/viewdetails.php?name=".$row_RSSponsored["list_name"]."&d=$dir/$sub&p=".$row_RSSponsored["tbl_id"]."'>".strtoupper($row_RSSponsored["list_name"])."</a>&nbsp;&nbsp;<strong>COUNTRY:</strong> ".strtoupper($row_RSSponsored["list_country"])."&nbsp;&nbsp;<strong>AREA:</strong> ".strtoupper($row_RSSponsored["list_area"]). "<br>";
				$listings .= "".$row_RSSponsored["list_desc"]."</div>";
				$listings .= "<br class='clearfix'></div>";
				$row_RSSponsored = mysql_fetch_assoc($RSSponsored);
			}
		} else {
				$listings .= "<div class='dirlisting sponbg'><div class='dirlistpic'><a href='/adultdirectories/viewdetails.php?name=".strtolower($row_RSSponsored["list_name"])."&d=$dir/$sub&p=".$row_RSSponsored["tbl_id"]."'><img src='/adultdirectories/$dir/$sub/".$row_RSSponsored["list_title"]."/t/".$row_RSSponsored["list_ppic"]."'></a></div>";	
				$listings .= "<div class='dirinfo sponbg'>".getflag(strtoupper($row_RSSponsored["list_country"]))."&nbsp;&nbsp;<a href='/adultdirectories/viewdetails.php?name=".$row_RSSponsored["list_name"]."&d=$dir/$sub&p=".$row_RSSponsored["tbl_id"]."'>".strtoupper($row_RSSponsored["list_name"])."</a>&nbsp;&nbsp;<strong>COUNTRY:</strong> ".strtoupper($row_RSSponsored["list_country"])."&nbsp;&nbsp;<strong>AREA:</strong> ".strtoupper($row_RSSponsored["list_area"]). "<br>";
				$listings .= "".$row_RSSponsored["list_desc"]."</div>";
				$listings .= "<br class='clearfix'></div>";
				$row_RSSponsored = mysql_fetch_assoc($RSSponsored);
		}
		$listings .= "<h1>REGULAR LISTINGS</h1>";
	}
	do {	
    $listings .= "<div class='dirlisting'><div class='dirlistpic'><a href='/adultdirectories/viewdetails.php?name=".strtolower($row_RSListings["list_name"])."&d=$dir/$sub&p=".$row_RSListings["tbl_id"]."'><img src='/adultdirectories/$dir/$sub/".$row_RSListings["list_title"]."/t/".$row_RSListings["list_ppic"]."'></a></div>";	
	  $listings .= "<div class='dirinfo'>".getflag(strtoupper($row_RSListings["list_country"]))."&nbsp;&nbsp;<a href='/adultdirectories/viewdetails.php?name=".$row_RSListings["list_name"]."&d=$dir/$sub&p=".$row_RSListings["tbl_id"]."'>".strtoupper($row_RSListings["list_name"])."</a>&nbsp;&nbsp;<strong>COUNTRY:</strong> ".strtoupper($row_RSListings["list_country"])."&nbsp;&nbsp;<strong>AREA:</strong> ".strtoupper($row_RSListings["list_area"]). "<br>";
	  $listings .= "".$row_RSListings["list_desc"]."</div>";
    $listings .= "<br class='clearfix'></div>";
  } while ($row_RSListings = mysql_fetch_assoc($RSListings));
  $listings .= "<div class='dirnavoptions'>";
  $listings .= "Total Profiles:&nbsp;".$t."&nbsp;&nbsp;";
  $listings .= "Page:&nbsp;";
  if ($p > 0) { $listings .= "<a href='?p=0".$queryString_RSListings."'><span class='img firstn'></span></a>"; } else { $listings .= "<span class='img firsto'></span>"; } 
  if ($p > 0) { $listings .= "&nbsp;<a href='?p=".max(0, $p - 1).$queryString_RSListings."'><span class='img prevn'></span></a>"; } else { $listings .= "&nbsp;<span class='img prevo'></span>"; }
  if ($p < $totalPages_RSListings) { $listings .= "&nbsp;<a href='?p=".min($totalPages_RSListings, $p + 1).$queryString_RSListings."'><span class='img nextn'></span></a>"; } else { $listings .= "&nbsp;<span class='img nexto'></span>"; }
  if ($p < $totalPages_RSListings) { $listings .= "&nbsp;<a href='?p=".$totalPages_RSListings.$queryString_RSListings."'><span class='img lastn'></span></a>"; } else { $listings .= "&nbsp;<span class='img lasto'></span>"; }
  $listings .= "&nbsp;&nbsp;";
  $listings .= "Show:&nbsp;";
  if ($_SESSION["maxrows"] != 5) { $listings .= "<a href='?n=5'><span class='img fiveo'></span></a>"; } else { $listings .= "<span class='img fiven'></span>"; }
  if ($_SESSION["maxrows"] != 10) { $listings .= "&nbsp;<a href='?n=10'><span class='img teno'></span></a>"; } else { $listings .= "&nbsp;<span class='img tenn'></span>"; }
  if ($_SESSION["maxrows"] != 20) { $listings .= "&nbsp;<a href='?n=20'><span class='img tweno'></span></a>"; } else { $listings .= "&nbsp;<span class='img twenn'></span>"; }
  if ($_SESSION["maxrows"] != 50) { $listings .= "&nbsp;<a href='?n=50'><span class='img fiftyo'></span></a>"; } else { $listings .= "&nbsp;<span class='img fiftyn'></span>"; }
  $listings .= "&nbsp;&nbsp;";
  $listings .= "Order:&nbsp;";
  if ($_SESSION["order"] != "list_name") { $listings .= "<a href='?o=1'><span class='img alphao'></span></a>"; } else { $listings .= "<span class='img alphan'></span>"; }
  if ($_SESSION["order"] != "tbl_id") { $listings .= "&nbsp;<a href='?o=2'><span class='img numbo'></span></a>"; } else { $listings .= "&nbsp;<span class='img numbn'></span>"; }
  if ($_SESSION["direction"] != "ASC") { $listings .= "&nbsp;<a href='?d=1'><span class='img upo'></span></a>"; } else { $listings .= "&nbsp;<span class='img upn'></span>"; }
  if ($_SESSION["direction"] != "DESC") { $listings .= "&nbsp;<a href='?d=2'><span class='img dwno'></span></a>"; } else { $listings .= "&nbsp;<span class='img dwnn'></span>"; }
  $listings .= "</div>";
  if ($totalRows_RSCountries > 1) {
		mysql_data_seek($RSCountries,0);
	  $listings .= "<a href='?c=all'><img src='/images/directories/flags/globe.jpg' class='globepic' alt='Worldwide'></a>&nbsp;";
		do {
			$listings .= "<a href='?c=".$row_RSCountries["list_country"]."'>".getflag(strtoupper($row_RSCountries["list_country"]))."</a>&nbsp;";
		} while ($row_RSCountries = mysql_fetch_assoc($RSCountries));
  } 
  $listings .= "<br>";
  echo $listings;
} else {
	echo "<br><br><br><br><h2>Sorry, there are no listings in this category yet!</h2><br><br><br><br>";
}
mysql_free_result($RSCountries);
mysql_free_result($RSListings);
?>