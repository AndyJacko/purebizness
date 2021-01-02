<?php require("../scripts/db/connection.php"); ?>
<?php require("../scripts/cp/authnlogout.php"); ?>
<?php require_once("../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="robots" content="noindex,nofollow">
<!-- TemplateBeginEditable name="doctitle" -->
<title></title>
<!-- TemplateEndEditable -->
<link href="/scripts/css/purebizness.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/scripts/js/gallery/jquery-1.6.1.min.js"></script> 
<script type="text/javascript" src="/scripts/js/purebizness.js"></script> 
<script type="text/javascript" src="/scripts/js/nav/jquery.color.js"></script> 
<script type="text/javascript" src="/scripts/js/nav/jMenu.js"></script>
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>
  <header id="header"><?php include('../scripts/design/cpheader.php'); ?></header>
  <section id="pagebody">
    <div id="content" class="column">
      <div id="actualcontent">
      <!-- TemplateBeginEditable name="content" -->
      &nbsp;
      <!-- TemplateEndEditable -->
      </div>
    </div>
    <nav id="sitenav" class="column"><?php require("../scripts/design/cpnav.php"); ?></nav>
    <section id="rhs" class="column">&nbsp;</section>
    <br class="clearfix">
  </section>
  <footer id="footer"><?php require("../scripts/design/footer.php"); ?></footer>
</body>
</html>