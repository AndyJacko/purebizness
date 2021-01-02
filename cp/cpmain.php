<?php //phpinfo(); ?>
<?php require("../scripts/db/connection.php"); ?>
<?php require("../scripts/cp/authnlogout.php"); ?>
<?php require("../scripts/functions/nav/navfunctions.php"); ?>
<?php require("../scripts/cp/functions/directoryfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSNew = "SELECT * FROM tbl_purebiz_listings WHERE list_active=0 AND list_flagged=0 AND list_override=0 ORDER BY list_active,list_name ASC";
$RSNew = mysql_query($query_RSNew, $Wisdom_Mcr) or die(mysql_error());
$row_RSNew = mysql_fetch_assoc($RSNew);
$totalRows_RSNew = mysql_num_rows($RSNew);

mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSFlagged = "SELECT * FROM tbl_purebiz_listings WHERE list_flagged=1 ORDER BY list_active,list_name ASC";
$RSFlagged = mysql_query($query_RSFlagged, $Wisdom_Mcr) or die(mysql_error());
$row_RSFlagged = mysql_fetch_assoc($RSFlagged);
$totalRows_RSFlagged = mysql_num_rows($RSFlagged);
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
<script type="text/javascript" src="/scripts/js/recip.js"></script> 
<!-- InstanceEndEditable -->
</head>

<body>
  <header id="header"><?php include('../scripts/design/cpheader.php'); ?></header>
  <section id="pagebody">
    <div id="content" class="column">
      <div id="actualcontent">
      <!-- InstanceBeginEditable name="content" -->
        <div id="content">
          <h1>Main Controlpanel</h1>
          <br><br>
          <p>Check reciprocal link status for directory listings. Always manually check link before deactivating listing.</p>
          <br><br>
          <h2>New/Deactivated Listings</h2>
					<?php	if ($totalRows_RSNew > 0) { do { ?>
            <div id="listingbox<?php echo $row_RSNew["tbl_id"]; ?>" class="listingbox <?php if ($row_RSNew["list_active"] == 1) { echo "activebg"; } else { echo "inactivebg"; } ?>">
              <div class="listingdetails">
                <strong>Name:</strong> <?php echo ucwords($row_RSNew["list_name"]); ?><br>
                <strong>Email:</strong> <a href="mailto:<?php echo $row_RSNew["list_email"]; ?>"><?php echo $row_RSNew["list_email"]; ?></a><br>
                <?php if (substr($row_RSNew["list_url"],0,4) != "http") {	$theURL = "http://".$row_RSNew["list_url"];	} else { $theURL = $row_RSNew["list_url"]; }?>
                <strong>URL:</strong> <a href="<?php echo $theURL; ?>" target="_blank"><?php echo $theURL; ?></a><br>
                <?php if ($row_RSNew["list_recip"] != "") {?>
                <?php if (substr($row_RSNew["list_recip"],0,4) != "http") {	$theRecip = "http://".$row_RSNew["list_recip"];	} else { $theRecip = $row_RSNew["list_recip"]; }?>
                <strong>Recip:</strong> <a href="<?php echo $theRecip; ?>" target="_blank">Click To View</a><br>
                <?php } else { ?>
                <strong>Recip:</strong>&nbsp;<br>
                <?php } ?>
                <strong>Pass:</strong> <span id="pw<?php echo $row_RSNew["tbl_id"]; ?>" class="handy" onClick='sendpassword(<?php echo $row_RSNew["tbl_id"]; ?>)'><?php echo $row_RSNew["list_pass"]; ?></span><br>
              </div>
              <div class="listingoptions">
                <a href="directories/edit.php?tbl_id=<?php echo $row_RSNew["tbl_id"]; ?>&dir=<?php echo $_GET["dir"]; if ($_GET["listingtype"] != "") { echo "&listingtype=".$_GET["listingtype"]; } ?>"><span class="editicon"></span></a>
                <span class="deleteicon" onClick="delListing2(<?php echo $row_RSNew["tbl_id"]; ?>);"></span>
                <span id="activ8<?php echo $row_RSNew["tbl_id"]; ?>"><?php if ($row_RSNew["list_active"] == 1) { echo "<span class='activeyicon' onClick='activ8page2(".$row_RSNew["tbl_id"].",".$row_RSNew["list_active"].")'></span>"; } else { echo "<span class='activenicon' onClick='activ8page2(".$row_RSNew["tbl_id"].",".$row_RSNew["list_active"].")'></span>"; } ?></span>
                <span id="flagged<?php echo $row_RSNew["tbl_id"]; ?>"><?php if ($row_RSNew["list_flagged"] == 1) { echo "<span class='flagyicon' onClick='flagpage2(".$row_RSNew["tbl_id"].",".$row_RSNew["list_flagged"].")'></span>"; } else { echo "<span class='flagnicon' onClick='flagpage2(".$row_RSNew["tbl_id"].",".$row_RSNew["list_flagged"].")'></span>"; } ?></span>
                <span class="<?php if ($row_RSNew["list_override"] == 1) { echo "overyicon"; } else { echo "overnicon"; } ?>" onClick="override2(<?php echo $row_RSNew["tbl_id"]; ?>,<?php echo $row_RSNew["list_override"]; ?>);"></span>
                <span id="emailed<?php echo $row_RSNew["tbl_id"]; ?>"><span class='emailnicon' onClick='emailpage2(<?php echo $row_RSNew["tbl_id"]; ?>)'></span></span>
              </div>
            </div> 
          <?php } while ($row_RSNew = mysql_fetch_assoc($RSNew)); } else { echo "<br><span class='msg'>No New/Deactivated Listings To Display</span>"; } ?>
          <br><br>
          <br><br>
          <h2>Flagged Reciprocal Links</h2>
					<?php	if ($totalRows_RSFlagged > 0) { do { ?>
            <div id="listingbox<?php echo $row_RSFlagged["tbl_id"]; ?>" class="listingbox <?php if ($row_RSFlagged["list_active"] == 1) { echo "activebg"; } else { echo "inactivebg"; } ?>">
              <div class="listingdetails">
                <strong>Name:</strong> <?php echo ucwords($row_RSFlagged["list_name"]); ?><br>
                <strong>Email:</strong> <a href="mailto:<?php echo $row_RSFlagged["list_email"]; ?>"><?php echo $row_RSFlagged["list_email"]; ?></a><br>
                <?php if (substr($row_RSFlagged["list_url"],0,4) != "http") {	$theURL = "http://".$row_RSFlagged["list_url"];	} else { $theURL = $row_RSFlagged["list_url"]; }?>
                <strong>URL:</strong> <a href="<?php echo $theURL; ?>" target="_blank"><?php echo $theURL; ?></a><br>
                <?php if ($row_RSFlagged["list_recip"] != "") {?>
                <?php if (substr($row_RSFlagged["list_recip"],0,4) != "http") {	$theRecip = "http://".$row_RSFlagged["list_recip"];	} else { $theRecip = $row_RSFlagged["list_recip"]; }?>
                <strong>Recip:</strong> <a href="<?php echo $theRecip; ?>" target="_blank">Click To View</a><br>
                <?php } else { ?>
                <strong>Recip:</strong>&nbsp;<br>
                <?php } ?>
                <strong>Pass:</strong> <span id="pw<?php echo $row_RSFlagged["tbl_id"]; ?>" class="handy" onClick='sendpassword(<?php echo $row_RSFlagged["tbl_id"]; ?>)'><?php echo $row_RSFlagged["list_pass"]; ?></span><br>
              </div>
              <div class="listingoptions">
                <a href="directories/edit.php?tbl_id=<?php echo $row_RSFlagged["tbl_id"]; ?>&dir=<?php echo $_GET["dir"]; if ($_GET["listingtype"] != "") { echo "&listingtype=".$_GET["listingtype"]; } ?>"><span class="editicon"></span></a>
                <span class="deleteicon" onClick="delListing2(<?php echo $row_RSFlagged["tbl_id"]; ?>);"></span>
                <span id="activ8<?php echo $row_RSFlagged["tbl_id"]; ?>"><?php if ($row_RSFlagged["list_active"] == 1) { echo "<span class='activeyicon' onClick='activ8page2(".$row_RSFlagged["tbl_id"].",".$row_RSFlagged["list_active"].")'></span>"; } else { echo "<span class='activenicon' onClick='activ8page2(".$row_RSFlagged["tbl_id"].",".$row_RSFlagged["list_active"].")'></span>"; } ?></span>
                <span id="flagged<?php echo $row_RSFlagged["tbl_id"]; ?>"><?php if ($row_RSFlagged["list_flagged"] == 1) { echo "<span class='flagyicon' onClick='flagpage2(".$row_RSFlagged["tbl_id"].",".$row_RSFlagged["list_flagged"].")'></span>"; } else { echo "<span class='flagnicon' onClick='flagpage2(".$row_RSFlagged["tbl_id"].",".$row_RSFlagged["list_flagged"].")'></span>"; } ?></span>
                <span class="<?php if ($row_RSFlagged["list_override"] == 1) { echo "overyicon"; } else { echo "overnicon"; } ?>" onClick="override2(<?php echo $row_RSFlagged["tbl_id"]; ?>,<?php echo $row_RSFlagged["list_override"]; ?>);"></span>
                <span id="emailed<?php echo $row_RSFlagged["tbl_id"]; ?>"><span class='emailnicon' onClick='emailpage2(<?php echo $row_RSFlagged["tbl_id"]; ?>)'></span></span>
              </div>
            </div> 
          <?php } while ($row_RSFlagged = mysql_fetch_assoc($RSFlagged)); } else { echo "<br><span class='msg'>No Flagged Listings To Display</span>"; } ?>
        </div>
        <br><br>
      <!-- InstanceEndEditable -->
      </div>
    </div>
    <nav id="sitenav" class="column"><?php require("../scripts/design/cpnav.php"); ?></nav>
    <section id="rhs" class="column">&nbsp;</section>
    <br class="clearfix">
  </section>
  <footer id="footer"><?php require("../scripts/design/footer.php"); ?></footer>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RSNew);
mysql_free_result($RSFlagged);
?>