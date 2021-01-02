<!-- Escort Profile -->
<div class="listingBox">
  <div class="profileimage"><img src='/adultdirectories/<?php echo $dir; ?>/<?php echo $sub; ?>/<?php echo $row_RSProfile["list_title"]; ?>/m/<?php echo $row_RSProfile["list_ppic"]; ?>'></div>
  <div class="profiledetails">
    <div class="smallheader iBlock">Name</div>
    <?php if ($row_RSProfile["list_name"] != "") { ?>
	  <div class="listdetails iBlock"><?php echo ucwords($row_RSProfile["list_name"]); ?></div>
    <?php } else { ?>
	  <div class="listdetails iBlock">&nbsp;</div>
    <?php } ?>
    <div class="smallheader iBlock">Age</div>
	  <div class="smalllistdetails iBlock"><?php echo getage($row_RSProfile["list_age"]); ?></div>
    <div class="smallheader iBlock">Gender</div>
	  <div class="smalllistdetails iBlock"><?php echo getgender($row_RSProfile["list_gender"]); ?></div>
    <div class="smallheader iBlock">Country</div>
    <?php if ($row_RSProfile["list_country"] != "") { ?>
	  <div class="smalllistdetails iBlock"><?php echo $row_RSProfile["list_country"]; ?></div>
    <?php } else { ?>
	  <div class="smalllistdetails iBlock">&nbsp;</div>
    <?php } ?>
    <div class="smallheader iBlock">Area</div>
    <?php if ($row_RSProfile["list_area"] != "") { ?>
	  <div class="smalllistdetails iBlock"><?php echo $row_RSProfile["list_area"]; ?></div>
    <?php } else { ?>
	  <div class="smalllistdetails iBlock">&nbsp;</div>
    <?php } ?>
    <div class="smallheader iBlock">Phone Number</div>
    <?php if ($row_RSProfile["list_num"] != "") { ?>
    <div class="smalllistdetails iBlock"><?php echo $row_RSProfile["list_num"]; ?></div>
    <?php } else { ?>
    <div class="smalllistdetails iBlock">&nbsp;</div>
    <?php } ?>
    <div class="smallheader iBlock">Hair Colour</div>
	  <div class="smalllistdetails iBlock"><?php echo gethaircolour($row_RSProfile["list_hair"]); ?></div>
    <div class="smallheader iBlock">Eye Colour</div>
	  <div class="smalllistdetails iBlock"><?php echo geteyecolour($row_RSProfile["list_eyes"]); ?></div>
    <div class="smallheader iBlock">Height</div>
	  <div class="smalllistdetails iBlock"><?php echo getheight($row_RSProfile["list_height"]); ?></div>
    <div class="smallheader iBlock">Stats</div>
    <?php if ($row_RSProfile["list_stats"] != "") { ?>
    <div class="smalllistdetails iBlock"><?php echo $row_RSProfile["list_stats"]; ?></div>
    <?php } else { ?>
    <div class="smalllistdetails iBlock">&nbsp;</div>
    <?php } ?>
    <div class="smallheader iBlock">Prices</div>
	  <div class="smalllistdetails iBlock"><?php echo getprices($row_RSProfile["list_cost"]); ?></div>
    <div class="smallheader iBlock">Call Type</div>
	  <div class="smalllistdetails iBlock"><?php echo getcalltype($row_RSProfile["list_calltype"]); ?></div>
    <div class="smallheader iBlock">Email</div>
    <?php if ($row_RSProfile["list_email"] != "") { ?>
	  <div class="smalllistdetails iBlock"><a href="/adultdirectories/sendemail.php?id=<?php echo $row_RSProfile["tbl_id"]; ?>">Click Here To Email</a></div>
    <?php } else { ?>
    <div class="smalllistdetails iBlock">&nbsp;</div>
    <?php } ?>
    <div class="smallheader iBlock">Website URL</div>
    <?php if ($row_RSProfile["list_url"] != "") { ?>
    <?php if (substr($row_RSProfile["list_url"],0,4) != "http") {	$theURL = "http://".$row_RSProfile["list_url"];	} else { $theURL = $row_RSProfile["list_url"]; }?>
	  <div class="listdetails iBlock"><a href="<?php echo $theURL; ?>" target="_blank"><?php echo $theURL; ?></a></div>
    <?php } else { ?>
	  <div class="listdetails iBlock">&nbsp;</div>
    <?php } ?>
  </div>
