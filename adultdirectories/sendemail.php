<?php require("../scripts/db/connection.php"); ?>
<?php require("../scripts/functions/nav/navfunctions.php"); ?>
<?php require("../scripts/emailer/profileemailfunctions.php"); ?>
<?php session_start(); ?>
<?php
if (isset($_GET["id"])) {
	$_SESSION["id"] = $_GET["id"];
}
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSProfile = "SELECT * FROM tbl_purebiz_listings WHERE tbl_id=".$_SESSION["id"];
$RSProfile = mysql_query($query_RSProfile, $Wisdom_Mcr) or die(mysql_error());
$row_RSProfile = mysql_fetch_assoc($RSProfile);
$totalRows_RSProfile = mysql_num_rows($RSProfile);

$cap = 1;
if ($_POST["Message"] != ""){
  require_once('../scripts/functions/recaptcha/recaptchalib.php');
  $privatekey = "";
  $resp = recaptcha_check_answer ($privatekey,
		  $_SERVER["REMOTE_ADDR"],
		  $_POST["recaptcha_challenge_field"],
		  $_POST["recaptcha_response_field"]);
  
	if (!$resp->is_valid) {
	  $cap = 0;
  } else {
		//$to = andy@purebizness.net;
		//$to = "wisdom.mcr@gmail.com";
		$to = $row_RSProfile["list_email"];
		$subject = $row_RSProfile["list_name"].", You have an enquiry from your Purebizness profile";
		
		$mailbody = getHeader();	
		$mailbody .= "
			<table width='550' border='0' cellspacing='0' cellpadding='0'>
				<tr>
					<td valign='top' colspan='2' style='font-family: Arial; font-size: 12px;'>
						<p><strong>".$row_RSProfile["list_name"]."</strong>,</p>				
						<p>A visitor to your profile has left you the following message. Do not reply directly to this email, please click on the email address below to reply to the sender:</p>
					</td>
				</tr>
				<tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td width='82' valign='top' style='font-family: Arial; font-size: 12px;'><strong>Name</strong></td>
					<td width='464' valign='top' style='font-family: Arial; font-size: 12px;'>".$_POST["Name"]."</td>
				</tr>
				<tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' style='font-family: Arial; font-size: 12px;'><strong>Email</strong></td>
					<td valign='top' style='font-family: Arial; font-size: 12px;'>".$_POST["Email"]."</td>
				</tr>
				<tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' style='font-family: Arial; font-size: 12px;'><strong>Message</strong></td>
					<td valign='top' style='font-family: Arial; font-size: 12px;'>".nl2br(str_replace("'","&acute;",$_POST["Message"]))."</td>
				</tr>
			</table>
		";	
		$mailbody .= getFooter();	
		$headers = "MIME-Version: 1.0 \n";
		$headers .= "Content-type:text/html;charset=utf-8 \n";
		$headers .= "From: noreply@purebizness.net \n";
		$headers .= "BCC: andy@purebizness.net \n";		
		
		mail($to,$subject,$mailbody,$headers);
		
		header(sprintf("Location: sendemail.php?s=1"));
  }
}
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/usersideGeneric.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Send An Email</title>
<!-- InstanceEndEditable -->
<link href="/scripts/css/purebizness.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/scripts/js/gallery/jquery-1.6.1.min.js"></script> 
<script type="text/javascript" src="/scripts/js/purebizness.js"></script> 
<script type="text/javascript" src="/scripts/js/nav/jquery.color.js"></script> 
<script type="text/javascript" src="/scripts/js/nav/jMenu.js"></script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33275085-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</head>

<body>
  <header id="header"><?php include('../scripts/design/header.php'); ?></header>
  <section id="pagebody">
    <div id="content" class="column">
      <div id="actualcontent">
      <!-- InstanceBeginEditable name="content" -->
      <h1>Send <?php echo $row_RSProfile["list_name"]; ?> An Email</h1>
      <br>
      <p>Please complete the form below with your required message, then click "SEND" to send the message.</p>
      <br>
      <button onClick="self.location='<?php echo $_SESSION["dirlink"]; ?>'" class="backbutton">Back To Directory</button>&nbsp;&nbsp;<button onClick="self.location='<?php echo $_SESSION["prolink"]; ?>'" class="backbutton">Back To Profile</button>
      <br><br>
      <?php if ($_GET["s"] == 1) { echo "<p class='msg'>Your message has been sent sucessfully.</p><br><br>"; } ?>
      <?php if ($cap == 0) { echo("<p class='msg'>reCaptcha was wrong, please retry...</p><br><br>"); } ?>
      <div id="emails" class="emailsform">
        <script type="text/javascript"> var RecaptchaOptions = { theme : 'clean' }; </script>
        <form action="" method="post">
          <label>Name<span class="small">Your full name</span></label>
          <input type="text" name="Name" id="Name" value="<?php echo $_POST["Name"]; ?>">
          <div class="clearfix"></div>
          <label>Email<span class="small">Your email address</span></label>
          <input type="text" name="Email" id="Email" value="<?php echo $_POST["Email"]; ?>">
          <div class="clearfix"></div>
          <label>Message<span class="small">Please enter your message</span></label>
          <textarea name="Message" id="Message" rows="20"><?php echo $_POST["Message"]; ?></textarea>
          <div class="clearfix"></div>
          <div class="captcha"><?php require_once('../scripts/functions/recaptcha/recaptchalib.php'); $publickey = ""; echo recaptcha_get_html($publickey); ?></div>
          <br class="clearfix">
          <button type="submit" onClick="return validatesendemailform();">SEND</button> or <button type="button" onClick="self.location='<?php echo $_SESSION["prolink"]; ?>'">CANCEL</button>
        </form>
      </div>
      <!-- InstanceEndEditable -->
      </div>
    </div>
    <nav id="sitenav" class="column"><?php require("../scripts/design/nav.php"); ?></nav>
    <section id="rhs" class="column"><?php require("../scripts/design/ads.php"); ?></section>
    <br class="clearfix">
  </section>
  <footer id="footer"><?php require("../scripts/design/footer.php"); ?></footer>
</body>
<!-- InstanceEnd --></html>
<?php 
mysql_free_result($RSProfile);
?>