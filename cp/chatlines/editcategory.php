<?php require_once('../../scripts/db/connection.php'); ?>
<?php require_once('../../scripts/cp/getvalstring.php'); ?>
<?php require_once('../../scripts/cp/authnlogout.php'); ?>
<?php require_once("../../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSCat = "SELECT * FROM tbl_purebiz_clcats WHERE tbl_id=".$_GET["tbl_id"];
$RSCat = mysql_query($query_RSCat, $Wisdom_Mcr) or die(mysql_error());
$row_RSCat = mysql_fetch_assoc($RSCat);
$totalRows_RSCat = mysql_num_rows($RSCat);

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
	$updateSQL = "UPDATE tbl_purebiz_clcats SET cat_name='".$_POST["Name"]."',cat_title='".$_POST["Title"]."',cat_keywords='".$_POST["Keywords"]."',cat_mdesc='".$_POST["Description"]."',cat_country=".$_POST["Country"];
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
		$updateSQL = $updateSQL.",cat_img='".$usrCode2.".jpg'";
        unlink("../../images/chatlines/".$_POST["OldPic"]);
	  }
	} else {
	  echo "Invalid file";
	}
  }
  $updateSQL = $updateSQL." WHERE tbl_id=".$_POST["tbl_id"];
  //echo $updateSQL;
  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  $Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());
  $_SESSION["clcountry"] = $_POST["Country"];
	
  header(sprintf("Location: index.php?s=5"));
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
        <h1>Edit Chatline Category</h1>
        <br><br>
        <p>Update the form below with the chatline details then click "<strong>UPDATE</strong>" to save the details.<br>
        <em>Note: Max image filesize is 1mb</em>.  </p>
        <br><br>
        <?php if (isset($error)) { echo "<span class='msg'>".$error."</span>"; }?>
        <?php
				if ($row_RSCat["cat_img"] != "") {
				echo "<img src='../../images/chatlines/".$row_RSCat["cat_img"]."' width='60' class='picborder'>";  
				} else {
				echo "<img src='../../images/chatlines/nopic.jpg' width='30' class='picborder'>";  
				}
				?>
				<br class="clearfix">
        <div id="addchatline" class="addchatlineform">
          <form name="photo" enctype="multipart/form-data" action="<?php echo $_SERVER["../PHP_SELF"];?>" method="post">
            <label>Name<span class="small">Name of the chatline</span></label>
            <input name="Name" type="text" id="Name" value="<?php echo $row_RSCat["cat_name"]; ?>" size="30">
            <div class="clearfix"></div>
            <label>Title<span class="small">Meta title (page)</span></label>
            <input name="Title" type="text" id="Title" size="100" value="<?php echo $row_RSCat["cat_title"]; ?>">
            <div class="clearfix"></div>
            <label>Keywords<span class="small">Meta keywords (page)</span></label>
            <input name="Keywords" type="text" id="Keywords" size="200" value="<?php echo $row_RSCat["cat_keywords"]; ?>">
            <div class="clearfix"></div>
            <label>Description<span class="small">Meta description (page)</span></label>
            <input name="Description" type="text" id="Description" size="200" value="<?php echo $row_RSCat["cat_mdesc"]; ?>">
            <div class="clearfix"></div>
            <label>Country<span class="small">Country for category</span></label>
            <select name="Country">
            <?php do {?>
              <option value="<?php echo $row_RSCountries["tbl_id"]; ?>"<?php if ($row_RSCat["cat_country"] == $row_RSCountries["tbl_id"]) { echo "selected"; } ?>><?php echo $row_RSCountries["country_name"]; ?></option>
            <?php } while ($row_RSCountries = mysql_fetch_assoc($RSCountries)); ?>
            </select>
            <div class="clearfix"></div>
            <label>Picture<span class="small">Chatline picture</span></label>
            <input type="file" name="image2" size="30">
            <div class="clearfix"></div>
            <input name="tbl_id" type="hidden" value="<?php echo $row_RSCat["tbl_id"]; ?>">
            <input name="OldPic" type="hidden" value="<?php echo $row_RSCat["cat_img"]; ?>">
            <input name="upload" type="hidden" value="Upload">
          <button type="submit" onClick="MM_validateForm('Name','','R');return document.MM_returnValue">UPDATE</button> or <button type="button" onClick="location.href='index.php'">CANCEL</button>
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
mysql_free_result($RSCat);
?>