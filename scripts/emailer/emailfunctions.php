<?php
function getHeader() {
	$theHeader = "
	<html>
	<body>
		<p style='font-size: 10px; font-family: Arial; font-style: italic;'>NOTE: You are receiving this email because you previously submitted a listing to our directory.</p>
		<table width='560' border='0' cellspacing='0' cellpadding='0'>
			<tr>
				<td width='560'>
					<table width='560' border='1' bordercolor='#901b4f' cellspacing='0' cellpadding='0' style='border: 2px solid #901b4f;'>
						<tr>
							<td>
								<table width='560' border='0' cellspacing='0' cellpadding='0' align='center'>
									<tr bgcolor='#C2367D'>
										<td width='560' height='148' valign='top'><a href='http://www.purebizness.net' target='_blank'><img src='http://www.purebizness.net/images/emailer/header.png' alt='Purebizness Adult Directory Logo' width='560' height='148' border='0' style='display: block;'></a></td>
									</tr>
									<tr bgcolor='#C2367D'>
										<td align='center' valign='top' height='20' style='padding: 5px; color: #FFFFFF; font-family: Arial; border-top: 2px solid #901b4f; border-bottom: 2px solid #901b4f;'><strong>Purebizness Listing Update</strong></td>
									</tr>
									<tr>
										<td valign='top' style='padding: 5px; font-family: Arial;'>
	";			
	return $theHeader;
}

function getFooter() {
	$theFooter = "
										</td>
									</tr>
									<tr>
										<td height='20' align='center' valign='middle' bgcolor='#C2367D' style='border-top: 2px solid #901b4f;'><a href='http://www.purebizness.net' target='_blank' style='color: #FFFFFF; font-size: 10px; font-family: Arial; text-decoration: none;'><strong>Purebizness Adult Directory</strong></a></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td><p style='font-size: 10px; font-family: Arial;'>The conditions of adding a listing to our directory require a permanent link back to us on your website. Periodically, our website automatically checks the URL you provide to verify our link is in place. Please ensure our link is viewable on the page you specify <strong>at all times</strong>.</p></td></tr>
		</table>
		<p style='font-size: 8px; font-family: Arial;'>&copy; ".gmdate("Y")." The Purebizness Team</p>
	</body>
	</html>
	";			
	return $theFooter;
}

function getprofileURL($id) {
  $con = mysql_connect("localhost","17803_d4w","ripkilo");
  if (!$con) {die('Could not connect: ' . mysql_error());}
  mysql_select_db("17803_purebizness", $con);
	
  $RSListing = mysql_query("SELECT list_name,list_sub FROM tbl_purebiz_listings WHERE tbl_id=$id");
  $row_RSListing = mysql_fetch_assoc($RSListing);
  $totalRows_RSListing = mysql_num_rows($RSListing);

  $RSDirSCats = mysql_query("SELECT sub_name,sub_cat FROM tbl_purebiz_dir_scats WHERE tbl_id=".$row_RSListing["list_sub"]);
  $row_RSDirSCats = mysql_fetch_assoc($RSDirSCats);
  $totalRows_RSDirSCats = mysql_num_rows($RSDirSCats);

	$RSDirCats = mysql_query("SELECT cat_name FROM tbl_purebiz_dir_cats WHERE tbl_id=".$row_RSDirSCats["sub_cat"]);
  $row_RSDirCats = mysql_fetch_assoc($RSDirCats);
  $totalRows_RSDirCats = mysql_num_rows($RSDirCats);
	
	$theURL = "http://www.purebizness.net/adultdirectories/viewdetails.php?name=".$row_RSListing["list_name"]."&d=".$row_RSDirCats["cat_name"]."/".$row_RSDirSCats["sub_name"]."&p=$id";
  
	mysql_free_result($RSDirCats);
  mysql_free_result($RSDirSCats);
  mysql_free_result($RSListing);
	
	return $theURL;
}
?>