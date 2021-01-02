<?php require("../scripts/db/connection.php"); ?>
<?php session_start(); ?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Username'])) {
  $loginUsername=$_POST['Username'];
  $password=$_POST['Password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "cpmain.php";
  $MM_redirectLoginFailed = "index.php?s=1";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  
  $LoginRS__query=sprintf("SELECT admin_user, admin_pass FROM tbl_purebiz_admin WHERE admin_user='".$loginUsername."' AND admin_pass='".$password."'"); 
   
  $LoginRS = mysql_query($LoginRS__query, $Wisdom_Mcr) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
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
<html>
<head>
<meta charset="utf-8">
<title></title>
<link href="/scripts/css/purebizness.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/scripts/js/gallery/jquery-1.6.1.min.js"></script> 
<script type="text/javascript" src="/scripts/js/purebizness.js"></script> 
<script type="text/javascript" src="/scripts/js/nav/jquery.color.js"></script> 
<script type="text/javascript" src="/scripts/js/nav/jMenu.js"></script>
</head>

<body>
  <header id="header"><?php include('../scripts/design/cpheader.php'); ?></header>
  <section id="pagebody">
    <div id="content" class="column">
      <div id="actualcontent">
        <br><br>
        <h1>Login To Controlpanel</h1><br><br>
        <?php if ($_GET["s"] == 1) { ?>
          <p class="msg"><b>Error, Your details were incorrect. Please retry.</b></p>
        <?php } ?>
        <?php if ($_GET["s"] == 2) { ?>
          <p class="msg"><b>You have been logged out sucessfully.</b></p>
        <?php } ?>
        <?php if ($_GET["s"] == 3) { ?>
          <p class="msg"><b>Error. You must be logged in to view that page.</b></p>
        <?php } ?>
        <div id="emails" class="emailsform">
        <form id="form1" name="form1" method="post" action="">
          <label>Username<span class="small">Your admin username.</span></label>
          <input type="text" name="Username" id="Username">
          <div class="clearfix"></div>
          <label>Password<span class="small">Your admin password.</span></label>
          <input type="password" name="Password" id="Password">
          <div class="clearfix"></div>
          <button type="submit">LOGIN</button>
        </form>
        </div>
        <br><br>
        <br><br>
        <p class="msg">--- Unauthorised Access Is Not Permitted ---</p>
      </div>
    </div>
    <nav id="sitenav" class="column">&nbsp;</nav>
    <section id="rhs" class="column">&nbsp;</section>
    <br class="clearfix">
  </section>
  <footer id="footer"><?php require("../scripts/design/footer.php"); ?></footer>
</body>
</html>