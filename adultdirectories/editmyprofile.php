<?php require("../scripts/db/connection.php"); ?>
<?php require("../scripts/functions/nav/navfunctions.php"); ?>
<?php require("../scripts/functions/editprofile/profilefunctions.php"); ?>
<?php session_start(); ?>
<?php
if (!isset($_SESSION['MM_Username'])) { header("Location: /adultdirectories/login.php?s=2"); }
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSUser = "SELECT * FROM tbl_purebiz_listings WHERE list_name='".$_SESSION['MM_Username']."' AND list_pass='".$_SESSION['MM_Password']."'";
$RSUser = mysql_query($query_RSUser, $Wisdom_Mcr) or die(mysql_error());
$row_RSUser = mysql_fetch_assoc($RSUser);
$totalRows_RSUser = mysql_num_rows($RSUser);

mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSSub = "SELECT * FROM tbl_purebiz_dir_scats WHERE tbl_id=".$row_RSUser["list_sub"];
$RSSub = mysql_query($query_RSSub, $Wisdom_Mcr) or die(mysql_error());
$row_RSSub = mysql_fetch_assoc($RSSub);
$totalRows_RSSub = mysql_num_rows($RSSub);

mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSCat = "SELECT * FROM tbl_purebiz_dir_cats WHERE tbl_id=".$row_RSSub["sub_cat"];
$RSCat = mysql_query($query_RSCat, $Wisdom_Mcr) or die(mysql_error());
$row_RSCat = mysql_fetch_assoc($RSCat);
$totalRows_RSCat = mysql_num_rows($RSCat);

$_SESSION["id"] = $row_RSUser["tbl_id"];
$_SESSION["dir"] = $row_RSCat["cat_name"];
$_SESSION["sub"] = $row_RSSub["sub_name"];
$_SESSION["pname"] = $row_RSUser["list_title"];

mysql_free_result($RSCat);
mysql_free_result($RSSub);
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/usersideGeneric.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Edit Listing</title>
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
      <h1>Edit Listing</h1>
      <br>
      <?php if ($_GET["s"] == 1) { echo "<p class='msg'>Your listing has been updated.</p><br><br>"; } ?>
      <?php 
			switch ($row_RSUser["list_type"]) {
			case 1:
				include("../scripts/functions/editprofile/website.php");
				break;
			case 2:
				include("../scripts/functions/editprofile/business.php");
				break;
			case 3:
				include("../scripts/functions/editprofile/personal.php");
				break;
			case 4:
				include("../scripts/functions/editprofile/escort.php");
				break;
			}
			?>
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
mysql_free_result($RSUser);
?>