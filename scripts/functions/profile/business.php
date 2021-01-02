<!-- Business Profile -->
<div class="listingBox">
  <div class="profileimage"><img src='/adultdirectories/<?php echo $dir; ?>/<?php echo $sub; ?>/<?php echo $row_RSProfile["list_title"]; ?>/m/<?php echo $row_RSProfile["list_ppic"]; ?>'></div>
  <div class="profiledetails">
    <div class="smallheader iBlock">Business Name</div>
    <?php if ($row_RSProfile["list_name"] != "") { ?>
	  <div class="listdetails iBlock"><?php echo ucwords($row_RSProfile["list_name"]); ?></div>
    <?php } else { ?>
	  <div class="listdetails iBlock">&nbsp;</div>
    <?php } ?>
    <div class="smallheader iBlock">Phone Number</div>
    <?php if ($row_RSProfile["list_num"] != "") { ?>
    <div class="listdetails iBlock"><?php echo $row_RSProfile["list_num"]; ?></div>
    <?php } else { ?>
    <div class="listdetails iBlock">&nbsp;</div>
    <?php } ?>
    <div class="smallheader iBlock">Address</div>
    <?php if ($row_RSProfile["list_addy"] != "") { ?>
    <div class="listdetails iBlock"><?php echo $row_RSProfile["list_addy"]; ?></div>
    <?php } else { ?>
    <div class="listdetails iBlock">&nbsp;</div>
    <?php } ?>
    <div class="smallheader iBlock">Town/City</div>
    <?php if ($row_RSProfile["list_area"] != "") { ?>
	  <div class="listdetails iBlock"><?php echo $row_RSProfile["list_area"]; ?></div>
    <?php } else { ?>
	  <div class="listdetails iBlock">&nbsp;</div>
    <?php } ?>
    <div class="smallheader iBlock">Country</div>
    <?php if ($row_RSProfile["list_country"] != "") { ?>
	  <div class="listdetails iBlock"><?php echo $row_RSProfile["list_country"]; ?></div>
    <?php } else { ?>
	  <div class="listdetails iBlock">&nbsp;</div>
    <?php } ?>
    <div class="smallheader iBlock">Postcode</div>
    <?php if ($row_RSProfile["list_postcode"] != "") { ?>
    <div class="listdetails iBlock"><a href="http://maps.google.co.uk/maps?q=<?php echo $row_RSProfile["list_postcode"]; ?>" target="_blank"><?php echo $row_RSProfile["list_postcode"]; ?></a></div>
    <?php } else { ?>
    <div class="listdetails iBlock">&nbsp;</div>
    <?php } ?>
    <div class="smallheader iBlock">Email</div>
    <?php if ($row_RSProfile["list_email"] != "") { ?>
	  <div class="listdetails iBlock"><a href="/adultdirectories/sendemail.php?id=<?php echo $row_RSProfile["tbl_id"]; ?>">Click Here To Email</a></div>
    <?php } else { ?>
    <div class="listdetails iBlock">&nbsp;</div>
    <?php } ?>
    <div class="smallheader iBlock">Website URL</div>
    <?php if ($row_RSProfile["list_url"] != "") { ?>
    <?php if (substr($row_RSProfile["list_url"],0,4) != "http") {	$theURL = "http://".$row_RSProfile["list_url"];	} else { $theURL = $row_RSProfile["list_url"]; }?>
	  <div class="listdetails iBlock"><a href="<?php echo $theURL; ?>" target="_blank"><?php echo $theURL; ?></a></div>
    <?php } else { ?>
	  <div class="listdetails iBlock">&nbsp;</div>
    <?php } ?>
  </div>
  <br class="clearfix">
</div>
<br>
<div class="descriptionbox">
    <div class="descriptionheader">Description</div>
    <div class="descriptiondets"><?php echo nl2br($row_RSProfile["list_desc"]); ?></div>
</div>
<br>


