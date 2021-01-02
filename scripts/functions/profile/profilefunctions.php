<?php
function getgender($gender) {
	switch ($gender){
		case 0:
		  $getgender = "Not Entered";
		  break;
		case 1:
		  $getgender = "Male";
		  break;
		case 2:
		  $getgender = "Female";
		  break;
		case 3:
		  $getgender = "Pre-Op Transexual";
		  break;
		case 4:
		  $getgender = "Post-Op Transexual";
		  break;
		case 5:
		  $getgender = "Couple";
		  break;
		default:
			$getgender = "Not Entered";
	}
	return $getgender;
}

function getcalltype($calltype) {
	switch ($calltype){
		case 0:
		  $getcalltype = "Not Entered";
		  break;
		case 1:
		  $getcalltype = "Incall";
		  break;
		case 2:
		  $getcalltype = "Outcall";
		  break;
		case 3:
		  $getcalltype = "Incall & Outcall";
		  break;
		default:
			$getcalltype = "Not Entered";
	}
	return $getcalltype;
}

function gethaircolour($haircolour) {
	switch ($haircolour){
		case 0:
		  $gethaircolour = "Not Entered";
		  break;
		case 1:
		  $gethaircolour = "Blonde";
		  break;
		case 2:
		  $gethaircolour = "Brown";
		  break;
		case 3:
		  $gethaircolour = "Auburn";
		  break;
		case 4:
		  $gethaircolour = "Black";
		  break;
		case 5:
		  $gethaircolour = "Brunette";
		  break;
		case 6:
		  $gethaircolour = "Red";
		  break;
		case 7:
		  $gethaircolour = "Mixed";
		  break;
		case 8:
		  $gethaircolour = "Gray";
		  break;
		case 9:
		  $gethaircolour = "Bald";
		  break;
		default:
			$gethaircolour = "Not Entered";
	}
	return $gethaircolour;
}

function geteyecolour($eyecolour) {
	switch ($eyecolour){
		case 0:
		  $geteyecolour = "Not Entered";
		  break;
		case 1:
		  $geteyecolour = "Blue";
		  break;
		case 2:
		  $geteyecolour = "Hazel";
		  break;
		case 3:
		  $geteyecolour = "Brown";
		  break;
		case 4:
		  $geteyecolour = "Green";
		  break;
		case 5:
		  $geteyecolour = "Gray";
		  break;
		default:
			$geteyecolour = "Not Entered";
	}
	return $geteyecolour;
}

function getage($age) {
	switch ($age){
		case 0:
		  $getage = "Not Entered";
		  break;
		case 1:
		  $getage = "18 - 20";
		  break;
		case 2:
		  $getage = "21 - 30";
		  break;
		case 3:
		  $getage = "31 - 40";
		  break;
		case 4:
		  $getage = "41 - 50";
		  break;
		case 5:
		  $getage = "Over 50";
		  break;
		default:
			$getage = "Not Entered";
	}
	return $getage;
}

function getheight($height) {
	switch ($height){
		case 0:
		  $getheight = "Not Entered";
		  break;
		case 1:
		  $getheight = "Shorter Than 5 Foot";
		  break;
		case 2:
		  $getheight = "5 Foot";
		  break;
		case 3:
		  $getheight = "5 Foot 1 Inches";
		  break;
		case 4:
		  $getheight = "5 Foot 2 Inches";
		  break;
		case 5:
		  $getheight = "5 Foot 3 Inches";
		  break;
		case 6:
		  $getheight = "5 Foot 4 Inches";
		  break;
		case 7:
		  $getheight = "5 Foot 5 Inches";
		  break;
		case 8:
		  $getheight = "5 Foot 6 Inches";
		  break;
		case 9:
		  $getheight = "5 Foot 7 Inches";
		  break;
		case 10:
		  $getheight = "5 Foot 8 Inches";
		  break;
		case 11:
		  $getheight = "5 Foot 9 Inches";
		  break;
		case 12:
		  $getheight = "5 Foot 10 Inches";
		  break;
		case 13:
		  $getheight = "5 Foot 11 Inches";
		  break;
		case 14:
		  $getheight = "6 Foot";
		  break;
		case 15:
		  $getheight = "Taller Than 6 Foot";
		  break;
		default:
			$getheight = "Not Entered";
	}
	return $getheight;
}

function getprices($price) {
	switch ($price){
		case 0:
		  $getprice = "Not Entered";
		  break;
		case 1:
		  $getprice = "Not Applicable";
		  break;
		case 2:
		  $getprice = "Not Given";
		  break;
		case 3:
		  $getprice = "Less Than &pound;50 per hour";
		  break;
		case 4:
		  $getprice = "&pound;60 per hour";
		  break;
		case 5:
		  $getprice = "&pound;70 per hour";
		  break;
		case 6:
		  $getprice = "&pound;80 per hour";
		  break;
		case 7:
		  $getprice = "&pound;90 per hour";
		  break;
		case 8:
		  $getprice = "&pound;100 per hour";
		  break;
		case 9:
		  $getprice = "&pound;100 - &pound;150 per hour";
		  break;
		case 10:
		  $getprice = "&pound;150 - &pound;200 per hour";
		  break;
		case 11:
		  $getprice = "&pound;200 - &pound;250 per hour";
		  break;
		case 12:
		  $getprice = "&pound;250 - &pound;300 per hour";
		  break;
		case 13:
		  $getprice = "More Than &pound;300 per hour";
			break;
		default:
			$getprice = "Not Entered";
	}
	return $getprice;
}

function getpath($id) {
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
?>

