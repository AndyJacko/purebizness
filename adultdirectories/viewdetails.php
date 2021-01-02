<?php require("../scripts/db/connection.php"); ?>
<?php require("../scripts/functions/nav/navfunctions.php"); ?>
<?php require("../scripts/functions/profile/profilefunctions.php"); ?>
<?php //session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSProfile = "SELECT * FROM tbl_purebiz_listings WHERE tbl_id=".$_GET["p"];
$RSProfile = mysql_query($query_RSProfile, $Wisdom_Mcr) or die(mysql_error());
$row_RSProfile = mysql_fetch_assoc($RSProfile);
$totalRows_RSProfile = mysql_num_rows($RSProfile);
$dirURL = getpath($row_RSProfile["list_sub"]);
$dir = substr($dirURL,0,strpos($dirURL,"/",0));
$sub = substr($dirURL,(strpos($dirURL,"/",0)+1),(strlen($dirURL)-strpos($dirURL,"/",0)));
$viewed = $row_RSProfile["list_viewed"] + 1;
$_SESSION["dirlink"] = "/adultdirectories/".$dirURL;
$_SESSION["prolink"] = "/adultdirectories/viewdetails.php?p=".$_GET["p"];

//unset($_SESSION["imavisitor"]);

//if (is_array($_SESSION["imavisitor"])) {
	//$beenhere = 0;
	//$pages = count($_SESSION["imavisitor"]);
	//for ($i=0;$i <= $pages; $i++) {
		//if ($_SESSION["imavisitor"][$i][0] == $dir.$sub.$row_RSProfile["list_title"]) {
	    //$beenhere = 1;
			//$_SESSION["imavisitor"][$i][1] = $_SESSION["imavisitor"][$i][1] + 1;
			//if ($_SESSION["imavisitor"][$i][1] > 10) {
				//$alertthecunt = 1;
			//}
			//if ($_SESSION["imavisitor"][$i][1] > 20) {
				//$alertthecunt = 2;
			//}
			//if ($_SESSION["imavisitor"][$i][1] > 25) {
				//$alertthecunt = 3;
			//}
			//if ($_SESSION["imavisitor"][$i][1] > 26) {
				//header("Location: /index.php");
			//}
		//}
	//}
	//if ($beenhere == 0) {
		//$_SESSION["imavisitor"][$pages+1][0] = $dir.$sub.$row_RSProfile["list_title"];
		//$_SESSION["imavisitor"][$pages+1][1] = 1;
		$updateSQL = "UPDATE tbl_purebiz_listings SET list_viewed=$viewed WHERE tbl_id=".$row_RSProfile["tbl_id"];
		mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
		$Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());
	//}
//} else {
	//$_SESSION["imavisitor"][0][0] = $dir.$sub.$row_RSProfile["list_title"];
	//$_SESSION["imavisitor"][0][1] = 1;
//}
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/usersideGeneric.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<meta name="description" content="<?php echo $row_RSProfile["list_desc"]; ?>">
<meta name="keywords" content="<?php echo $row_RSProfile["list_keys"]; ?>">
<title><?php echo $row_RSProfile["list_name"]; ?></title>
<!-- InstanceEndEditable -->
<link href="/scripts/css/purebizness.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/scripts/js/gallery/jquery-1.6.1.min.js"></script> 
<script type="text/javascript" src="/scripts/js/purebizness.js"></script> 
<script type="text/javascript" src="/scripts/js/nav/jquery.color.js"></script> 
<script type="text/javascript" src="/scripts/js/nav/jMenu.js"></script>
<!-- InstanceBeginEditable name="head" -->
<link href="/scripts/prettyphoto/css/prettyPhoto.css" rel="stylesheet" type="text/css">
<script src="/scripts/prettyphoto/js/jquery.prettyPhoto.js" type="text/javascript"></script>
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
			<script type="text/javascript">
        $(document).ready(function(){
          $("a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: ', animation_speed', /* fast/slow/normal */
            slideshow: 5000, /* false OR interval time in ms */
            autoplay_slideshow: true, /* true/false */
            opacity: 0.6, /* Value between 0 and 1 */
            show_title: true, /* true/false */
            allow_resize: true, /* Resize the photos bigger than viewport. true/false */
            default_width: 500,
            default_height: 344,
            counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
            theme: 'light_rounded', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
            horizontal_padding: 20, /* The padding on each side of the picture */
            hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
            wmode: 'opaque', /* Set the flash wmode attribute */
            autoplay: true, /* Automatically start videos: True/False */
            modal: false, /* If set to true, only the close button will close the window */
            deeplinking: false, /* Allow prettyPhoto to update the url to enable deeplinking. */
            overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
            keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
            changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
            callback: function(){}, /* Called when prettyPhoto is closed */
            ie6_fallback: true
            }
          );
        });
      </script>
      <h1>Directory Listing Details For: <?php echo $row_RSProfile["list_name"]; ?></h1>
      <br>
      <div class="dirmenu">
        <a href="http://www.purebizness.net">HOMEPAGE</a>
        <a href="/adultdirectories/addyourlisting.php">ADD YOUR LISTING</a>
        <a href="/adultdirectories/login.php">LOGIN</a>
      </div>
      <br>
      <strong>Listing Added:</strong>&nbsp;<?php echo $row_RSProfile["list_date"]; ?>&nbsp;&nbsp;&nbsp;<strong>Times Viewed:</strong>&nbsp;<?php echo $row_RSProfile["list_viewed"]; ?>
      <br><br>
      <button onClick="self.location='<?php echo $_SESSION["dirlink"]; ?>'" class="backbutton">Back To Directory</button>
      <br><br>
      <?php
	  switch ($row_RSProfile["list_type"]) {
		case 1:
		  include("../scripts/functions/profile/website.php");
		  break;
		case 2:
		  include("../scripts/functions/profile/business.php");
		  break;
		case 3:
		  include("../scripts/functions/profile/personal.php");
		  break;
		case 4:
		  include("../scripts/functions/profile/escort.php");
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
	if ($alertthecunt == 1) {
		echo("<script language='javascript'>alert('You can refresh the page all day, but the hits will stay the same!!!\\n\\nIf you have nothing else better to do, call one of our chatlines!!!');</script>");
	}
	if ($alertthecunt == 2) {
		echo("<script language='javascript'>alert('Please stop now!!!\\n\\nYou are acheiving nothing and wasting your time.');</script>");
	}
	if ($alertthecunt == 3) {
		echo("<script language='javascript'>alert('Final Warning!!! Stop refreshing the page,\\n\\nif you continue you will be removed from viewing this profile and this profile could be blacklisted.');</script>");
	}
?>
<?php 
mysql_free_result($RSProfile);
?>