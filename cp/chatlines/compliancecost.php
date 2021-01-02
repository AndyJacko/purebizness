<?php require("../../scripts/db/connection.php"); ?>
<?php require("../../scripts/cp/authnlogout.php"); ?>
<?php require_once("../../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSCompliance = "SELECT * FROM tbl_purebiz_compliance";
$RSCompliance = mysql_query($query_RSCompliance, $Wisdom_Mcr) or die(mysql_error());
$row_RSCompliance = mysql_fetch_assoc($RSCompliance);
$totalRows_RSCompliance = mysql_num_rows($RSCompliance);

if (isset($_POST["Compliance1"])) {
	$updateSQL = "UPDATE tbl_purebiz_compliance SET comp_cost=".$_POST["Compliance1"]." WHERE tbl_id=1";
	mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
	$Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());
	
	$updateSQL = "UPDATE tbl_purebiz_compliance SET comp_cost=".$_POST["Compliance2"]." WHERE tbl_id=2";
	mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
	$Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());
	
	$updateSQL = "UPDATE tbl_purebiz_compliance SET comp_cost=".$_POST["Compliance3"]." WHERE tbl_id=3";
	mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
	$Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());
	
	$updateSQL = "UPDATE tbl_purebiz_compliance SET comp_cost=".$_POST["Compliance4"]." WHERE tbl_id=4";
	mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
	$Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());
	
	header("Location: compliancecost.php?s=1");
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
        <h1>Edit Compliance Costs</h1>
        <br><br>
        <?php if ($_GET["s"] == 1) { echo "<p class='msg'>Compliance costs have been updated.</p><br><br>"; } ?>
        <div id="emails" class="emailsform">
        <form action="" method="post">
          <label><?php echo $row_RSCompliance["comp_name"]; ?> <?php echo $row_RSCompliance["comp_currency"]; ?><span class="small">Cost of calls.</span></label>
          <input name="Compliance<?php echo $row_RSCompliance["tbl_id"]; ?>" type="text" id="Compliance<?php echo $row_RSCompliance["tbl_id"]; ?>" size="200" value="<?php echo $row_RSCompliance["comp_cost"]; ?>">
          <?php $row_RSCompliance = mysql_fetch_assoc($RSCompliance); ?>
          <div class="clearfix"></div>
          <label><?php echo $row_RSCompliance["comp_name"]; ?> <?php echo $row_RSCompliance["comp_currency"]; ?><span class="small">Cost of calls.</span></label>
          <input name="Compliance<?php echo $row_RSCompliance["tbl_id"]; ?>" type="text" id="Compliance<?php echo $row_RSCompliance["tbl_id"]; ?>" size="200" value="<?php echo $row_RSCompliance["comp_cost"]; ?>">
          <?php $row_RSCompliance = mysql_fetch_assoc($RSCompliance); ?>
          <div class="clearfix"></div>
          <label><?php echo $row_RSCompliance["comp_name"]; ?> <?php echo $row_RSCompliance["comp_currency"]; ?><span class="small">Cost of calls.</span></label>
          <input name="Compliance<?php echo $row_RSCompliance["tbl_id"]; ?>" type="text" id="Compliance<?php echo $row_RSCompliance["tbl_id"]; ?>" size="200" value="<?php echo $row_RSCompliance["comp_cost"]; ?>">
          <?php $row_RSCompliance = mysql_fetch_assoc($RSCompliance); ?>
          <div class="clearfix"></div>
          <label><?php echo $row_RSCompliance["comp_name"]; ?> <?php echo $row_RSCompliance["comp_currency"]; ?><span class="small">Cost of calls.</span></label>
          <input name="Compliance<?php echo $row_RSCompliance["tbl_id"]; ?>" type="text" id="Compliance<?php echo $row_RSCompliance["tbl_id"]; ?>" size="200" value="<?php echo $row_RSCompliance["comp_cost"]; ?>">
          <?php $row_RSCompliance = mysql_fetch_assoc($RSCompliance); ?>
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