<?php require_once('../../scripts/db/connection.php'); ?>
<?php require_once('../../scripts/cp/getvalstring.php'); ?>
<?php require_once('../../scripts/cp/authnlogout.php'); ?>
<?php require_once("../../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSCountries = "SELECT * FROM tbl_purebiz_cl_countries ORDER BY country_name ASC";
$RSCountries = mysql_query($query_RSCountries, $Wisdom_Mcr) or die(mysql_error());
$row_RSCountries = mysql_fetch_assoc($RSCountries);
$totalRows_RSCountries = mysql_num_rows($RSCountries);

function resizeImage($image,$width,$height) {
  $newImageWidth = ceil(120);
  $newImageHeight = ceil(120);
  $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
  $source = imagecreatefromjpeg($image);
  imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
  imagejpeg($newImage,$image,90);
  chmod($image, 0777);
}
function getHeight($image) {
  $sizes = getimagesize($image);
  $height = $sizes[1];
  return $height;
}
function getWidth($image) {
  $sizes = getimagesize($image);
  $width = $sizes[0];
  return $width;
}

if (isset($_POST["upload"])) {
	
  if ($_FILES["image2"]["size"] > 0) {
	if ($_FILES["image2"]["type"] == "image/jpeg" || $_FILES["image2"]["type"] == "image/pjpeg") {
	  if ($_FILES["image2"]["error"] > 0) {
		echo "Return Code: " . $_FILES["image2"]["error"] . "<br />";
	  } else {
		$usrCode2 = mt_rand()."".mt_rand();
		move_uploaded_file($_FILES["image2"]["tmp_name"],"../../images/chatlines/".$usrCode2.".jpg");
		$width2 = getWidth("../../images/chatlines/".$usrCode2.".jpg");
		$height2 = getHeight("../../images/chatlines/".$usrCode2.".jpg");
		resizeImage("../../images/chatlines/".$usrCode2.".jpg",$width2,$height2);
	  }
	} else {
	  echo "Invalid file";
	}
	$insertSQL = "INSERT INTO tbl_purebiz_clcats (cat_name,cat_img,cat_title,cat_keywords,cat_mdesc,cat_country) VALUES ('".$_POST["Name"]."','".$usrCode2.".jpg','".$_POST["Title"]."','".$_POST["Keywords"]."','".$_POST["Description"]."',".$_POST["Country"].")";
	mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
	$Result1 = mysql_query($insertSQL, $Wisdom_Mcr) or die(mysql_error());
  unset($_SESSION["ChatCats"]);
  $_SESSION["clcountry"] = $_POST["Country"];
	
	header(sprintf("Location: index.php?s=4"));
  } else {
	$error = "Please select a picture.<br><br>";  
  }
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
        <h1>Add Chatline Category</h1>
        <br><br>
        <p>Complete the form below with the chatline details then click "<strong>ADD CHATLINE</strong>" to save the details.<br>
        <em>Note: Max image filesize is 1mb</em>. </p>
        <br><br>
        <?php if (isset($error)) { echo "<span class='msg'>".$error."</span>"; }?>
        <div id="addchatline" class="addchatlineform">
          <form name="photo" enctype="multipart/form-data" action="<?php echo $_SERVER["../PHP_SELF"];?>" method="post">
            <label>Name<span class="small">Name of the chatline</span></label>
            <input name="Name" type="text" id="Name" size="30">
            <div class="clearfix"></div>
            <label>Title<span class="small">Meta title (page)</span></label>
            <input name="Title" type="text" id="Title" size="100">
            <div class="clearfix"></div>
            <label>Keywords<span class="small">Meta keywords (page)</span></label>
            <input name="Keywords" type="text" id="Keywords" size="200">
            <div class="clearfix"></div>
            <label>Description<span class="small">Meta description (page)</span></label>
            <input name="Description" type="text" id="Description" size="200">
            <div class="clearfix"></div>
            <label>Country<span class="small">Country for category</span></label>
            <select name="Country">
            <?php do {?>
              <option value="<?php echo $row_RSCountries["tbl_id"]; ?>" <?php if ($_SESSION["clcountry"] == $row_RSCountries["tbl_id"]) { echo "selected"; } ?>><?php echo $row_RSCountries["country_name"]; ?></option>
            <?php } while ($row_RSCountries = mysql_fetch_assoc($RSCountries)); ?>
            </select>
            <div class="clearfix"></div>
            <label>Picture<span class="small">Chatline picture</span></label>
            <input type="file" name="image2" size="30">
            <div class="clearfix"></div>
            <input name="upload" type="hidden" value="Upload">
          <button type="submit" onClick="MM_validateForm('Name','','R');return document.MM_returnValue">ADD CATEGORY</button> or <button type="button" onClick="location.href='index.php'">CANCEL</button>
          </form>
        </div>
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
mysql_free_result($RSCountries);
?>