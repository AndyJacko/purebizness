<?php require("../../scripts/db/connection.php"); ?>
<?php require("../../scripts/cp/authnlogout.php"); ?>
<?php require_once("../../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSCompliance = "SELECT * FROM tbl_purebiz_comp_text WHERE tbl_id=1";
$RSCompliance = mysql_query($query_RSCompliance, $Wisdom_Mcr) or die(mysql_error());
$row_RSCompliance = mysql_fetch_assoc($RSCompliance);
$totalRows_RSCompliance = mysql_num_rows($RSCompliance);

if (isset($_POST["Compliance"])) {
	$updateSQL .= "UPDATE tbl_purebiz_comp_text SET comp_text='".$_POST["Compliance"]."' WHERE tbl_id=1";
	mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
	$Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());
	
	header("Location: compliancetext.php?s=1");
}
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/controlpanel.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<meta name="robots" content="noindex,nofollow">
<!-- InstanceBeginEditable name="doctitle" -->
<title></title>
<!-- InstanceEndEditable -->
<link href="/scripts/css/purebizness.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/scripts/js/gallery/jquery-1.6.1.min.js"></script> 
<script type="text/javascript" src="/scripts/js/purebizness.js"></script> 
<script type="text/javascript" src="/scripts/js/nav/jquery.color.js"></script> 
<script type="text/javascript" src="/scripts/js/nav/jMenu.js"></script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
  <header id="header"><?php include('../../scripts/design/cpheader.php'); ?></header>
  <section id="pagebody">
    <div id="content" class="column">
      <div id="actualcontent">
      <!-- InstanceBeginEditable name="content" -->
      <div id="content">
        <h1>Edit Compliance Text</h1>
        <br><br>
        <?php if ($_GET["s"] == 1) { echo "<p class='msg'>Compliance text has been updated.</p><br><br>"; } ?>
        <div id="emails" class="emailsform">
        <form action="" method="post">
          <label>Compliance Text<span class="small">Text at bottom of page.</span></label>
          <textarea name="Compliance" id="Compliance" rows="10"><?php echo $row_RSCompliance["comp_text"]; ?></textarea>
          <div class="clearfix"></div>
          <button type="submit" onClick="return">UPDATE</button>
        </form>
        </div>
      </div>
      <br><br>
      <!-- InstanceEndEditable -->
      </div>
    </div>
    <nav id="sitenav" class="column"><?php require("../../scripts/design/cpnav.php"); ?></nav>
    <section id="rhs" class="column">&nbsp;</section>
    <br class="clearfix">
  </section>
  <footer id="footer"><?php require("../../scripts/design/footer.php"); ?></footer>
</body>
<!-- InstanceEnd --></html>
<?php 
mysql_free_result($RSCompliance);
?>