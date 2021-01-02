<?php require("../scripts/db/connection.php"); ?>
<?php require("../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
if (isset($_GET["pic"])) {
	$_SESSION["pic"] = $_GET["pic"];
}
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSProfile = "SELECT * FROM tbl_purebiz_listings WHERE tbl_id =".$_SESSION['id'];
$RSProfile = mysql_query($query_RSProfile, $Wisdom_Mcr) or die(mysql_error());
$row_RSProfile = mysql_fetch_assoc($RSProfile);
$totalRows_RSProfile = mysql_num_rows($RSProfile);
?>
<?php
//Constants
//You can alter these options
if (isset($_SESSION["tmpimgname"])) {
  $tmpimgname = $_SESSION["tmpimgname"];	
} else {  
  $tmpimgname = mt_rand() ."". mt_rand();
	$_SESSION["tmpimgname"] = $tmpimgname;
}
$upload_dir = "../images"; 		// The directory for the images to be saved in
$upload_path = $upload_dir."/";				// The path to where the image will be saved
$large_image_name = $tmpimgname."resized_pic.jpg"; 		// New name of the large image
$thumb_image_name = $tmpimgname."thumbnail_pic.jpg"; 	// New name of the thumbnail image
$max_file = "1048576"; 					          // Approx 1MB
$max_width = "500";						    // Max width allowed for the large image
$thumb_width = "100";						// Width of thumbnail image
$thumb_height = "100";						// Height of thumbnail image
//Image functions
//You do not need to alter these functions
function resizeImage($image,$width,$height,$scale) {
  $newImageWidth = ceil($width * $scale);
  $newImageHeight = ceil($height * $scale);
  $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
  $source = imagecreatefromjpeg($image);
  imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
  imagejpeg($newImage,$image,90);
  chmod($image, 0777);
  return $image;
}
//You do not need to alter these functions
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
  $newImageWidth = ceil($width * $scale);
  $newImageHeight = ceil($height * $scale);
  $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
  $source = imagecreatefromjpeg($image);
  imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
  imagejpeg($newImage,$thumb_image_name,90);
  chmod($thumb_image_name, 0777);
  return $thumb_image_name;
}
//You do not need to alter these functions
function getHeight($image) {
  $sizes = getimagesize($image);
  $height = $sizes[1];
  return $height;
}
//You do not need to alter these functions
function getWidth($image) {
  $sizes = getimagesize($image);
  $width = $sizes[0];
  return $width;
}
//Image Locations
$large_image_location = $upload_path.$large_image_name;
$thumb_image_location = $upload_path.$thumb_image_name;
//Create the upload directory with the right permissions if it doesn't exist
if(!is_dir($upload_dir)){
  mkdir($upload_dir, 0777);
  chmod($upload_dir, 0777);
}
//Check to see if any images with the same names already exist
if (file_exists($large_image_location)){
  if(file_exists($thumb_image_location)){
	$thumb_photo_exists = "<img src=\"".$upload_path.$thumb_image_name."\" alt=\"Thumbnail Image\"/>";
  }else{
	$thumb_photo_exists = "";
  }
  $large_photo_exists = "<img src=\"".$upload_path.$large_image_name."\" alt=\"Large Image\"/>";
} else {
  $large_photo_exists = "";
  $thumb_photo_exists = "";
}

