<!-- Website Profile -->
<?php
$thedir = "/adultdirectories/".strtolower(str_replace(" ","",str_replace(" - ","/",getdirectoryname($row_RSListing["list_sub"]))))."/".$row_RSListing["list_title"];
if ($row_RSListing["list_ppic"] != "") {
  echo "<div class='addmorepic'>Main Photo $i<br><a href='/scripts/cp/editprofile/piceditmain.php?tbl_id=".$row_RSListing["tbl_id"]."&pic=list_ppic'><img src='".$thedir."/t/".$row_RSListing["list_ppic"]."' width='100' class='picborder corners'></a><br><a href='/scripts/cp/editprofile/deletepicedit.php?pic=list_ppic&id=".$row_RSListing["tbl_id"]."' onClick='return delAddPic();'>DELETE</a></div>";
} else {
  echo "<div class='addmorepic'>Main Photo $i<br><a href='/scripts/cp/editprofile/piceditmain.php?tbl_id=".$row_RSListing["tbl_id"]."&pic=list_ppic'><img src='/images/nopic.jpg' width='100' class='picborder corners'></a><br><br></div>";
}
echo "<br>";
?>
<div id="addwebsite" class="addwebsiteform">
  <form action="/scripts/cp/editprofile/websitesavedetails.php" method="post" name="website">
    <label>Website Name<span class="small">Note: Name not editable</span></label>
    <input type="text" name="Name" id="Name" value="<?php echo $row_RSListing["list_name"]; ?>" disabled>
    <div class="clearfix"></div>
    <label>Website URL<span class="small">URL of your website</span></label>
    <input type="text" name="URL" id="URL" value="<?php echo $row_RSListing["list_url"]; ?>">
    <div class="clearfix"></div>
    <label>Reciprocal URL<span class="small">Our URL on your website</span></label>
    <input type="text" name="Recip" id="Recip" value="<?php echo $row_RSListing["list_recip"]; ?>">
    <div class="clearfix"></div>
    <label>Email Address<span class="small">Your email address</span></label>
    <input type="email" name="Email" id="Email" value="<?php echo $row_RSListing["list_email"]; ?>">
    <div class="clearfix"></div>
    <label>Phone Number<span class="small">Your phone number</span></label>
    <input type="text" name="Phone" id="Phone" value="<?php echo $row_RSListing["list_num"]; ?>" onKeyUp="checkchars('Phone',20);" maxlength="20"><span id="PhoneChars" class="chars">Characters<br>Remaining: 20</span>
    <div class="clearfix"></div>
    <label>Country<span class="small">Main targeted country</span></label>
    <?php echo getcountry($row_RSListing["list_country"]); ?>
    <div class="clearfix"></div>
    <label>Area (Country)<span class="small">Area your website covers</span></label>
    <input type="text" name="Area" id="Area" value="<?php echo $row_RSListing["list_area"]; ?>" onKeyUp="checkchars('Area',30);" maxlength="30"><span id="AreaChars" class="chars">Characters<br>Remaining: 30</span>
    <div class="clearfix"></div>
    <label>Keywords<span class="small">Upto 10, seperate by comma</span></label>
    <input type="text" name="Keywords" id="Keywords" value="<?php echo $row_RSListing["list_keys"]; ?>" onKeyUp="checkchars('Keywords',100);" maxlength="100"><span id="KeywordsChars" class="chars">Characters<br>Remaining: 100</span>
    <div class="clearfix"></div>
    <label>Description<span class="small">Description of your website</span></label>
    <textarea name="Description" rows="8" id="Description" onKeyUp="checkchars('Description',1000);" maxlength="1000"><?php echo $row_RSListing["list_desc"]; ?></textarea><span id="DescriptionChars" class="chars">Characters<br>Remaining: 1000</span>
    <div class="clearfix"></div>
    <?php if ($row_RSListing["list_sponsored"] == 1) { ?>
    <label>Sponsored Ad Text<span class="small">Text for your sponsored ad.</span></label>
    <textarea name="SponsoredText" rows="4" id="SponsoredText" onKeyUp="checkchars('SponsoredText',150);" maxlength="150"><?php echo $row_RSListing["list_spon_text"]; ?></textarea><span id="SponsoredTextChars" class="chars">Characters<br>Remaining: 150</span>
    <div class="clearfix"></div>
    <? } ?>
    <input name="tbl_id" type="hidden" value="<?php echo $row_RSListing["tbl_id"]; ?>">
    <input name="dir" type="hidden" value="<?php echo $_GET["dir"]; ?>">
    <input name="listingtype" type="hidden" value="<?php echo $_GET["listingtype"]; ?>">
    <button type="submit" onClick="return valeditwebsiteform();">UPDATE DETAILS</button>
  </form>
</div>
<script>
checkchars('Phone',20);
checkchars('Area',30);
checkchars('Keywords',100);
checkchars('Description',1000);
checkchars('SponsoredText',150);
</script>
<br><br>
