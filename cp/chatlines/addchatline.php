<?php require_once('../../scripts/db/connection.php'); ?>
<?php require_once('../../scripts/cp/getvalstring.php'); ?>
<?php require_once('../../scripts/cp/authnlogout.php'); ?>
<?php require_once("../../scripts/functions/chatlines/chatlinefunctions.php"); ?>
<?php require_once("../../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSCats = "SELECT * FROM tbl_purebiz_clcats ORDER BY cat_country,cat_name ASC";
$RSCats = mysql_query($query_RSCats, $Wisdom_Mcr) or die(mysql_error());
$row_RSCats = mysql_fetch_assoc($RSCats);
$totalRows_RSCats = mysql_num_rows($RSCats);

$query_RSOperators = "SELECT * FROM tbl_purebiz_operators";
$RSOperators = mysql_query($query_RSOperators, $Wisdom_Mcr) or die(mysql_error());
$row_RSOperators = mysql_fetch_assoc($RSOperators);
$totalRows_RSOperators = mysql_num_rows($RSOperators);

$query_RSCompliance = "SELECT * FROM tbl_purebiz_compliance";
$RSCompliance = mysql_query($query_RSCompliance, $Wisdom_Mcr) or die(mysql_error());
$row_RSCompliance = mysql_fetch_assoc($RSCompliance);
$totalRows_RSCompliance = mysql_num_rows($RSCompliance);

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
	$insertSQL = sprintf("INSERT INTO tbl_purebiz_chatlines (cl_name,cl_cat,cl_pic,cl_desc,cl_num,cl_comp,cl_type,cl_operator) VALUES ('".$_POST["Name"]."',".$_POST["Category"].",'".$usrCode2.".jpg','".$_POST["Description"]."','".$_POST["Number"]."','".$_POST["Compliance"]."',".$_POST["Type"].",".$_POST["Operator"].")");
	mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
	$Result1 = mysql_query($insertSQL, $Wisdom_Mcr) or die(mysql_error());
    $_SESSION["ChatCats"] = $_POST["Category"];
    $_SESSION["CallType"] = $_POST["Type"];
    $_SESSION["Operator"] = $_POST["Operator"];
    $_SESSION["Compliance"] = $_POST["Compliance"];
	header(sprintf("Location: index.php?s=1"));
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
        <h1>Add New Chatline</h1>
        <br><br>
        <p>Complete the form below with the chatline details then click "<strong>ADD CHATLINE</strong>" to save the details.<br>
        <em>Note: Max image filesize is 1mb</em>.  </p>
        <br><br>
        <?php if (isset($error)) { echo "<span class='msg'>".$error."</span>"; }?>
        <div id="addchatline" class="addchatlineform">
          <form name="photo" enctype="multipart/form-data" action="<?php echo $_SERVER["../PHP_SELF"];?>" method="post">
            <label>Name<span class="small">Name of the chatline</span></label>
            <input name="Name" type="text" id="Name" size="30">
            <div class="clearfix"></div>
            <label>Number<span class="small">Number of the chatline</span></label>
            <input name="Number" type="text" id="Number" size="30">
            <div class="clearfix"></div>
            <label>Picture<span class="small">Chatline picture</span></label>
            <input type="file" name="image2" size="30">
            <div class="clearfix"></div>
            <label>Operator<span class="small">Chatline operator</span></label>
            <select name="Operator">
              <?php do {?>
              <option value="<?php echo $row_RSOperators["tbl_id"]; ?>" <?php if ($_SESSION["Operator"] == $row_RSOperators["tbl_id"]) { echo "selected"; } ?>><?php echo $row_RSOperators["op_name"]; ?></option>
              <?php } while ($row_RSOperators = mysql_fetch_assoc($RSOperators)); ?>
            </select>
            <div class="clearfix"></div>
            <label>Category<span class="small">Chatline category</span></label>
            <select name="Category">
            <?php do {?>
              <option value="<?php echo $row_RSCats["tbl_id"]; ?>" <?php if ($_SESSION["ChatCats"] == $row_RSCats["tbl_id"]) { echo "selected"; } ?>>(<?php echo getcountryname($row_RSCats["cat_country"]); ?>) <?php echo $row_RSCats["cat_name"]; ?></option>
            <?php } while ($row_RSCats = mysql_fetch_assoc($RSCats)); ?>
            </select>
            <div class="clearfix"></div>
            <label>Type<span class="small">Chatline type</span></label>
            <select name="Type">
              <option value="1" <?php if ($_SESSION["CallType"] == 1) { echo "selected"; } ?>>Live</option>
              <option value="2" <?php if ($_SESSION["CallType"] == 2) { echo "selected"; } ?>>Recorded</option>
            </select>
            <div class="clearfix"></div>
            <label>Compliance<span class="small">Compliance specific to this #</span></label>
            <select name="Compliance">
            <?php do {?>
              <option value="<?php echo $row_RSCompliance["tbl_id"]; ?>" <?php if ($_SESSION["Compliance"] == $row_RSCompliance["tbl_id"]) { echo "selected"; } ?>><?php echo $row_RSCompliance["comp_currency"]; ?><?php echo $row_RSCompliance["comp_cost"]; ?></option>
            <?php } while ($row_RSCompliance = mysql_fetch_assoc($RSCompliance)); ?>
            </select>
            <div class="clearfix"></div>
            <label>Description<span class="small">Description of the chatline</span></label>
            <textarea name="Description" cols="30" rows="10"></textarea>
            <div class="clearfix"></div>
            <input name="upload" type="hidden" value="Upload">
          <button type="submit" onClick="MM_validateForm('Name','','R','Number','','R');return document.MM_returnValue">ADD CHATLINE</button> or <button type="button" onClick="location.href='index.php'">CANCEL</button>
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
mysql_free_result($RSCompliance);
mysql_free_result($RSOperators);
mysql_free_result($RSCats);
?>