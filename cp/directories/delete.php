<?php require("../../scripts/db/connection.php"); ?>
<?php require("../../scripts/cp/authnlogout.php"); ?>
<?php require("../../scripts/cp/functions/directoryfunctions.php"); ?>
<?php require("../../scripts/emailer/emailfunctions.php"); ?>
<?php 
if ($_GET["tbl_id"] != "") {
	mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
	$query_RSListing = "SELECT * FROM tbl_purebiz_listings WHERE tbl_id=".$_GET["tbl_id"];
	$RSListing = mysql_query($query_RSListing, $Wisdom_Mcr) or die(mysql_error());
	$row_RSListing = mysql_fetch_assoc($RSListing);
	$totalRows_RSListing = mysql_num_rows($RSListing);
	
	$thedir = "../../adultdirectories/".strtolower(str_replace(" ","",str_replace(" - ","/",getdirectoryname($row_RSListing["list_sub"]))))."/".$row_RSListing["list_title"];
	
	rrmdir($thedir);
	
	//$to = "andy@purebizness.net";
	$to = $row_RSListing["list_email"];
	$subject = "Purebizness Listing Update";
	$mailbody = getHeader();	
  $mailbody .= "
	<table width='550' border='0' cellspacing='0' cellpadding='0'>
		<tr>
			<td align='justify' style='font-family: Arial; font-size: 12px;'>
				<p><strong>".$row_RSListing["list_name"]."</strong>,</p>
  ";				
	switch ($_GET["r"]) {
		case 1:
		$mailbody .= "
				<p>Your Purebizness listing has been deleted and is no longer viewable on our website.<br><br>Your listing has been deleted because we could no longer locate our URL on the Reciprocal URL link you provided in your submission and no action has been taken by you to resolve the issue.
				<p><i><strong>If you wish to have a Purebizness Listing any time in the future, please ensure our URL is viewable on your website at all times.</strong></i></p>
    ";
		break;
		case 2:
		$mailbody .= "
				<p>Your Purebizness listing has been deleted at your request and is no longer viewable on our website.</p>
				<p><i><strong>If you wish to have a Purebizness Listing any time in the future, please resubmit your details.</strong></i></p>
    ";
		break;
		case 3:
		$mailbody .= "
				<p>Your Purebizness listing has been deleted.<br><br>Please <a href='mailto:webmaster@purebizness.net' target='_blank'>Contact Us</a> if you wish to discuss the matter further.</p>
    ";
		break;
	}
	$mailbody .= "
				<br />
				<p>Regards</p>
				<p>The Purebizness Team</p>
			</td>
		</tr>
	</table>
	";	
	$mailbody .= getFooter();	
	$headers = "MIME-Version: 1.0 \n";
	$headers .= "Content-type:text/html;charset=utf-8 \n";
	$headers .= "From: noreply@purebizness.net \n";
	//$headers .= "BCC: andy@purebizness.net \n";		
	
	mail($to,$subject,$mailbody,$headers);

	$deleteSQL = "DELETE FROM tbl_purebiz_listings WHERE tbl_id=".$_GET["tbl_id"];
  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  $Result1 = mysql_query($deleteSQL, $Wisdom_Mcr) or die(mysql_error());
  
	mysql_free_result($RSListing);

	echo "deleted";
}
?>