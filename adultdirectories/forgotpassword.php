<?php require("../scripts/db/connection.php"); ?>
<?php require("../scripts/functions/nav/navfunctions.php"); ?>
<?php require("../scripts/emailer/customemailfunctions.php"); ?>
<?php session_start(); ?>
<?php
if (isset($_POST['Name'])) {
	mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
	$query_RSProfile = "SELECT list_name,list_email,list_pass FROM tbl_purebiz_listings WHERE list_name='".$_POST["Name"]."'";
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
	} else {
    $err = 2;
	}
mysql_free_result($RSProfile);
}
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/usersideGeneric.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Login To Your Listing</title>
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
      <h1>Forgot Your Password?</h1>
      <br><br>
      <p>If you have forgotten your password you can use the form below to retrieve it.</p>
      <p>&nbsp;</p>
      <p>Enter your profile listing name and your password will be sent to the email address you signed up with.</p>
      <br><br>
      <?php if ($err == 1) { echo "<p class='msg'>Your password has been emailed to the address you signed up with.</p><br><br>"; } ?>
      <?php if ($err == 2) { echo "<p class='msg'>There is NO listing with that name, please check and try again.</p><br><br>"; } ?>
      <?php if ($err != 1) { ?>
      <div id="login" class="loginform">
        <form action="" method="post">
          <label>Name<span class="small">Your listing name</span></label>
          <input name="Name" type="text" id="Name" value="<?php echo $_POST['Name']; ?>">
          <div class="clearfix"></div>
          <button type="submit" onClick="return validateforgotpassform();">SEND PASSWORD</button>
        </form>
      </div>
      <?php } ?>
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