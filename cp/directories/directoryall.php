<?php require("../../scripts/db/connection.php"); ?>
<?php require("../../scripts/cp/authnlogout.php"); ?>
<?php require("../../scripts/functions/nav/navfunctions.php"); ?>
<?php require("../../scripts/cp/functions/directoryfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
if ($_GET["o"] == "") {
	$query_RSDirectory = "SELECT * FROM tbl_purebiz_listings ORDER BY list_active,list_name ASC";
	$heading = "All Listings";
} else {
	switch ($_GET["o"]) {
		case "sponsored":
			$query_RSDirectory = "SELECT * FROM tbl_purebiz_listings WHERE list_sponsored=1 ORDER BY list_active,list_name ASC";
			$heading = "Sponsored Listings";
			break;
		case "flagged":
			$query_RSDirectory = "SELECT * FROM tbl_purebiz_listings WHERE list_flagged=1 ORDER BY list_active,list_name ASC";
			$heading = "Flagged Listings";
			break;
		case "inactive":
			$query_RSDirectory = "SELECT * FROM tbl_purebiz_listings WHERE list_active=0 ORDER BY list_active,list_name ASC";
			$heading = "Inactive Listings";
			break;
	}
}
$RSDirectory = mysql_query($query_RSDirectory, $Wisdom_Mcr) or die(mysql_error());
$row_RSDirectory = mysql_fetch_assoc($RSDirectory);
$totalRows_RSDirectory = mysql_num_rows($RSDirectory);
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
        <h1><?php echo $heading; ?></h1>
        <br>
        <div id="diroptions" class="diroptionsform">
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
        <?php } while ($row_RSDirectory = mysql_fetch_assoc($RSDirectory)); } else { echo "<br><br><span class='msg'>No Listings To Display</span>"; } ?>
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