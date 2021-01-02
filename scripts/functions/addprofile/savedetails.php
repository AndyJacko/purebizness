<?php require("../../db/connection.php"); ?>
<?php require("../../emailer/emailfunctions.php"); ?>
<?php session_start(); ?>
<?php 
//GENERIC DETAILS
$name = $_POST["Name"];
$password = $_POST["Password"];
$email = $_POST["Email"];
$country = $_POST["Country"];
$area = $_POST["Area"];
$website = $_POST["URL"];
$recip = $_POST["Recip"];
$subid = $_POST["subid"];
$type = $_POST["listtype"];
$keywords = $_POST["Keywords"];
$description = str_replace("'","&acute;",$_POST["Description"]);
//$title = strtolower(str_replace(" ","",$_POST["Name"]));
$title = "usr".mt_rand();
$phonenum = $_POST["Phone"];
$tday = gmdate("d/m/Y");
//BUSINESS DETAILS
$address = $_POST["Address"];
$postcode = $_POST["Postcode"];
//PERSONAL DETAILS
$age = $_POST["Age"];
$gender = $_POST["Gender"];
$hair = $_POST["Hair"];
$eye = $_POST["Eye"];
$height = $_POST["Height"];
$stats = $_POST["Stats"];
//ESCORT DETAILS
$prices = $_POST["Prices"];
$call = $_POST["Call"];
	 
if ($type == 1) {
	$insertSQL = "INSERT INTO tbl_purebiz_listings ";
	$insertSQL .= "(list_name,list_pass,list_email,list_country,list_area,list_url,list_recip,list_sub,list_type,list_keys,list_desc,list_title,list_date,list_num) VALUES ";
	$insertSQL .= "('".$name."','".$password."','".$email."','".$country."','".$area."','".$website."','".$recip."',".$subid.",".$type.",'".$keywords."','".$description."','".$title."','".$tday."','".$phonenum."')";
}
if ($type == 2) {
	$insertSQL = "INSERT INTO tbl_purebiz_listings ";
	$insertSQL .= "(list_name,list_pass,list_email,list_country,list_area,list_url,list_recip,list_sub,list_type,list_keys,list_desc,list_title,list_date,list_num,list_addy,list_postcode) VALUES ";
	$insertSQL .= "('".$name."','".$password."','".$email."','".$country."','".$area."','".$website."','".$recip."',".$subid.",".$type.",'".$keywords."','".$description."','".$title."','".$tday."','".$phonenum."','".$address."','".$postcode."')";
}
if ($type == 3) {
	$insertSQL = "INSERT INTO tbl_purebiz_listings ";
	$insertSQL .= "(list_name,list_pass,list_email,list_country,list_area,list_url,list_recip,list_sub,list_type,list_keys,list_desc,list_title,list_date,list_num,list_age,list_gender,list_hair,list_eyes,list_height,list_stats) VALUES ";
	$insertSQL .= "('".$name."','".$password."','".$email."','".$country."','".$area."','".$website."','".$recip."',".$subid.",".$type.",'".$keywords."','".$description."','".$title."','".$tday."','".$phonenum."',".$age.",".$gender.",".$hair.",".$eye.",".$height.",'".$stats."')";
}
if ($type == 4) {
	$insertSQL = "INSERT INTO tbl_purebiz_listings ";
	$insertSQL .= "(list_name,list_pass,list_email,list_country,list_area,list_url,list_recip,list_sub,list_type,list_keys,list_desc,list_title,list_date,list_num,list_age,list_gender,list_hair,list_eyes,list_height,list_stats,list_cost,list_calltype) VALUES ";
	$insertSQL .= "('".$name."','".$password."','".$email."','".$country."','".$area."','".$website."','".$recip."',".$subid.",".$type.",'".$keywords."','".$description."','".$title."','".$tday."','".$phonenum."',".$age.",".$gender.",".$hair.",".$eye.",".$height.",'".$stats."',".$prices.",".$call.")";
}

mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$Result1 = mysql_query($insertSQL, $Wisdom_Mcr) or die(mysql_error());
$theid = mysql_insert_id();

mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSSub = "SELECT * FROM tbl_purebiz_dir_scats WHERE tbl_id=".$subid;
$RSSub = mysql_query($query_RSSub, $Wisdom_Mcr) or die(mysql_error());
$row_RSSub = mysql_fetch_assoc($RSSub);
$totalRows_RSSub = mysql_num_rows($RSSub);

mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSCat = "SELECT * FROM tbl_purebiz_dir_cats WHERE tbl_id=".$row_RSSub["sub_cat"];
$RSCat = mysql_query($query_RSCat, $Wisdom_Mcr) or die(mysql_error());
$row_RSCat = mysql_fetch_assoc($RSCat);
$totalRows_RSCat = mysql_num_rows($RSCat);

$_SESSION["id"] = $theid;
$_SESSION["dir"] = $row_RSCat["cat_name"];
$_SESSION["sub"] = $row_RSSub["sub_name"];
$_SESSION["pname"] = $title;
$_SESSION["ptype"] = $type;
$root = "../../../adultdirectories/";
mkdir($root."/".$row_RSCat["cat_name"]."/".$row_RSSub["sub_name"]."/".$title."/");
mkdir($root."/".$row_RSCat["cat_name"]."/".$row_RSSub["sub_name"]."/".$title."/m/");
mkdir($root."/".$row_RSCat["cat_name"]."/".$row_RSSub["sub_name"]."/".$title."/t/");


mysql_free_result($RSCat);
mysql_free_result($RSSub);

// SEND EMAIL
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSProfile = "SELECT * FROM tbl_purebiz_listings WHERE tbl_id=".$theid;
$RSProfile = mysql_query($query_RSProfile, $Wisdom_Mcr) or die(mysql_error());
$row_RSProfile = mysql_fetch_assoc($RSProfile);
$totalRows_RSProfile = mysql_num_rows($RSProfile);

