<?php require("../scripts/db/connection.php"); ?>
<?php require("../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSCat = "SELECT * FROM tbl_purebiz_dir_cats ORDER BY cat_name ASC";
$RSCat = mysql_query($query_RSCat, $Wisdom_Mcr) or die(mysql_error());
$row_RSCat = mysql_fetch_assoc($RSCat);
$totalRows_RSCat = mysql_num_rows($RSCat);

unset($_SESSION["emailaddprofile"]);
$cap = 1;

if (isset($_POST["Cat"])) {
	mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
	$query_RSSub = "SELECT * FROM tbl_purebiz_dir_scats WHERE sub_cat=".$_POST["Cat"]." ORDER BY sub_name ASC";
	$RSSub = mysql_query($query_RSSub, $Wisdom_Mcr) or die(mysql_error());
	$row_RSSub = mysql_fetch_assoc($RSSub);
	$totalRows_RSSub = mysql_num_rows($RSSub);
}

if (isset($_POST["Sub"])) {
  require_once('../scripts/functions/recaptcha/recaptchalib.php');
  $privatekey = "";
  $resp = recaptcha_check_answer ($privatekey,
		  $_SERVER["REMOTE_ADDR"],
		  $_POST["recaptcha_challenge_field"],
		  $_POST["recaptcha_response_field"]);
  if (!$resp->is_valid) {
	$cap = 0;
  } else {
    header("Location: getdetails.php?sub=".$_POST["Sub"]);
  }
}

if ($_POST["Message"] != ""){
}
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/usersideGeneric.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Add Your Listing</title>
<link href="/scripts/dialogbox/css/base/ui.core.css" rel="stylesheet" type="text/css">
<link href="/scripts/dialogbox/css/base/ui.dialog.css" rel="stylesheet" type="text/css">
<link href="/scripts/dialogbox/css/base/ui.theme.css" rel="stylesheet" type="text/css">
<link href="/scripts/dialogbox/css/base/ui.images.css" rel="stylesheet" type="text/css">
<!-- InstanceEndEditable -->
<link href="/scripts/css/purebizness.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/scripts/js/gallery/jquery-1.6.1.min.js"></script> 
<script type="text/javascript" src="/scripts/js/purebizness.js"></script> 
<script type="text/javascript" src="/scripts/js/nav/jquery.color.js"></script> 
<script type="text/javascript" src="/scripts/js/nav/jMenu.js"></script>
<!-- InstanceBeginEditable name="head" -->
<script src="/scripts/dialogbox/js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="/scripts/dialogbox/js/jquery-ui-1.7.2.min.js" type="text/javascript"></script>
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
      <div class="addlistingheader">Please Adhere To These Rules Before Submitting</div>
      <br>
      <div class="addlistinginfo">
      <ol>
        <li>We only accept links off other Website Owners/Webmasters, if you do-not have a Website then we will not list your details, alternatively if you require a Website please contact us for a quote.</li>
        <br>
        <li>We will only accept your Website within one directory "please make sure you select the correct one" If you submit your details to the incorrect directory please request changes by emailing us here.</li>
        <br>
        <li>You must add our text link (preffered option) or banner to your Website before you submit your details (if we check your website before you add our link then your listing may be removed).<br><br>To save a copy of a banner simply "hover" over the desired banner Click Your Right Mouse Button, Save Picture As, Point It To Your Website Folder and then link it to http://www.purebizness.net. We will list you quicker if you add our banner to your index page (front page).</li>
        <br>
        <li>Any Illegal Website's will be removed and we will contact the authorities.</li>
        <br>
        <li>If you wish to have a sponsored listing then please contact us HERE</li>
      </ol>
      </div>
      <br><h2>Remember If You Add Us To Your Front Page We Will Add You Within 24 - 48 hrs</h2><br><strong>If you are ready to add your listing please use the boxes below.</strong>
      <br><br>
      <div class="addlistingheader">Purebizness Adult Directories</div>
      <br>
      <?php if ($cap == 0) { echo("<p class='msg'>reCaptcha was wrong, please retry...</p><br>"); } ?>
      <div id="addlisting" class="addlistingform">
      <script type="text/javascript"> var RecaptchaOptions = { theme : 'clean' }; </script>
      <form method="post" name="Cats" id="Cats">
        <label>Category<span class="small">Top level category</span></label>
        <select id="Cat" name="Cat" onChange="checkcats();">
          <option>Select...</option>
          <option></option>
          <?php do { ?>
          <option value="<?php echo $row_RSCat["tbl_id"]; ?>" <?php if ($row_RSCat["tbl_id"] == $_POST["Cat"]) { echo "selected"; } ?>><?php echo $row_RSCat["cat_disp_name"]; ?></option>
          <?php } while ($row_RSCat = mysql_fetch_assoc($RSCat)); ?>
        </select>
        <div class="clearfix"></div>
      </form>
			<?php if (isset($_POST["Cat"])) { ?>
      <form method="post" name="Subs" id="Subs">
        <label>Sub Category<span class="small">Desired sub category</span></label>
        <select id="Sub" name="Sub">
          <option>Select...</option>
          <option></option>
          <?php do { ?>
          <option value="<?php echo $row_RSSub["tbl_id"]; ?>"><?php echo $row_RSSub["sub_disp_name"]; ?></option>
          <?php } while ($row_RSSub = mysql_fetch_assoc($RSSub)); ?>
        </select>
        <div class="clearfix"></div>
        <div class="captcha"><?php require_once('../scripts/functions/recaptcha/recaptchalib.php'); $publickey = ""; echo recaptcha_get_html($publickey); ?></div>
        <br class="clearfix">
        <button type="submit" onClick="return checksubs();">CONTINUE</button>
      </form>
      <?php } ?>
      </div>
      <br>
      <div class="addlistingheader">Purebizness Text Links (preferred) & Banners</div>
      <p><strong>Please add one of our reciprocal links exactly as follows to your page:</strong></p>
      <p>&lt;a href=&quot;http://www.purebizness.net&quot; title=&quot;Purebizness Adult Directory&quot;&gt;Purebizness Adult Directory&lt;/a&gt;</p>
      <p><strong>The link on your website will look like this:</strong><br /><a href="http://www.purebizness.net" title="Purebizness Adult Directory">Purebizness Adult Directory</a></p>
      <div class="topline"></div>
      <p>&lt;a href=&quot;http://www.purebizness.net&quot; title=&quot;Purebizness Escort Directory&quot;&gt;Purebizness Escort Directory&lt;/a&gt;</p>
      <p><strong>The link on your website will look like this:</strong><br /><a href="http://www.purebizness.net" title="Purebizness Escort Directory">Purebizness Escort Directory</a></p>
      <div class="topline"></div>
      <p>&lt;a href=&quot;http://www.purebizness.net&quot; title=&quot;Massage Parlour Directory&quot;&gt;Massage Parlour Directory&lt;/a&gt;</p>
      <p><strong>The link on your website will look like this:</strong><br /><a href="http://www.purebizness.net" title="Massage Parlour Directory">Massage Parlour Directory</a></p>
      <div class="topline"></div>
      <p>&lt;a href=&quot;http://www.purebizness.net&quot; title=&quot;Independant Escort Directory&quot;&gt;Independant Escort Directory&lt;/a&gt;</p>
      <p><strong>The link on your website will look like this:</strong><br /><a href="http://www.purebizness.net" title="Independant Escort Directory">Independant Escort Directory</a></p>
      <div class="topline"></div>
      <p>&lt;a href=&quot;http://www.purebizness.net&quot; title=&quot;Webcam Directory&quot;&gt;Webcam Directory&lt;/a&gt;</p>
      <p><strong>The link on your website will look like this:</strong><br /><a href="http://www.purebizness.net" title="Webcam Directory">Webcam Directory</a></p>
      <div class="topline"></div>
      <p>&lt;a href=&quot;http://www.purebizness.net&quot; title=&quot;Adult Sex Toys Directory&quot;&gt;Adult Sex Toys Directory&lt;/a&gt;</p>
      <p><strong>The link on your website will look like this:</strong><br /><a href="http://www.purebizness.net" title="Adult Sex Toys Directory">Adult Sex Toys Directory</a></p>
      <div class="topline"></div>
      <p>&lt;a href=&quot;http://www.purebizness.net&quot; title=&quot;Phone Sex Directory&quot;&gt;Phone Sex Directory&lt;/a&gt;</p>
      <p><strong>The link on your website will look like this:</strong><br /><a href="http://www.purebizness.net" title="Phone Sex Directory">Phone Sex Directory</a></p>
      <div class="topline"></div>
      <p>&lt;a href=&quot;http://www.purebizness.net&quot; title=&quot;Transvestite Directory&quot;&gt;Transvestite Directory&lt;/a&gt;</p>
      <p><strong>The link on your website will look like this:</strong><br /><a href="http://www.purebizness.net" title="Transvestite Directory">Transvestite Directory</a></p>
      <div class="topline"></div>
      <p>&lt;a href=&quot;http://www.purebizness.net&quot; title=&quot;Adult Website Directory&quot;&gt;Adult Website Directory&lt;/a&gt;</p>
      <p><strong>The link on your website will look like this:</strong><br /><a href="http://www.purebizness.net" title="Adult Website Directory">Adult Website Directory</a></p>
      <div class="topline"></div>
      <p>&lt;a href=&quot;http://www.purebizness.net&quot; title=&quot;Domination And Fetish Directory&quot;&gt;Domination And Fetish Directory&lt;/a&gt;</p>
      <p><strong>The link on your website will look like this:</strong><br /><a href="http://www.purebizness.net" title="Domination And Fetish Directory">Domination And Fetish Directory</a></p>
      <div class="topline"></div>
      <div class="iBlock tengap"><img src="/images/dirbanners/purebizness_small2.gif"></div>
      <div class="iBlock tengap"><img src="/images/dirbanners/purebizness.net.jpg"></div>
      <div class="iBlock tengap"><img src="/images/dirbanners/purebizness.net02.jpg"></div>
      <div class="iBlock tengap"><img src="/images/dirbanners/purebizness7.jpg"></div>
      <br>
      <div class="iBlock tengap"><img src="/images/dirbanners/adultDirectory.jpg"></div>
      <br>
      <div class="iBlock tengap"><img src="/images/dirbanners/purebizness_large1.gif"></div>
      <br>
      <div class="iBlock tengap"><img src="/images/dirbanners/purebizness5.jpg"></div>
      <br>
      <div class="iBlock tengap"><img src="/images/dirbanners/purebizness6.jpg"></div>
      <div class="iBlock tengap"><img src="/images/dirbanners/adultDirectoryBanner.jpg"></div>
      <div class="iBlock tengap"><img src="/images/dirbanners/xxxDirectory.jpg"></div>
      <div class="iBlock tengap"><img src="/images/dirbanners/purebizness_small1.gif"></div>
      <?php if (!isset($_POST["Cat"])) { ?>
			<script type="text/javascript">
				$(document).ready(function() {
					$("#dialog").dialog({ 	
					  width: '668px',
						modal: 'true',
						draggable: 'false',
						resizable: 'false',
						title: 'Before You Begin',
						buttons: { "OK!": function() { $(this).dialog("close"); }} } );
				});
      </script>
      <div id="dialog" title="Before You Begin">
        <br>
        <p>Please make sure you have all your information at hand, and at least 1 picture ready to upload for your main listing picture (Escorts/Personals can add upto 8 gallery pictures).</p>
        <br>
        <p><em>Note: <span class="jpgonly">JPG images ONLY!</span> Max image size is 1000px width and will be resized automatically to 200px width - Max image filesize is 1mb</em>. To get help creating the correct image size, go <a href="http://www.picresize.com/" target="_blank">here</a>.</p>
        <br>
        <p>Check out our step-by-step example video below (will vary depending on the type of listing you require):</p>
        <br>
        <iframe src="https://www.youtube.com/embed/4eYFU4FmnfA?rel=0" width="640" height="360" frameborder="0" class="picborder" allowfullscreen></iframe>
      </div>
      <?php } ?>
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
if (isset($_POST["Cat"])) {
  mysql_free_result($RSSub);
}
mysql_free_result($RSCat);
?>