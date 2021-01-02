<?php require("../../scripts/db/connection.php"); ?>
<?php require("../../scripts/cp/authnlogout.php"); ?>
<?php require("../../scripts/emailer/emailfunctions.php"); ?>
<?php
$d8 = gmdate("d/m/Y");
$updateSQL = "UPDATE tbl_purebiz_listings SET list_active=0,list_flagged=1,list_flagged_date='$d8' WHERE tbl_id=".$_GET["tbl_id"];
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());

mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSListing = "SELECT * FROM tbl_purebiz_listings WHERE tbl_id=".$_GET["tbl_id"];
$RSListing = mysql_query($query_RSListing, $Wisdom_Mcr) or die(mysql_error());
$row_RSListing = mysql_fetch_assoc($RSListing);
$totalRows_RSListing = mysql_num_rows($RSListing);

//$to = "andy@purebizness.net";
$to = $row_RSListing["list_email"];
$subject = "Purebizness Listing Update";

$mailbody = getHeader();	
$mailbody .= "
<table width='550' border='0' cellspacing='0' cellpadding='0'>
	<tr>
		<td align='justify' style='font-family: Arial; font-size: 12px;'>
			<p><strong>".$row_RSListing["list_name"]."</strong>,</p>
			<p>Purebizness Listing <strong>NOT</strong> Activated.<br><br>Your listing could not be activated because our URL was not found on the Reciprocal URL link you provided in your submission.
			<p>Please add our URL to your website and <a href='mailto:webmaster@purebizness.net?subject=Added&nbsp;Reciprocal&nbsp;Link'>Contact Us</a> - Once verified your listing will be activated.</p>
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

echo "emailyicon";

mysql_free_result($RSListing);
?>