if (!isset($_SESSION["emailaddprofile"])) {
  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  $query_RSSub = "SELECT * FROM tbl_purebiz_dir_scats WHERE tbl_id=".$row_RSProfile["list_sub"];
  $RSSub = mysql_query($query_RSSub, $Wisdom_Mcr) or die(mysql_error());
  $row_RSSub = mysql_fetch_assoc($RSSub);
  $totalRows_RSSub = mysql_num_rows($RSSub);
  
  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  $query_RSCat = "SELECT * FROM tbl_purebiz_dir_cats WHERE tbl_id=".$row_RSSub["sub_cat"];
  $RSCat = mysql_query($query_RSCat, $Wisdom_Mcr) or die(mysql_error());
  $row_RSCat = mysql_fetch_assoc($RSCat);
  $totalRows_RSCat = mysql_num_rows($RSCat);
  
  //$to = "andy@purebizness.net";
  $to = $row_RSProfile["list_email"];
  $subject = "Listing added to Purebizness ".ucwords($row_RSCat["cat_disp_name"])." / ".ucwords($row_RSSub["sub_disp_name"])." Directory:";
	
	$mailbody = getHeader();	
  $mailbody .= "
	  <table width='550' border='0' cellspacing='0' cellpadding='0'>
			<tr>
			  <td valign='top' colspan='2' style='font-family: Arial; font-size: 12px;'>
          <p><strong>".$row_RSProfile["list_name"]."</strong>,</p>				
				  <p>Thank you for submitting your listing to our directory. Please make sure you have added our URL on the page of your website you specified. Our automated system will not authorise any listings which have not linked back.</p>
					<p>The information you have submitted is listed below, please retain a copy for your own records:</p>
				</td>
		  </tr>
			<tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
			<tr>
			  <td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Directory</strong></td>
			  <td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>".ucwords($row_RSCat["cat_disp_name"])." / ".ucwords($row_RSSub["sub_disp_name"])."</td>
		  </tr>
			<tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
			<tr>
			  <td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Name</strong></td>
			  <td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>".$row_RSProfile["list_name"]."</td>
		  </tr>
			<tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
			<tr>
			  <td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Password</strong></td>
			  <td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>".$row_RSProfile["list_pass"]."</td>
		  </tr>
			<tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
			<tr>
			  <td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Website URL</strong></td>
			  <td valign='top' width='450' style='font-family: Arial; font-size: 12px;'><a href='".$row_RSProfile["list_url"]."' target='_blank'>".$row_RSProfile["list_url"]."</a></td>
		  </tr>
			<tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
			<tr>
			  <td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Reciprocal URL</strong></td>
			  <td valign='top' width='450' style='font-family: Arial; font-size: 12px;'><a href='".$row_RSProfile["list_recip"]."' target='_blank'>".$row_RSProfile["list_recip"]."</a></td>
		  </tr>
			<tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
			<tr>
			  <td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Email Address</strong></td>
			  <td valign='top' width='450' style='font-family: Arial; font-size: 12px;'><a href='mailto:".$row_RSProfile["list_email"]."' target='_blank'>".$row_RSProfile["list_email"]."</a></td>
		  </tr>
			";
			if ($row_RSProfile["list_num"] != "") {
			$mailbody .= "				
			  <tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Phone Number</strong></td>
					<td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>".$row_RSProfile["list_num"]."</td>
				</tr>
			";
			}
			if ($row_RSProfile["list_addy"] != "") {
			$mailbody .= "				
			  <tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Address</strong></td>
					<td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>".$row_RSProfile["list_addy"]."</td>
				</tr>
			";
			}
			if ($row_RSProfile["list_area"] != "") {
			$mailbody .= "				
			  <tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Area</strong></td>
					<td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>".$row_RSProfile["list_area"]."</td>
				</tr>
			";
			}
			if ($row_RSProfile["list_country"] != "") {
			$mailbody .= "				
			  <tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Country</strong></td>
					<td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>".$row_RSProfile["list_country"]."</td>
				</tr>
			";
			}
			if ($row_RSProfile["list_postcode"] != "") {
			$mailbody .= "				
			  <tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Postcode</strong></td>
					<td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>".$row_RSProfile["list_postcode"]."</td>
				</tr>
			";
			}
			if ($row_RSProfile["list_gender"] != 0) {
			$mailbody .= "				
			  <tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Gender</strong></td>
					<td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>";
						switch ($row_RSProfile["list_gender"]){
							case 1:
									$mailbody .= "Male";
								break;
							case 2:
									$mailbody .= "Female";
								break;
							case 3:
									$mailbody .= "Pre-Op Transexual";
								break;
							case 4:
									$mailbody .= "Post-Op Transexual";
								break;
						}
					$mailbody .= "</td>
				</tr>
			";
			}
			if ($row_RSProfile["list_age"] != 0) {
			$mailbody .= "				
			  <tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Age</strong></td>
					<td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>";
						switch ($row_RSProfile["list_age"]){
							case 1:
									$mailbody .= "18 - 20";
								break;
							case 2:
									$mailbody .= "21 - 30";
								break;
							case 3:
									$mailbody .= "31 - 40";
								break;
							case 4:
									$mailbody .= "41 - 50";
								break;
							case 5:
									$mailbody .= "Over 50";
								break;
						}
					$mailbody .= "</td>
				</tr>
			";
			}
			if ($row_RSProfile["list_height"] != 0) {
			$mailbody .= "				
			  <tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Height</strong></td>
					<td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>";
						switch ($row_RSProfile["list_height"]){
							case 1:
									$mailbody .= "Shorter Than 5 Foot";
								break;
							case 2:
									$mailbody .= "5 Foot";
								break;
							case 3:
									$mailbody .= "5 Foot 1 Inches";
								break;
							case 4:
									$mailbody .= "5 Foot 2 Inches";
								break;
							case 5:
									$mailbody .= "5 Foot 3 Inches";
								break;
							case 6:
									$mailbody .= "5 Foot 4 Inches";
								break;
							case 7:
									$mailbody .= "5 Foot 5 Inches";
								break;
							case 8:
									$mailbody .= "5 Foot 6 Inches";
								break;
							case 9:
									$mailbody .= "5 Foot 7 Inches";
								break;
							case 10:
									$mailbody .= "5 Foot 8 Inches";
								break;
							case 11:
									$mailbody .= "5 Foot 9 Inches";
								break;
							case 12:
									$mailbody .= "5 Foot 10 Inches";
								break;
							case 13:
									$mailbody .= "5 Foot 11 Inches";
								break;
							case 14:
									$mailbody .= "6 Foot";
								break;
							case 15:
									$mailbody .= "Taller Than 6 Foot";
								break;
						}
					$mailbody .= "</td>
				</tr>
			";
			}
			if ($row_RSProfile["list_hair"] != 0) {
			$mailbody .= "				
			  <tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Hair</strong></td>
					<td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>";
						switch ($row_RSProfile["list_hair"]){
							case 1:
									$mailbody .= "Blonde";
								break;
							case 2:
									$mailbody .= "Brown";
								break;
							case 3:
									$mailbody .= "Auburn";
								break;
							case 4:
									$mailbody .= "Black";
								break;
							case 5:
									$mailbody .= "Brunette";
								break;
							case 6:
									$mailbody .= "Red";
								break;
							case 7:
									$mailbody .= "Mixed";
								break;
							case 8:
									$mailbody .= "Gray";
								break;
							case 9:
									$mailbody .= "Bald";
								break;
						}
					$mailbody .= "</td>
				</tr>
			";
			}
			if ($row_RSProfile["list_eyes"] != 0) {
			$mailbody .= "				
			  <tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Eyes</strong></td>
					<td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>";
						switch ($row_RSProfile["list_eyes"]){
							case 1:
									$mailbody .= "Blue";
								break;
							case 2:
									$mailbody .= "Hazel";
								break;
							case 3:
									$mailbody .= "Brown";
								break;
							case 4:
									$mailbody .= "Green";
								break;
							case 5:
									$mailbody .= "Gray";
								break;
						}
					$mailbody .= "</td>
				</tr>
			";
			}
			if ($row_RSProfile["list_stats"] != 0) {
			$mailbody .= "				
			  <tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Stats</strong></td>
					<td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>".$row_RSProfile["list_stats"]."</td>
				</tr>
			";
			}
			if ($row_RSProfile["list_cost"] != 0) {
			$mailbody .= "				
			  <tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Prices</strong></td>
					<td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>";
						switch ($row_RSProfile["list_cost"]){
							case 1:
									$mailbody .= "Not Applicable";
								break;
							case 2:
									$mailbody .= "Not Given";
								break;
							case 3:
									$mailbody .= "Less Than &pound;50 per hour";
								break;
							case 4:
									$mailbody .= "&pound;60 per hour";
								break;
							case 5:
									$mailbody .= "&pound;70 per hour";
								break;
							case 6:
									$mailbody .= "&pound;80 per hour";
								break;
							case 7:
									$mailbody .= "&pound;90 per hour";
								break;
							case 8:
									$mailbody .= "&pound;100 per hour";
								break;
							case 9:
									$mailbody .= "&pound;100 - &pound;150 per hour";
								break;
							case 10:
									$mailbody .= "&pound;150 - &pound;200 per hour";
								break;
							case 11:
									$mailbody .= "&pound;200 - &pound;250 per hour";
								break;
							case 12:
									$mailbody .= "&pound;250 - &pound;300 per hour";
								break;
							case 13:
									$mailbody .= "More Than &pound;300 per hour";
								break;
						}
					$mailbody .= "</td>
				</tr>
			";
			}
			if ($row_RSProfile["list_calltype"] != 0) {
			$mailbody .= "				
			  <tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Calls</strong></td>
					<td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>";
						switch ($row_RSProfile["list_calltype"]){
							case 1:
									$mailbody .= "Incall";
								break;
							case 2:
									$mailbody .= "Outcall";
								break;
							case 3:
									$mailbody .= "Incall & Outcall";
								break;
						}
					$mailbody .= "</td>
				</tr>
			";
			}
			if ($row_RSProfile["list_keys"] != "") {
			$mailbody .= "				
			  <tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Keywords</strong></td>
					<td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>".$row_RSProfile["list_keys"]."</td>
				</tr>
			";
			}
			if ($row_RSProfile["list_desc"] != "") {
			$mailbody .= "				
			  <tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' width='100' style='font-family: Arial; font-size: 12px;'><strong>Description</strong></td>
					<td valign='top' width='450' style='font-family: Arial; font-size: 12px;'>".nl2br($row_RSProfile["list_desc"])."</td>
				</tr>
			";
			}
			$mailbody .= "
			</table>
			";	
	$mailbody .= getFooter();	

  $headers = "MIME-Version: 1.0 \n";
  $headers .= "Content-type:text/html;charset=utf-8 \n";
  $headers .= "From: noreply@purebizness.net \n";
  $headers .= "BCC: andy@purebizness.net,webmaster@purebizness.net \n";  
  mail($to,$subject,$mailbody,$headers);
  
  mysql_free_result($RSCat);
  mysql_free_result($RSSub);
  $_SESSION["emailaddprofile"] = 1;
}

header("Location: /adultdirectories/addprofilepic.php");
?>
