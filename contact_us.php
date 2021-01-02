<?php require("scripts/db/connection.php"); ?>
<?php require("scripts/functions/nav/navfunctions.php"); ?>
<?php require("scripts/emailer/contactemailfunctions.php"); ?>
<?php session_start(); ?>
<?php
$cap = 1;
if ($_POST["Message"] != ""){
  require_once('scripts/functions/recaptcha/recaptchalib.php');
  $privatekey = "";
  $resp = recaptcha_check_answer ($privatekey,
		  $_SERVER["REMOTE_ADDR"],
		  $_POST["recaptcha_challenge_field"],
		  $_POST["recaptcha_response_field"]);
  if (!$resp->is_valid) {
	$cap = 0;
  } else {
		//$to = "andy@purebizness.net";
		$to = "webmaster@purebizness.net";
		$subject = "Enquiry from Purebizness Website";
		
		$mailbody = getHeader();	
		$mailbody .= "
			<table width='550' border='0' cellspacing='0' cellpadding='0'>
				<tr>
					<td width='82' valign='top' style='font-family: Arial; font-size: 12px;'><strong>Name</strong></td>
					<td width='464' valign='top' style='font-family: Arial; font-size: 12px;'>".$_POST["Name"]."</td>
				</tr>
				<tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' style='font-family: Arial; font-size: 12px;'><strong>Email</strong></td>
					<td valign='top' style='font-family: Arial; font-size: 12px;'>".$_POST["Email"]."</td>
				</tr>
			";
			if (isset($_POST["How"])) {	
				$mailbody .= "	
				<tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
						<td valign='top' style='font-family: Arial; font-size: 12px;'><strong>How</strong></td>
						<td valign='top' style='font-family: Arial; font-size: 12px;'>".$_POST["How"]."</td>
					</tr>
				";
			}
			
			if ($_POST["Keyword"] != "") {
				$mailbody .= "	
				<tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
						<td valign='top' style='font-family: Arial; font-size: 12px;'><strong>Keyword</strong></td>
						<td valign='top' style='font-family: Arial; font-size: 12px;'>".$_POST["Keyword"]."</td>
					</tr>
				";
			}
			$mailbody .= "	
				<tr><td colspan='2'><hr style='height: 1px; color: #901b4f;'></td></tr>
				<tr>
					<td valign='top' style='font-family: Arial; font-size: 12px;'><strong>Comment</strong></td>
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

		header("Location: contact_us.php?s=1");
  }
}
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/usersideGeneric.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Contact Us</title>
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
  <header id="header"><?php include('scripts/design/header.php'); ?></header>
  <section id="pagebody">
    <div id="content" class="column">
      <div id="actualcontent">
      <!-- InstanceBeginEditable name="content" -->
      <h1>Contact Us</h1>
      <br>
      <p><strong>webmaster [at] purebizness [dot] net</strong></p>
      <br><br>
      <p><strong>Alternatively please use this form to contact The Purebizness Team.</strong><br><br>
      We are always interested in your requirements, feel free to contact us with your specific needs. Please send us any comments or suggestions you may have about the Purebizness Website.<br>
      If you have any questions about any of our services or any issues relating to the Internet, please email us.</p>
      <p><strong><em>Please Note:</em></strong><br>
      Any information you supply will be treated in confidence, and will not be made available to third parties.&nbsp; We do not use, or sell names and details to mailing lists.</p>
      <br>
      <?php if ($_GET["s"] == 1) { echo "<p class='msg'>Thank you for your message. If required we will respond ASAP.</p><br><br>"; } ?>
      <?php if ($cap == 0) { echo("<p class='msg'>reCaptcha was wrong, please retry...</p><br><br>"); } ?>
      <div id="emails" class="emailsform">
        <script type="text/javascript"> var RecaptchaOptions = { theme : 'clean' }; </script>
        <form action="" method="post">
          <label>Name<span class="small">Your full name</span></label>
          <input type="text" name="Name" id="Name" value="<?php echo $_POST["Name"]; ?>">
          <div class="clearfix"></div>
          <label>Email<span class="small">Your email address</span></label>
          <input type="email" name="Email" id="Email" value="<?php echo $_POST["Email"]; ?>">
          <div class="clearfix"></div>
          <label>How<span class="small">How did you find us?</span></label>
          <select name="How" id="How">
            <option>PLEASE SELECT</option> 
            <option></option>
            <option>======================================================</option>
            <option>SEARCH ENGINE</option>
            <option>======================================================</option>
            <option value="www.google.com">Google</option>
            <option value="www.yahoo.com">Yahoo</option>
            <option value="www.excite.com">Excite</option>
            <option value="www.overture.com">Overture</option>
            <option value="www.mamma.com">Mamma</option>
            <option value="www.metacrawler.com">Metacrawler</option>
            <option value="www.hotbot.com">Hotbot</option>
            <option value="www.msn.com">Msn</option>
            <option value="www.dogpile.com">Dogpile</option>
            <option value="www.lycos.com">Lycos</option>
            <option value="www.alltheweb.com/">All the Web</option>
            <option value="www.infospace.com">Info Space</option>
            <option value="www.espotting.com">Espotting</option>
            <option value="www.askjeeves.com">Ask Jeeves</option>
            <option value="Other Search Engine">Other Search Engine</option>
            <option></option>
            <option>======================================================</option>
            <option>MISCELLANEOUS</option>
            <option>======================================================</option>
            <option value="Massage Parlour Link">Massage Parlour Link</option>
            <option value="Escort Link">Escort Link</option>
            <option value="Lapdancing Link">Lapdancing Link</option>
            <option value="Advert">Advert</option>
            <option value="Just Surfed By">Just Surfed By</option>
            <option value="Swingers Link">Swingers Link</option>
            <option value="Word Of Mouth">Word Of Mouth</option>
            <option value="Free Adult Website Design">Free Adult Website Design</option>
            <option value="Sponsored Banner Advertising Information">Sponsored Banner Advertising Information</option>
            <option value="Other Miscellaneous">Other Miscellaneous</option>
          </select>
          <div class="clearfix"></div>
          <label>Keyword<span class="small">What keyword(s) did you use?</span></label>
          <input type="text" name="Keyword" id="Keyword" value="<?php echo $_POST["Keyword"]; ?>">
          <div class="clearfix"></div>
          <label>Message<span class="small">Please enter your message</span></label>
          <textarea name="Message" id="Message" rows="10"><?php echo $_POST["Message"]; ?></textarea>
          <div class="clearfix"></div>
          <div class="captcha"><?php require_once('scripts/functions/recaptcha/recaptchalib.php'); $publickey = ""; echo recaptcha_get_html($publickey); ?></div>
          <br class="clearfix">
          <button type="submit" onClick="return validatecontactform();">SEND</button> or <button type="button" onClick="self.location='/index.php'">CANCEL</button>
        </form>
      </div>
      <!-- InstanceEndEditable -->
      </div>
    </div>
    <nav id="sitenav" class="column"><?php require("scripts/design/nav.php"); ?></nav>
    <section id="rhs" class="column"><?php require("scripts/design/ads.php"); ?></section>
    <br class="clearfix">
  </section>
  <footer id="footer"><?php require("scripts/design/footer.php"); ?></footer>
</body>
<!-- InstanceEnd --></html>