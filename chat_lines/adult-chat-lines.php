<?php require("../scripts/db/connection.php"); ?>
<?php require("../scripts/functions/chatlines/chatlinefunctions.php"); ?>
<?php require("../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSComp = "SELECT * FROM tbl_purebiz_comp_text WHERE tbl_id =1";
$RSComp = mysql_query($query_RSComp, $Wisdom_Mcr) or die(mysql_error());
$row_RSComp = mysql_fetch_assoc($RSComp);
$totalRows_RSComp = mysql_num_rows($RSComp);

mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSCountries = "SELECT * FROM tbl_purebiz_cl_countries";
$RSCountries = mysql_query($query_RSCountries, $Wisdom_Mcr) or die(mysql_error());
$row_RSCountries = mysql_fetch_assoc($RSCountries);
$totalRows_RSCountries = mysql_num_rows($RSCountries);
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/usersideGeneric.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<meta name="keywords" content="adult chat lines,Mature Sex lines,UK Chatline,live 1-2-1 phonesex,Gay telephone chat,Irish Phone Sex,Shemale chat lines,tranvestite chat,Milf's,Horny housewife's,straight,fetish,Mistress,Mistresses,Hot n Horny,stories,chatlines">
<meta name="description" content="Adult Chat Lines offer Mature Sex lines from UK Chatline operators for live 1-2-1 phonesex, Gay telephone chat, Irish Phone Sex">
<title>Adult Chat lines, Credit Card, Irish, Phone Sex, Phonesex</title>
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
        <h1>Adult Chat Lines</h1>
        <br>
        <marquee width="60%">Our Adult Chat Lines offer Mature Sex lines from UK Chatline operators for live 1-2-1 phonesex, Gay telephone chat, Irish Phone Sex, Shemale chat lines or tranvestite chat in the UK, Operators are Milf's and Horny housewife's, Gay or Straight, we even list a whole category for that Fetish user. Our Mistress or Mistresses provide Hot n Horny fetish stories why not call our numbers, we are popular with all callers just pick up the Telephone and call the Chatline or chatlines you desire for a Wank.</marquee>
        <br><br>
        <?php do { ?>
        <div class="chatlinessbox iBlock"><a href="<?php echo $row_RSCountries["country_url"]; ?>"><img src="/images/chatlines/countries/<?php echo $row_RSCountries["country_img"]; ?>"></a></div>
        <?php } while($row_RSCountries = mysql_fetch_assoc($RSCountries)); ?>
        <p>If you are not the person responsible for paying the phone bill then you should get their permission before calling any numbers from this website.</p>
        <br>
        <div class="chatvideo">
          <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="460" height="380">
            <param name="movie" value="http://api.firestormmedia.tv/aff_stream/flash/player.swf?affid=5000065&amp;type=1&amp;clickable=0" />
            <param name="quality" value="high" />
            <param name="wmode" value="opaque" />
            <param name="swfversion" value="6.0.65.0" />
            <param name="allowFullScreen" value="true">
            <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
            <param name="expressinstall" value="/scripts/livestream/expressInstall.swf" />
            <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
            <!--[if !IE]>-->
            <object type="application/x-shockwave-flash" data="http://api.firestormmedia.tv/aff_stream/flash/player.swf?affid=5000065&amp;type=1&amp;clickable=0" width="460" height="380">
              <!--<![endif]-->
              <param name="quality" value="high" />
              <param name="wmode" value="opaque" />
              <param name="swfversion" value="6.0.65.0" />
              <param name="allowFullScreen" value="true">
              <param name="expressinstall" value="/scripts/livestream/expressInstall.swf" />
              <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
              <div>
                <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
                <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
              </div>
              <!--[if !IE]>-->
            </object>
            <!--<![endif]-->
          </object>
        </div>
        <br><br>
        <p class="chatlinecomp"><?php echo $row_RSComp["comp_text"]; ?></p>
        <!-- <p align="center">(click one of the buttons below to view your desired chat line service)</p> -->
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
mysql_free_result($RSCountries);
mysql_free_result($RSComp);
?>