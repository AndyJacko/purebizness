<?php require("scripts/db/connection.php"); ?>
<?php require("scripts/functions/nav/navfunctions.php"); ?>
<?php require("scripts/functions/search/searchfunctions.php"); ?>
<?php require("scripts/functions/directory/getflag.php"); ?>
<?php session_start(); ?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/usersideGeneric.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Search Results</title>
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
  <header id="header"><?php include('scripts/design/header.php'); ?></header>
  <section id="pagebody">
    <div id="content" class="column">
      <div id="actualcontent">
      <!-- InstanceBeginEditable name="content" -->
			<h1>Search Results</h1>
			<h1>This Feature Is Currently Under Development</h1>
      <br><br>
			<?php
      if ($_GET["search"] != "") {
				mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
				$query_RSListings = "SELECT * FROM tbl_purebiz_listings WHERE list_active=1 ";
				
				if ($_GET["d"] == 1) {
					echo "Searching <strong class='pinkTxt'>".getdirname($_GET["thesub"])."</strong> Directory<br><br>";
				  $query_RSListings .= "AND list_sub=".$_GET["thesub"]." ";
        } else {
					echo "Searching <strong class='pinkTxt'>All</strong> Directories<br><br>";
        }
				
				$RSListings = mysql_query($query_RSListings, $Wisdom_Mcr) or die(mysql_error());
				$totalRows_RSListings = mysql_num_rows($RSListings);
				
				$srch = $_GET["search"];
				
				if ($totalRows_RSListings > 0) {
					
					if ($_GET["s"] == 1) {
						searchphrase($srch,$RSListings);
					} else {
						searchwords($srch,$RSListings);
					}
				} else {
					echo "<br><br>Sorry, your search for <strong class='pinkTxt'>&quot;".$srch."&quot;</strong> returned no results<br><br><br><br><strong>Please check your query is spelled correctly, or try other keywords.</strong><br><br><br><br>";
				  if (isset($_GET["thesub"])) {
					  echo "<button onClick='self.location=\"".getdirlink($_GET["thesub"])."\"' class='backbutton'>Back To Directory</button>";
				  }
				}
        mysql_free_result($RSListings);
      }
      ?>
      <!-- InstanceEndEditable -->
      </div>
    </div>
    <nav id="sitenav" class="column"><?php require("scripts/design/nav.php"); ?></nav>
    <section id="rhs" class="column"><?php require("scripts/design/ads.php"); ?></section>
    <br class="clearfix">
  </section>
  <footer id="footer"><?php require("scripts/design/footer.php"); ?></footer>
</body>
<!-- InstanceEnd --></html>