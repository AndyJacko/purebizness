<?php require("../../scripts/db/connection.php"); ?>
<?php require("../../scripts/cp/authnlogout.php"); ?>
<?php require("../../scripts/functions/nav/navfunctions.php"); ?>
<?php require("../../scripts/cp/editprofile/profilefunctions.php"); ?>
<?php require("../../scripts/cp/functions/directoryfunctions.php"); ?>
<?php session_start(); ?>
<?php
switch (true) {
	case ($_SERVER['HTTP_REFERER'] == "http://purebizness.net/cp/cpmain.php"):
	case ($_SERVER['HTTP_REFERER'] == "http://www.purebizness.net/cp/cpmain.php"):
	case (substr($_SERVER['HTTP_REFERER'],0,50) == "http://purebizness.net/cp/directories/recipall.php"):
	case (substr($_SERVER['HTTP_REFERER'],0,51) == "http://purebizness.net/cp/directories/directory.php"):
	case (substr($_SERVER['HTTP_REFERER'],0,54) == "http://purebizness.net/cp/directories/directoryall.php"):
	case (substr($_SERVER['HTTP_REFERER'],0,54) == "http://www.purebizness.net/cp/directories/recipall.php"):
	case (substr($_SERVER['HTTP_REFERER'],0,55) == "http://www.purebizness.net/cp/directories/directory.php"):
	case (substr($_SERVER['HTTP_REFERER'],0,58) == "http://www.purebizness.net/cp/directories/directoryall.php"):
		$_SESSION["goback"] = $_SERVER['HTTP_REFERER'];
		break;
} 

mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSListing = "SELECT * FROM tbl_purebiz_listings WHERE tbl_id=".$_GET["tbl_id"];
$RSListing = mysql_query($query_RSListing, $Wisdom_Mcr) or die(mysql_error());
$row_RSListing = mysql_fetch_assoc($RSListing);
$totalRows_RSListing = mysql_num_rows($RSListing);
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
      <h1>Edit Listing For <?php echo ucwords($row_RSListing["list_name"]); ?></h1>
      <?php if ($_GET["s"] == 1) { echo "<br><br><p class='msg'>Listing has been updated.</p><br>"; } ?>
      <?php 
			switch ($row_RSListing["list_type"]) {
			case 1:
				include("../../scripts/cp/editprofile/website.php");
				break;
			case 2:
				include("../../scripts/cp/editprofile/business.php");
				break;
			case 3:
				include("../../scripts/cp/editprofile/personal.php");
				break;
			case 4:
				include("../../scripts/cp/editprofile/escort.php");
				break;
			}
			?>
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