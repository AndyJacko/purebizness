<?php require("../scripts/db/connection.php"); ?>
<?php require("../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
if (!isset($_SESSION['MM_Username'])) { header("Location: /adultdirectories/login.php?s=2"); }
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSProfile = "SELECT * FROM tbl_purebiz_listings WHERE list_name='".$_SESSION['MM_Username']."' AND list_pass='".$_SESSION['MM_Password']."'";
$RSProfile = mysql_query($query_RSProfile, $Wisdom_Mcr) or die(mysql_error());
$row_RSProfile = mysql_fetch_assoc($RSProfile);
$totalRows_RSProfile = mysql_num_rows($RSProfile);

if (isset($_POST["Current"])) {
	if ($_POST["Current"] == $_SESSION['MM_Password']) {
		$updateSQL = "UPDATE tbl_purebiz_listings SET list_pass='".$_POST["New"]."' WHERE tbl_id=".$row_RSProfile["tbl_id"];
		mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
		$Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());
		unset($_SESSION['MM_Username']);
		unset($_SESSION['MM_Password']);
		header("Location: /adultdirectories/login.php?s=4");
	} else {
		$passerror = "<p class='msg'>Your current password is incorrect, please retry.</p>";
	}
}
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/usersideGeneric.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Edit Password</title>
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
      <h1>Edit Password</h1>
      <br><br>
      <p>Please use the form below to edit your password. Click "UPDATE" to save the changes.</p>
      <p>Once your password has been changed you will need to log back in again.</p>
      <br>
      <?php echo $passerror; ?>
      <br>
      <div id="addwebsite" class="addwebsiteform">
        <form action="" method="post" name="password">
          <label>Current<span class="small">Your current password</span></label>
          <input type="password" name="Current" id="Current">
          <div class="clearfix"></div>
          <label>New<span class="small">Your new password</span></label>
          <input type="password" name="New" id="New">
          <div class="clearfix"></div>
          <input name="tbl_id" type="hidden" value="<?php echo $row_RSUser["tbl_id"]; ?>">
          <button type="submit" onClick="return valnewpass();">UPDATE</button> or <button type="button" onClick="self.location='/adultdirectories/editmyprofile.php'">CANCEL</button>
        </form>
      </div>
      <br><br>
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