</div>
<?php if ($row_RSProfile["list_pic1"] != "" | $row_RSProfile["list_pic2"] != "" | $row_RSProfile["list_pic3"] != "" | $row_RSProfile["list_pic4"] != "" | $row_RSProfile["list_pic5"] != "" | $row_RSProfile["list_pic6"] != "" | $row_RSProfile["list_pic7"] != "" | $row_RSProfile["list_pic8"] != "") {?>
  <br class="clearfix">
  <div class="gallery">
  <?php if ($row_RSProfile["list_pic1"] != "") { ?>
    <a href="/adultdirectories/<?php echo $dir."/".$sub."/".$row_RSProfile["list_title"]."/m/".$row_RSProfile["list_pic1"]; ?>" rel="prettyPhoto[gallery]"><img class='picborder corners' src='/adultdirectories/<?php echo $dir."/".$sub."/".$row_RSProfile["list_title"]."/t/".$row_RSProfile["list_pic1"]; ?>'></a>
  <?php } ?>
  <?php if ($row_RSProfile["list_pic2"] != "") { ?>
    <a href="/adultdirectories/<?php echo $dir."/".$sub."/".$row_RSProfile["list_title"]."/m/".$row_RSProfile["list_pic2"]; ?>" rel="prettyPhoto[gallery]"><img class='picborder corners' src='/adultdirectories/<?php echo $dir."/".$sub."/".$row_RSProfile["list_title"]."/t/".$row_RSProfile["list_pic2"]; ?>'></a>
  <?php } ?>
  <?php if ($row_RSProfile["list_pic3"] != "") { ?>
    <a href="/adultdirectories/<?php echo $dir."/".$sub."/".$row_RSProfile["list_title"]."/m/".$row_RSProfile["list_pic3"]; ?>" rel="prettyPhoto[gallery]"><img class='picborder corners' src='/adultdirectories/<?php echo $dir."/".$sub."/".$row_RSProfile["list_title"]."/t/".$row_RSProfile["list_pic3"]; ?>'></a>
  <?php } ?>
  <?php if ($row_RSProfile["list_pic4"] != "") { ?>
    <a href="/adultdirectories/<?php echo $dir."/".$sub."/".$row_RSProfile["list_title"]."/m/".$row_RSProfile["list_pic4"]; ?>" rel="prettyPhoto[gallery]"><img class='picborder corners' src='/adultdirectories/<?php echo $dir."/".$sub."/".$row_RSProfile["list_title"]."/t/".$row_RSProfile["list_pic4"]; ?>'></a>
  <?php } ?>
  <?php if ($row_RSProfile["list_pic5"] != "") { ?>
    <a href="/adultdirectories/<?php echo $dir."/".$sub."/".$row_RSProfile["list_title"]."/m/".$row_RSProfile["list_pic5"]; ?>" rel="prettyPhoto[gallery]"><img class='picborder corners' src='/adultdirectories/<?php echo $dir."/".$sub."/".$row_RSProfile["list_title"]."/t/".$row_RSProfile["list_pic5"]; ?>'></a>
  <?php } ?>
  <?php if ($row_RSProfile["list_pic6"] != "") { ?>
    <a href="/adultdirectories/<?php echo $dir."/".$sub."/".$row_RSProfile["list_title"]."/m/".$row_RSProfile["list_pic6"]; ?>" rel="prettyPhoto[gallery]"><img class='picborder corners' src='/adultdirectories/<?php echo $dir."/".$sub."/".$row_RSProfile["list_title"]."/t/".$row_RSProfile["list_pic6"]; ?>'></a>
  <?php } ?>
  <?php if ($row_RSProfile["list_pic7"] != "") { ?>
    <a href="/adultdirectories/<?php echo $dir."/".$sub."/".$row_RSProfile["list_title"]."/m/".$row_RSProfile["list_pic7"]; ?>" rel="prettyPhoto[gallery]"><img class='picborder corners' src='/adultdirectories/<?php echo $dir."/".$sub."/".$row_RSProfile["list_title"]."/t/".$row_RSProfile["list_pic7"]; ?>'></a>
  <?php } ?>
  <?php if ($row_RSProfile["list_pic8"] != "") { ?>
    <a href="/adultdirectories/<?php echo $dir."/".$sub."/".$row_RSProfile["list_title"]."/m/".$row_RSProfile["list_pic8"]; ?>" rel="prettyPhoto[gallery]"><img class='picborder corners' src='/adultdirectories/<?php echo $dir."/".$sub."/".$row_RSProfile["list_title"]."/t/".$row_RSProfile["list_pic8"]; ?>'></a>
  <?php } ?>
  </div>
<?php } ?>
<br>
<div class="descriptionbox">
  <div class="descriptionheader">Description</div>
  <div class="descriptiondets"><?php echo nl2br($row_RSProfile["list_desc"]); ?></div>
</div>
<br>