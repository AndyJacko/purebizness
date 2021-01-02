<?php require("../../scripts/db/connection.php"); ?>
<?php require("../../scripts/functions/nav/navfunctions.php"); ?>
<?php require("../../scripts/emailer/customemailfunctions.php"); ?>
<?php session_start(); ?>
<?php
if (isset($_GET['ID'])) {
	mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
	$query_RSProfile = "SELECT list_name,list_email,list_pass FROM tbl_purebiz_listings WHERE tbl_id='".$_GET['ID']."'";
	$RSProfile = mysql_query($query_RSProfile, $Wisdom_Mcr) or die(mysql_error());
	$row_RSProfile = mysql_fetch_assoc($RSProfile);
	$totalRows_RSProfile = mysql_num_rows($RSProfile);
  if ($totalRows_RSProfile) {
    $err = 1;
		//$to = "andy@purebizness.net";
		$to = $row_RSProfile["list_email"];
		$subject = "Your Purebizness Password";
		
		$mailbody = getHeader("Forgotten Password Reminder","You are receiving this email because you submitted a password reminder");	
		$mailbody .= "
			<table width='550' border='0' cellspacing='0' cellpadding='0'>
				<tr>
					<td colspan='2' valign='top' style='font-family: Arial; font-size: 12px;'><strong>".$row_RSProfile["list_name"]."</strong>, you have requested a password reminder.<br><br><br>Your login details are as follows:</td>
				</tr>
				<tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td width='100' valign='top' style='font-family: Arial; font-size: 12px;'><strong>Login Name</strong></td>
					<td width='440' valign='top' style='font-family: Arial; font-size: 12px;'>".$row_RSProfile["list_name"]."</td>
				</tr>
				<tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td width='100' valign='top' style='font-family: Arial; font-size: 12px;'><strong>Password</strong></td>
					<td width='440' valign='top' style='font-family: Arial; font-size: 12px;'>".$row_RSProfile["list_pass"]."</td>
				</tr>
				<tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td colspan='2' valign='top' style='font-family: Arial; font-size: 12px;'>You should now be able to login to your listing <a href='http://www.purebizness.net/adultdirectories/login.php' target='_blank' style='color: #000001;'><strong>here</strong></a>.<br><br><br><br></td>
				</tr>
				<tr>
					<td colspan='2' valign='top' style='font-family: Arial; font-size: 10px;'>If you are still having problems logging into your account after using these details, please <a href='http://www.purebizness.net/contact_us.php' target='_blank' style='color: #000001;'><strong>contact us</strong></a>.</td>
				</tr>
			</table>
		";	
		$mailbody .= getFooter();	
		$headers = "MIME-Version: 1.0 \n";
		$headers .= "Content-type:text/html;charset=utf-8 \n";
		$headers .= "From: noreply@purebizness.net \n";
		
		mail($to,$subject,$mailbody,$headers);
		mysql_free_result($RSProfile);
		echo "sent";
	} 
}
?>