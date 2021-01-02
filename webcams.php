<?php require("scripts/db/connection.php"); ?>
<?php require("scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/usersideGeneric.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Live Adult Webcams</title>
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
      <iframe src="http://purebiznesscams.streamray.com" width="100%" height="1000" allowtransparency="" scrolling="auto" align="middle" frameborder="no"></iframe>
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