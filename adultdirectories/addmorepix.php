<?php require("../scripts/db/connection.php"); ?>
<?php require("../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSProfile = "SELECT * FROM tbl_purebiz_listings WHERE tbl_id=".$_SESSION['id'];
$RSProfile = mysql_query($query_RSProfile, $Wisdom_Mcr) or die(mysql_error());
$row_RSProfile = mysql_fetch_assoc($RSProfile);
$totalRows_RSProfile = mysql_num_rows($RSProfile);
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/usersideGeneric.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Add More Photos</title>
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
      <h1>Add More Photos</h1>
      <br><br>
      <p>You can add upto 8 photos in your gallery. To add more photos click the photo you wish to add,<br>to delete a photo click "<strong>DELETE</strong>" under the photo you want to remove.<br><br>
      Or click "<strong>FINISH</strong>" to return to the main menu.<br><br>
      <em>Note: Max image size is 500px x 800px - Max image filesize is 1mb</em>.</p>
      <br><br>
      <div id="addpic" class="addpicform">
      <?php
        for ($i=1;$i<9;$i++) {
          if ($row_RSProfile["list_pic".$i] != "") {
            echo "<div class='addmorepic'>Photo $i<br><a href='picadd.php?tbl_id=".$row_RSProfile["tbl_id"]."&pic=list_pic$i'><img src='/adultdirectories/".$_SESSION["dir"]."/".$_SESSION["sub"]."/".$_SESSION["pname"]."/t/".$row_RSProfile["list_pic".$i]."' width='100' class='picborder corners'></a><br><a href='deletepicadd.php?pic=list_pic$i' onClick='return delAddPic();'>DELETE</a></div>";
          } else {
            echo "<div class='addmorepic'>Photo $i<br><a href='picadd.php?tbl_id=".$row_RSProfile["tbl_id"]."&pic=list_pic$i'><img src='/images/nopic.jpg' width='100' class='picborder corners'></a><br><br></div>";
          }
        }
        ?>
        <div class="clearfix"></div><br>
        <button type="button" onClick="location.href='profileadded.php'">FINISH</button>
        </div>
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