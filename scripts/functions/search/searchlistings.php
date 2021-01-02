<?php
do {	
	$listings .= "<div class='dirlisting'><div class='dirlistpic'><a href='/adultdirectories/viewdetails.php?name=".strtolower($row_RSListings["list_name"])."&d=$dir/$sub&p=".$row_RSListings["tbl_id"]."'><img src='/adultdirectories/$dir/$sub/".$row_RSListings["list_title"]."/t/".$row_RSListings["list_ppic"]."'></a></div>";	
	$listings .= "<div class='dirinfo'>".getflag(strtoupper($row_RSListings["list_country"]))."&nbsp;&nbsp;<a href='/adultdirectories/viewdetails.php?name=".$row_RSListings["list_name"]."&d=$dir/$sub&p=".$row_RSListings["tbl_id"]."'>".strtoupper($row_RSListings["list_name"])."</a>&nbsp;&nbsp;<strong>COUNTRY:</strong> ".strtoupper($row_RSListings["list_country"])."&nbsp;&nbsp;<strong>AREA:</strong> ".strtoupper($row_RSListings["list_area"]). "<br>";
	$listings .= "".$row_RSListings["list_desc"]."</div>";
	$listings .= "<br class='clearfix'></div>";
} while ($row_RSListings = mysql_fetch_assoc($RSListings));
$listings .= "<br>";
echo $listings;
?>