if (isset($_POST["upload"])) { 
  //Get the file information
  $userfile_name = $_FILES['image']['name'];
  $userfile_tmp = $_FILES['image']['tmp_name'];
  $userfile_size = $_FILES['image']['size'];
  $userfile_width = getWidth($userfile_tmp);
  $filename = basename($_FILES['image']['name']);
  $file_ext = substr($filename, strrpos($filename, '.') + 1);
  //Only process if the file is a JPG and below the allowed limit
  if((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {
	if (($file_ext!="jpg") || ($userfile_size > $max_file) || $userfile_width > 1000) {
	  $error= "ONLY jpeg images under 1000px width and under 1MB are accepted for upload<br>";
	}
  }else{
		unset($_SESSION["tmpimgname"]);
	$error= "Please select a picture.<br>";
  }
  //Everything is ok, so we can upload the image.
  if (strlen($error)==0){
	if (isset($_FILES['image']['name'])){
	  move_uploaded_file($userfile_tmp, $large_image_location);
	  chmod($large_image_location, 0777);
	  
	  $width = getWidth($large_image_location);
	  $height = getHeight($large_image_location);
	  //Scale the image if it is greater than the width set above
	  if ($width > $max_width){
		$scale = $max_width/$width;
		$uploaded = resizeImage($large_image_location,$width,$height,$scale);
	  }else{
		$scale = 1;
		$uploaded = resizeImage($large_image_location,$width,$height,$scale);
	  }
	  //Delete the thumbnail file so the user can create a new one
	  if (file_exists($thumb_image_location)) {
		unlink($thumb_image_location);
	  }
	}
    $_SESSION["popo"] = 2;
	//Refresh the page to show the new uploaded image
	header("location:".$_SERVER["PHP_SELF"]);
	exit();
  }
}

if (isset($_POST["upload_thumbnail"]) && strlen($large_photo_exists)>0) {
  //Get the new coordinates to crop the image.
  $x1 = $_POST["x1"];
  $y1 = $_POST["y1"];
  $x2 = $_POST["x2"];
  $y2 = $_POST["y2"];
  $w = $_POST["w"];
  $h = $_POST["h"];
  //Scale the image to the thumb_width set above
  $scale = $thumb_width/$w;
  $cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
  //Reload the page again to view the thumbnail
  header("location:".$_SERVER["PHP_SELF"]);
  exit();
}

if(strlen($large_photo_exists)>0 && strlen($thumb_photo_exists)>0){
	$usrCode = mt_rand() ."". mt_rand();
  $file = "../images/".$_SESSION["tmpimgname"]."resized_pic.jpg";
  $newfile = $_SESSION["dir"]."/".$_SESSION["sub"]."/".$_SESSION["pname"]."/m/".$usrCode.".jpg";
  
  if (!copy($file, $newfile)) {
	  echo "failed to copy $file...\n";
  }
  $file = "../images/".$_SESSION["tmpimgname"]."thumbnail_pic.jpg";
  $newfile = $_SESSION["dir"]."/".$_SESSION["sub"]."/".$_SESSION["pname"]."/t/".$usrCode.".jpg";
  
  if (!copy($file, $newfile)) {
	  echo "failed to copy $file...\n";
  }
  unlink("../images/".$_SESSION["tmpimgname"]."resized_pic.jpg");
  unlink("../images/".$_SESSION["tmpimgname"]."thumbnail_pic.jpg");
  
  $updateSQL = "UPDATE tbl_purebiz_listings SET ".$_SESSION["pic"]."='".$usrCode.".jpg"."' WHERE tbl_id=".$_SESSION["id"];

  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  $Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());
	
  unset($_SESSION['popo']);
	unset($_SESSION["tmpimgname"]);

  header("location: addmorepix.php");
}
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/usersideGeneric.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Edit Photo</title>
<!-- InstanceEndEditable -->
<link href="/scripts/css/purebizness.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/scripts/js/gallery/jquery-1.6.1.min.js"></script> 
<script type="text/javascript" src="/scripts/js/purebizness.js"></script> 
<script type="text/javascript" src="/scripts/js/nav/jquery.color.js"></script> 
<script type="text/javascript" src="/scripts/js/nav/jMenu.js"></script>
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript" src="/scripts/js/thumb/jquery-pack.js"></script>
<script type="text/javascript" src="/scripts/js/thumb/jquery.imgareaselect-0.3.min.js"></script>
<!-- InstanceEndEditable -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33275085-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</head>

<body>
  <header id="header"><?php include('../scripts/design/header.php'); ?></header>
  <section id="pagebody">
    <div id="content" class="column">
      <div id="actualcontent">
      <!-- InstanceBeginEditable name="content" -->
      <h1>Edit Photo</h1>
      <br><br>
      <p>Select a new photo then click &quot;<strong>ADD PHOTO</strong>&quot;&nbsp;to save changes.<br>
      <em>Note: Max image size is 1000px width and will be resized automatically to 500px width - Max image filesize is 1mb</em>.<br>
      Click and drag on your uploaded image to create your thumbnail. Preview of thumbnail will be shown, when happy click "SAVE THUMBNAIL"<br><br>
      To get help creating the correct size image, go <a href="http://www.picresize.com/" target="_blank">here</a>.</p>
      <br><br>
      <?php
      //Only display the javacript if an image has been uploaded
      if(strlen($large_photo_exists)>0){
      $current_large_image_width = getWidth($large_image_location);
      $current_large_image_height = getHeight($large_image_location);?>
      <script type="text/javascript">
      function preview(img, selection) { 
      var scaleX = <?php echo $thumb_width;?> / selection.width; 
      var scaleY = <?php echo $thumb_height;?> / selection.height; 
      $('#thumbnail + div > img').css({ 
        width: Math.round(scaleX * <?php echo $current_large_image_width;?>) + 'px', 
        height: Math.round(scaleY * <?php echo $current_large_image_height;?>) + 'px',
        marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
        marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
      });
      $('#x1').val(selection.x1);
      $('#y1').val(selection.y1);
      $('#x2').val(selection.x2);
      $('#y2').val(selection.y2);
      $('#w').val(selection.width);
      $('#h').val(selection.height);
      } 
      $(document).ready(function () { 
        $('#save_thumb').click(function() {
        var x1 = $('#x1').val();
        var y1 = $('#y1').val();
        var x2 = $('#x2').val();
        var y2 = $('#y2').val();
        var w = $('#w').val();
        var h = $('#h').val();
        if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
          alert("You must make a selection first");
          return false;
        }else{
          return true;
        }
        });
      }); 
      $(window).load(function () { 
        $('#thumbnail').imgAreaSelect({ aspectRatio: '1:1', onSelectChange: preview }); 
      });
      </script>
      <?php }?>
      <?php
      //Display error message if there are any
      if(strlen($error)>0){
        echo "<p class='msg'><strong>Error!</strong><br>".$error."</p>";
      }
      if(strlen($large_photo_exists)>0 && strlen($thumb_photo_exists)>0){
        echo "";
      }else{
      if(strlen($large_photo_exists)>0){?>
        <div id="addpic" class="addpicform">
        <h2>Create Thumbnail</h2>
        <div align="center">
          <img class="picborder" src="<?php echo $upload_path.$large_image_name;?>" style="float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" />
          <div style="float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
          <img src="<?php echo $upload_path.$large_image_name;?>" style="position: relative;" alt="Thumbnail Preview" />
        </div>
        <br style="clear:both;"/>
        <form name="thumbnail" action="<?php echo $_SERVER["../PHP_SELF"];?>" method="post">
          <input type="hidden" name="x1" value="" id="x1">
          <input type="hidden" name="y1" value="" id="y1">
          <input type="hidden" name="x2" value="" id="x2">
          <input type="hidden" name="y2" value="" id="y2">
          <input type="hidden" name="w" value="" id="w">
          <input type="hidden" name="h" value="" id="h">
          <input name="upload_thumbnail" type="hidden" value="Upload">
          <button type="submit">SAVE THUMBNAIL</button>
        </form>
        </div>
      </div>
      <?php } ?>
      <?php if (!isset($_SESSION["popo"])) { ?>
          <div id="addpic" class="addpicform">
            <form name="photo" enctype="multipart/form-data" action="<?php echo $_SERVER["../PHP_SELF"];?>" method="post">
              <?php if ($row_RSProfile[$_SESSION["pic"]] != "") { ?>
              <img src='/adultdirectories/<?php echo $_SESSION["dir"]."/".$_SESSION["sub"]."/".$_SESSION["pname"]."/t/".$row_RSProfile[$_SESSION["pic"]]; ?>' width='100' class='picborder corners'><br>
              <?php } else { ?>
              <img src='/images/nopic.jpg' width='100' class='picborder corners'><br>
              <?php } ?>
              <label>Photo<span class="small">Photo & thumbnail</span></label>
              <input type="file" name="image" size="30">
              <div class="clearfix"></div>
              <input name="upload" type="hidden" value="Upload">
            <button type="submit">ADD PHOTO</button> or <button type="button" onClick="history.go(-1)">CANCEL</button>
            </form>
          </div>
      <?php } ?>
      <?php } ?>
      <!-- InstanceEndEditable -->
      </div>
    </div>
    <nav id="sitenav" class="column"><?php require("../scripts/design/nav.php"); ?></nav>
    <section id="rhs" class="column"><?php require("../scripts/design/ads.php"); ?></section>
    <br class="clearfix">
  </section>
  <footer id="footer"><?php require("../scripts/design/footer.php"); ?></footer>
</body>
<!-- InstanceEnd --></html>
<?php 
mysql_free_result($RSProfile);
?>