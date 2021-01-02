<?php require("../../scripts/db/connection.php"); ?>
<?php require("../../scripts/cp/authnlogout.php"); ?>
<?php require("../../scripts/emailer/emailfunctions.php"); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSListing = "SELECT * FROM tbl_purebiz_listings WHERE tbl_id=".$_GET["tbl_id"];
$RSListing = mysql_query($query_RSListing, $Wisdom_Mcr) or die(mysql_error());
$row_RSListing = mysql_fetch_assoc($RSListing);
$totalRows_RSListing = mysql_num_rows($RSListing);

//$to = "andy@purebizness.net";
$to = $row_RSListing["list_email"];
$subject = "Purebizness Listing Update";

if ($_GET["s"] == 0) {
  $d8 = gmdate("d/m/Y");
  $updateSQL = "UPDATE tbl_purebiz_listings SET list_active=0,list_flagged=1,list_flagged_date='$d8' WHERE tbl_id=".$_GET["tbl_id"];
  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  $Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());
	
	$mailbody = getHeader();	
  $mailbody .= "
	<table width='550' border='0' cellspacing='0' cellpadding='0'>
		<tr>
			<td align='justify' style='font-family: Arial; font-size: 12px;'>
				<p><strong>".$row_RSListing["list_name"]."</strong>,</p>
				<p>Your Purebizness listing has been deactivated and is no longer viewable on our website.<br><br>Your listing has been deactivated because we could no longer locate our URL on the Reciprocal URL link you provided in your submission.
				<p><i><strong>If you have changed the page name or location of our URL you can simply <a href='http://www.purebizness.net/adultdirectories/login.php' target='_blank'>update your listing</a>. Once our URL is verified your listing will be reactivated.</strong></i></p>
				<p>Alternatively, there are several other options available to you:</p>
				<p>
					<strong>&nbsp;&nbsp;Do Nothing</strong> - Your listing will be deleted in 7 days.<br />
					<strong>&nbsp;&nbsp;Add our URL to your website and <a href='http://www.purebizness.net/adultdirectories/login.php' target='_blank'>update your listing</a></strong> - Once verified your listing will be reactivated.<br />
					<strong>&nbsp;&nbsp;<a href='mailto:webmaster@purebizness.net?subject=Deactivated&nbsp;Listing&nbsp;Error'>Contact Us</a> if you believe you recieved this email in error</strong> - We will help to resolve the issue.
				</p>
				<br />
				<p>Regards</p>
				<p>The Purebizness Team</p>
			</td>
		</tr>
	</table>
	";	
	$mailbody .= getFooter();	
	
  echo "flagyicon";
} else {
  $updateSQL = "UPDATE tbl_purebiz_listings SET list_active=1,list_flagged=0,list_flagged_date='' WHERE tbl_id=".$_GET["tbl_id"];
  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  $Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());
	
	$mailbody = getHeader();	
  $mailbody .= "
	<table width='550' border='0' cellspacing='0' cellpadding='0'>
		<tr>
			<td align='justify' style='font-family: Arial; font-size: 12px;'>
				<p><strong>".$row_RSListing["list_name"]."</strong>,</p>
				<p>We are pleased to inform you that your Purebizness listing has been reactivated and is now viewable on our website again.</p>
				<p>Please follow <a href='".getprofileURL($_GET["tbl_id"])."' target='_blank'>This Link</a> to view your listing.</p>
				<br />
				<p>Regards</p>
				<p>The Purebizness Team</p>
			</td>
		</tr>
	</table>
	";	
	$mailbody .= getFooter();	
	
  echo "flagnicon";
}

$headers = "MIME-Version: 1.0 \n";
$headers .= "Content-type:text/html;charset=utf-8 \n";
$headers .= "From: noreply@purebizness.net \n";
//$headers .= "BCC: andy@purebizness.net \n";		

mail($to,$subject,$mailbody,$headers);

mysql_free_result($RSListing);
?>