<?php require("../../scripts/db/connection.php"); ?>
<?php require("../../scripts/cp/authnlogout.php"); ?>
<?php require("../../scripts/functions/nav/navfunctions.php"); ?>
<?php require("../../scripts/cp/functions/directoryfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
if ($_GET["dir"] != "") {
	if ($_GET["listingtype"] == "") {
	  $query_RSDirectory = "SELECT * FROM tbl_purebiz_listings WHERE list_sub=".$_GET["dir"]." ORDER BY list_active,list_name ASC";
	} else {
		switch ($_GET["listingtype"]) {
			case "All":
	      $query_RSDirectory = "SELECT * FROM tbl_purebiz_listings WHERE list_sub=".$_GET["dir"]." ORDER BY list_active,list_name ASC";
        break;
      case "Num":
	      $query_RSDirectory = "SELECT * FROM tbl_purebiz_listings WHERE list_sub=".$_GET["dir"]." AND (list_name LIKE '0%' OR list_name LIKE '1%' OR list_name LIKE '2%' OR list_name LIKE '3%' OR list_name LIKE '4%' OR list_name LIKE '5%' OR list_name LIKE '6%' OR list_name LIKE '7%' OR list_name LIKE '8%' OR list_name LIKE '9%') ORDER BY list_active,list_name ASC";
        break;
      case "Active":
	      $query_RSDirectory = "SELECT * FROM tbl_purebiz_listings WHERE list_sub=".$_GET["dir"]." AND list_active=1 ORDER BY list_active,list_name ASC";
        break;
      case "Inactive":
	      $query_RSDirectory = "SELECT * FROM tbl_purebiz_listings WHERE list_sub=".$_GET["dir"]." AND list_active=0 ORDER BY list_active,list_name ASC";
        break;
      case "Sponsored":
	      $query_RSDirectory = "SELECT * FROM tbl_purebiz_listings WHERE list_sub=".$_GET["dir"]." AND list_sponsored=1 ORDER BY list_active,list_name ASC";
        break;
      case "Flagged":
	      $query_RSDirectory = "SELECT * FROM tbl_purebiz_listings WHERE list_sub=".$_GET["dir"]." AND list_flagged=1 ORDER BY list_active,list_name ASC";
        break;
      default:
	      $query_RSDirectory = "SELECT * FROM tbl_purebiz_listings WHERE list_sub=".$_GET["dir"]." AND list_name LIKE '".$_GET["listingtype"]."%' ORDER BY list_active,list_name ASC";
		}
	}
	
	$RSDirectory = mysql_query($query_RSDirectory, $Wisdom_Mcr) or die(mysql_error());
	$row_RSDirectory = mysql_fetch_assoc($RSDirectory);
	$totalRows_RSDirectory = mysql_num_rows($RSDirectory);
} else {
  $query_RSDirectory = "SELECT * FROM tbl_purebiz_listings ORDER BY list_active,list_name ASC";
	$RSDirectory = mysql_query($query_RSDirectory, $Wisdom_Mcr) or die(mysql_error());
	$row_RSDirectory = mysql_fetch_assoc($RSDirectory);
	$totalRows_RSDirectory = mysql_num_rows($RSDirectory);
}
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/controlpanel.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
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
      <div id="content">
        <h1><?php echo getdirectoryname($_GET["dir"]); ?> Directory</h1>
        <br><br>
        <p>Select from the options below to view the listings in this directory.</p>
        <br><br>
        <?php if (isset($error)) { echo "<span class='msg'>".$error."</span>"; } else { ?>
        <?php if ($_GET["s"] == 1) { echo "<p class='msg'>The listing has been updated.</p><br><br>"; } ?>
          <div id="diroptions" class="diroptionsform">
            <form method="get">
              <input type="hidden" name="dir" value="<?php echo $_GET["dir"]; ?>">
              Show:&nbsp;&nbsp;
              <select name="listingtype" onChange="submit();">
                <option value="">Select...</option><option value="A">A</option><option value="B">B</option>
                <option value="C">C</option><option value="D">D</option><option value="E">E</option><option value="F">F</option><option value="G">G</option><option value="H">H</option>
                <option value="I">I</option><option value="J">J</option><option value="K">K</option><option value="L">L</option><option value="M">M</option><option value="N">N</option>
                <option value="O">O</option><option value="P">P</option><option value="Q">Q</option><option value="R">R</option><option value="S">S</option><option value="T">T</option>
                <option value="U">U</option><option value="V">V</option><option value="W">W</option><option value="X">X</option><option value="Y">Y</option><option value="Z">Z</option>
              </select>
              <a href="?dir=<?php echo $_GET["dir"]; ?>&listingtype=All"><span class="allicon"></span>All</a>
              <a href="?dir=<?php echo $_GET["dir"]; ?>&listingtype=Num"><span class="numicon"></span>Numbers</a>
              <a href="?dir=<?php echo $_GET["dir"]; ?>&listingtype=Active"><span class="activeyicon"></span>Active</a>
              <a href="?dir=<?php echo $_GET["dir"]; ?>&listingtype=Inactive"><span class="activenicon"></span>Inactive</a>
              <a href="?dir=<?php echo $_GET["dir"]; ?>&listingtype=Sponsored"><span class="sponyicon"></span>Sponsored</a>
              <a href="?dir=<?php echo $_GET["dir"]; ?>&listingtype=Flagged"><span class="flagyicon"></span>Flagged</a>
              <a href="recip.php?dir=<?php echo $_GET["dir"]; ?>"><span class="recipicon"></span>Recip</a>
            </form>
            <br>
            <span class="clkforleg" onClick="showLegend();">Icon Legend</span>
            <div id="iconlegend" class="hide">              
              <br>
              <span class="activicon"></span>&nbsp;&nbsp;Indicates Active listing.
              <br>
              <span class="deactivicon"></span>&nbsp;&nbsp;Indicates Deactivated/New listing.
              <br>
              <span class="editicon"></span>&nbsp;&nbsp;Click to edit the listing details.
              <br>
              <span class="deleteicon"></span>&nbsp;&nbsp;Click to delete the listing &amp; send email to notify listing owner.
              <br>
              <span class="activenicon"></span>&nbsp;&nbsp;Indicates inactive listing, click to activate listing &amp; send email to notify listing owner.
              <br>
              <span class="activeyicon"></span>&nbsp;&nbsp;Indicates active listing, click to deactivate listing &amp; send email to notify listing owner.
              <br>
              <span class="sponnicon"></span>&nbsp;&nbsp;Indicates normal listing, click to edit the sponsored listing options.
              <br>
              <span class="sponyicon"></span>&nbsp;&nbsp;Indicates sponsored listing, click to edit the sponsored listing options.
              <br>
              <span class="flagnicon"></span>&nbsp;&nbsp;Indicates unflagged listing, click to flag, deactivate listing &amp; send email to notify listing owner.
              <br>
              <span class="flagyicon"></span>&nbsp;&nbsp;Indicates flagged listing, click to unflag, reactivate listing &amp; send email to notify listing owner.
              <br>
              <span class="emailnicon"></span>&nbsp;&nbsp;Click to email <strong>NEW LISTING</strong> owner &amp; notify that there is no recip. Otherwise use flag for existing listings.
              <br>
              <span class="emailyicon"></span>&nbsp;&nbsp;Indicates email sent to listing for no recip. No need to click.
            </div>
          </div>
          <?php	if ($totalRows_RSDirectory > 0) { do { ?>
						<div id="listingbox<?php echo $row_RSDirectory["tbl_id"]; ?>" class="listingbox <?php if ($row_RSDirectory["list_active"] == 1) { echo "activebg"; } else { echo "inactivebg"; } ?>">
              <div class="listingdetails">
							  <strong>Name:</strong> <?php echo ucwords($row_RSDirectory["list_name"]); ?><br>
							  <strong>Email:</strong> <a href="mailto:<?php echo $row_RSDirectory["list_email"]; ?>"><?php echo $row_RSDirectory["list_email"]; ?></a><br>
							  <?php if (substr($row_RSDirectory["list_url"],0,4) != "http") {	$theURL = "http://".$row_RSDirectory["list_url"];	} else { $theURL = $row_RSDirectory["list_url"]; }?>
                <strong>URL:</strong> <a href="<?php echo $theURL; ?>" target="_blank"><?php echo $theURL; ?></a><br>
							  <?php if ($row_RSDirectory["list_recip"] != "") {?>
								<?php if (substr($row_RSDirectory["list_recip"],0,4) != "http") {	$theRecip = "http://".$row_RSDirectory["list_recip"];	} else { $theRecip = $row_RSDirectory["list_recip"]; }?>
                <strong>Recip:</strong> <a href="<?php echo $theRecip; ?>" target="_blank">Click To View</a><br>
							  <?php } else { ?>
                <strong>Recip:</strong>&nbsp;<br>
								<?php } ?>
                <strong>Pass:</strong> <span id="pw<?php echo $row_RSDirectory["tbl_id"]; ?>" class="handy" onClick='sendpassword(<?php echo $row_RSDirectory["tbl_id"]; ?>)'><?php echo $row_RSDirectory["list_pass"]; ?></span><br>
              </div>
              <div class="listingoptions">
                <a href="edit.php?tbl_id=<?php echo $row_RSDirectory["tbl_id"]; ?>&dir=<?php echo $_GET["dir"]; if ($_GET["listingtype"] != "") { echo "&listingtype=".$_GET["listingtype"]; } ?>"><span class="editicon"></span></a>
                <span class="deleteicon" onClick="delListing(<?php echo $row_RSDirectory["tbl_id"]; ?>);"></span>
                <span id="activ8<?php echo $row_RSDirectory["tbl_id"]; ?>"><?php if ($row_RSDirectory["list_active"] == 1) { echo "<span class='activeyicon' onClick='activ8page(".$row_RSDirectory["tbl_id"].",".$row_RSDirectory["list_active"].")'></span>"; } else { echo "<span class='activenicon' onClick='activ8page(".$row_RSDirectory["tbl_id"].",".$row_RSDirectory["list_active"].")'></span>"; } ?></span>
                <a href="sponsored.php?tbl_id=<?php echo $row_RSDirectory["tbl_id"]; ?>&dir=<?php echo $_GET["dir"]; if ($_GET["listingtype"] != "") { echo "&listingtype=".$_GET["listingtype"]; } ?>"><?php if ($row_RSDirectory["list_sponsored"] == 1) { ?> <span class="sponyicon"></span> <?php } else { ?> <span class="sponnicon"></span> <?php } ?></a>
                <span id="flagged<?php echo $row_RSDirectory["tbl_id"]; ?>"><?php if ($row_RSDirectory["list_flagged"] == 1) { echo "<span class='flagyicon' onClick='flagpage(".$row_RSDirectory["tbl_id"].",".$row_RSDirectory["list_flagged"].")'></span>"; } else { echo "<span class='flagnicon' onClick='flagpage(".$row_RSDirectory["tbl_id"].",".$row_RSDirectory["list_flagged"].")'></span>"; } ?></span>
                <span id="emailed<?php echo $row_RSDirectory["tbl_id"]; ?>"><span class='emailnicon' onClick='emailpage(<?php echo $row_RSDirectory["tbl_id"]; ?>)'></span></span>
              </div>
            </div>            
					<?php } while ($row_RSDirectory = mysql_fetch_assoc($RSDirectory)); } else { echo "<br><br><span class='msg'>No Listings To Display</span>"; }
					?>
        <?php } ?>
      </div>
      <br><br>
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
mysql_free_result($RSDirectory);
?>