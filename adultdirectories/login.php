<?php require("../scripts/db/connection.php"); ?>
<?php require("../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Name'])) {
  $loginUsername=$_POST['Name'];
  $password=$_POST['Password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "/adultdirectories/editmyprofile.php";
  $MM_redirectLoginFailed = "/adultdirectories/login.php?s=1";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  
  $LoginRS__query = "SELECT list_name, list_pass FROM tbl_purebiz_listings WHERE list_name='".$_POST["Name"]."' AND list_pass='".$_POST["Password"]."'"; 
   
  $LoginRS = mysql_query($LoginRS__query, $Wisdom_Mcr) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_Password'] = $password;	      
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
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
      <h1>Login To Your Listing</h1>
      <br><br>
      <p>Please use the form below to login to your listing.<br><br>Once you are logged in you will be able to edit your details and pictures.</p>
      <p><a href="forgotpassword.php">Forgot Password?</a></p>
      <br><br>
      <?php if ($_GET["s"] == 1) { echo "<p class='msg'>Your details are incorrect, please check and try again.</p><br><br>"; } ?>
      <?php if ($_GET["s"] == 2) { echo "<p class='msg'>You need to login to edit your profile.</p><br><br>"; } ?>
      <?php if ($_GET["s"] == 3) { echo "<p class='msg'>You have been logged out.</p><br><br>"; } ?>
      <?php if ($_GET["s"] == 4) { echo "<p class='msg'>Password changed. You need to login again to edit your profile.</p><br><br>"; } ?>
      <div id="login" class="loginform">
        <form action="" method="post">
          <label>Name<span class="small">Your listing name</span></label>
          <input type="text" name="Name" id="Name">
          <div class="clearfix"></div>
          <label>Password<span class="small">Your password</span></label>
          <input type="password" name="Password" id="Password">
          <div class="clearfix"></div>
          <button type="submit" onClick="return validateloginform();">LOGIN</button>
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