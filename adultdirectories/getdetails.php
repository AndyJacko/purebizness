<?php require("../scripts/db/connection.php"); ?>
<?php require("../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSSub = "SELECT * FROM tbl_purebiz_dir_scats WHERE tbl_id=".$_GET["sub"];
$RSSub = mysql_query($query_RSSub, $Wisdom_Mcr) or die(mysql_error());
$row_RSSub = mysql_fetch_assoc($RSSub);
$totalRows_RSSub = mysql_num_rows($RSSub);
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/usersideGeneric.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Enter Your Details</title>
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
      <h1>Enter Your Details</h1>
      <br><br>
      <p>Please complete the form below with as much information as possible.</p>
      <p><em>Note: The more information you enter, the more likely visitors will be to click on your profile.</em></p>
      <em><strong>All special characters/code WILL be removed, please don't use any.</strong></em>
      <?php 
			switch ($row_RSSub["sub_type"]) {
			case 1:
				include("../scripts/functions/addprofile/website.php");
				break;
			case 2:
				include("../scripts/functions/addprofile/business.php");
				break;
			case 3:
				include("../scripts/functions/addprofile/personal.php");
				break;
			case 4:
				include("../scripts/functions/addprofile/escort.php");
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
mysql_free_result($RSSub);
?>