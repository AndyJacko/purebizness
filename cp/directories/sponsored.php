<?php require("../../scripts/db/connection.php"); ?>
<?php require("../../scripts/cp/authnlogout.php"); ?>
<?php require("../../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSListing = "SELECT * FROM tbl_purebiz_listings WHERE tbl_id=".$_GET["tbl_id"];
$RSListing = mysql_query($query_RSListing, $Wisdom_Mcr) or die(mysql_error());
$row_RSListing = mysql_fetch_assoc($RSListing);
$totalRows_RSListing = mysql_num_rows($RSListing);

if (isset($_POST["tbl_id"])) {
	if ($_POST["Sponsored"] == 1) {	$issponsored = 1;	} else { $issponsored = 0; }
  $updateSQL = "UPDATE tbl_purebiz_listings SET list_sponsored=$issponsored,list_expires='".$_POST["Expires"]."' WHERE tbl_id=".$_POST["tbl_id"];
  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  $Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());
	
	if ($_POST["listingtype"] != "") {
	  header("Location: directory.php?dir=".$_POST["dir"]."&listingtype=".$_POST["listingtype"]);
	} else {
	  header("Location: directory.php?dir=".$_POST["dir"]);
	}
}
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/controlpanel.dwt.php" codeOutsideHTMLIsLocked="false" --><head>
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
      <h1>Sponsored Listing Details For <?php echo ucwords($row_RSListing["list_name"]); ?></h1>
        <br>
        <p>Edit the details as required.</p>
        <br>
        <div id="sponsored" class="sponsoredform">
        <form action="" method="post">
          <label>Sponsored<span class="small">Is Listing Sponsored?</span></label>
          <input name="Sponsored" type="checkbox" value="1" <?php if($row_RSListing["list_sponsored"] == 1) { echo "checked"; } ?>>
          <div class="clearfix"></div>
          <label>Date Expires<span class="small">Date Sponsored Listing Expires</span></label>
          <input type="text" name="Expires" id="Expires" value="<?php echo $row_RSListing["list_expires"]; ?>">
          <div class="clearfix"></div>
          <input type="hidden" name="tbl_id" value="<?php echo $_GET["tbl_id"]; ?>">
          <input type="hidden" name="dir" value="<?php echo $_GET["dir"]; ?>">
          <input type="hidden" name="listingtype" value="<?php echo $_GET["listingtype"]; ?>">
          <button type="submit" >SUBMIT</button> or <button type="button" onClick="self.location='directory.php?dir=<?php echo $_GET["dir"]; if ($_GET["listingtype"] != "") { echo "&listingtype=".$_GET["listingtype"]; } ?>'">CANCEL</button>
        </form>
        </div>
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
mysql_free_result($RSListing);
?>