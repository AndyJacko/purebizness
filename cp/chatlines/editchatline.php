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

$query_RSChatline = "SELECT * FROM tbl_purebiz_chatlines WHERE tbl_id=".$_GET["tbl_id"];
$RSChatline = mysql_query($query_RSChatline, $Wisdom_Mcr) or die(mysql_error());
$row_RSChatline = mysql_fetch_assoc($RSChatline);
$totalRows_RSChatline = mysql_num_rows($RSChatline);

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
  $updateSQL = "UPDATE tbl_purebiz_chatlines SET cl_name='".$_POST["Name"]."',cl_num='".$_POST["Number"]."',cl_cat=".$_POST["Category"].",cl_desc='".$_POST["Description"]."',cl_comp='".$_POST["Compliance"]."',cl_type=".$_POST["Type"].",cl_operator=".$_POST["Operator"];
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
		$updateSQL = $updateSQL.",cl_pic='".$usrCode2.".jpg'";
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

  header(sprintf("Location: index.php?s=3"));
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
        <h1>Edit Chatline</h1>
        <br><br>
        <p>Change the chatline details as required then click "<strong>UPDATE</strong>" to save the details.<br>
        <em>Note: Max image filesize is 1mb</em>.  </p>
        <br><br>
        <?php if (isset($error)) { echo "<span class='msg'>".$error."</span>"; }?>
				<?php
        if ($row_RSChatline["cl_pic"] != "") {
        echo "<img src='../../images/chatlines/".$row_RSChatline["cl_pic"]."' width='50' class='picborder'>";  
        } else {
        echo "<img src='../../images/chatlines/nopic.jpg' width='50' class='picborder'>";  
        }
        ?>
        <div class="clearfix"></div>
        <div id="addchatline" class="addchatlineform">
          <form name="photo" enctype="multipart/form-data" action="" method="post">
            <label>Name<span class="small">Name of the chatline</span></label>
            <input name="Name" type="text" id="Name" value="<?php echo $row_RSChatline["cl_name"]; ?>" size="30">
            <div class="clearfix"></div>
            <label>Number<span class="small">Number of the chatline</span></label>
            <input name="Number" type="text" id="Number" value="<?php echo $row_RSChatline["cl_num"]; ?>" size="30">
            <div class="clearfix"></div>
            <label>Picture<span class="small">Chatline picture</span></label>
            <input type="file" name="image2" size="30">
            <div class="clearfix"></div>
            <label>Category<span class="small">Chatline category</span></label>
            <select name="Category">
            <?php do {?>
              <option value="<?php echo $row_RSCats["tbl_id"]; ?>" <?php if ($row_RSChatline["cl_cat"] == $row_RSCats["tbl_id"]) { echo "selected"; } ?>>(<?php echo getcountryname($row_RSCats["cat_country"]); ?>) <?php echo $row_RSCats["cat_name"]; ?></option>
            <?php } while ($row_RSCats = mysql_fetch_assoc($RSCats)); ?>
            </select>
            <div class="clearfix"></div>
            <label>Operator<span class="small">Chatline operator</span></label>
            <select name="Operator">
              <?php do {?>
              <option value="<?php echo $row_RSOperators["tbl_id"]; ?>" <?php if ($row_RSChatline["cl_operator"] == $row_RSOperators["tbl_id"]) { echo "selected"; } ?>><?php echo $row_RSOperators["op_name"]; ?></option>
              <?php } while ($row_RSOperators = mysql_fetch_assoc($RSOperators)); ?>
            </select>
            <div class="clearfix"></div>
            <label>Type<span class="small">Chatline type</span></label>
            <select name="Type">
              <option value="1" <?php if ($row_RSChatline["cl_type"] == 1) { echo "selected"; } ?>>Live</option>
              <option value="2" <?php if ($row_RSChatline["cl_type"] == 2) { echo "selected"; } ?>>Recorded</option>
            </select>
            <div class="clearfix"></div>
            <label>Compliance<span class="small">Compliance specific to this #</span></label>
            <select name="Compliance">
            <?php do {?>
              <option value="<?php echo $row_RSCompliance["tbl_id"]; ?>" <?php if ($row_RSCompliance["tbl_id"] == $row_RSChatline["cl_comp"]) { echo "selected"; } ?>><?php echo $row_RSCompliance["comp_name"]; ?> - <?php echo $row_RSCompliance["comp_currency"]; ?><?php echo $row_RSCompliance["comp_cost"]; ?></option>
            <?php } while ($row_RSCompliance = mysql_fetch_assoc($RSCompliance)); ?>
            </select>
            <div class="clearfix"></div>
            <label>Description<span class="small">Description of the chatline</span></label>
            <textarea name="Description" cols="30" rows="4"><?php echo $row_RSChatline["cl_desc"]; ?></textarea>
            <div class="clearfix"></div>
            <input name="upload" type="hidden" value="Upload">
            <input name="tbl_id" type="hidden" value="<?php echo $row_RSChatline["tbl_id"]; ?>">
            <input name="OldPic" type="hidden" value="<?php echo $row_RSChatline["cl_pic"]; ?>">
          <button type="submit" onClick="MM_validateForm('Name','','R','Number','','R');return document.MM_returnValue">UPDATE</button> or <button type="button" onClick="location.href='index.php'">CANCEL</button>
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
mysql_free_result($RSChatline);
mysql_free_result($RSCats);
?>