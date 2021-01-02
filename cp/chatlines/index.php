<?php require_once('../../scripts/db/connection.php'); ?>
<?php require_once('../../scripts/cp/getvalstring.php'); ?>
<?php require_once('../../scripts/cp/authnlogout.php'); ?>
<?php require_once("../../scripts/functions/chatlines/chatlinefunctions.php"); ?>
<?php require_once("../../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
if (isset($_GET["tbl_id"])) {
	$_SESSION["clcountry"] = $_GET["tbl_id"];
	$_SESSION["ChatCats"] = "";
}

mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSCats = "SELECT * FROM tbl_purebiz_clcats WHERE cat_country = ".$_SESSION["clcountry"]." ORDER BY cat_name ASC";
$RSCats = mysql_query($query_RSCats, $Wisdom_Mcr) or die(mysql_error());
$row_RSCats = mysql_fetch_assoc($RSCats);
$totalRows_RSCats = mysql_num_rows($RSCats);
$popo = 0;

if ($_POST["ChatCats"] != "" || $_SESSION["ChatCats"] != "") {
  if ($_POST["ChatCats"] != "") { $_SESSION["ChatCats"] = $_POST["ChatCats"]; }	
  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  $query_RSChat = "SELECT * FROM tbl_purebiz_chatlines WHERE cl_cat = ".$_SESSION["ChatCats"];
  $RSChat = mysql_query($query_RSChat, $Wisdom_Mcr) or die(mysql_error());
  $row_RSChat = mysql_fetch_assoc($RSChat);
  $totalRows_RSChat = mysql_num_rows($RSChat);
  if ($totalRows_RSChat > 0) { $popo = 0; } else { $popo=1; }
  
  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  $query_RSCatName = "SELECT * FROM tbl_purebiz_clcats WHERE cat_country = ".$_SESSION["clcountry"]." AND tbl_id = ".$_SESSION["ChatCats"];
  $RSCatName = mysql_query($query_RSCatName, $Wisdom_Mcr) or die(mysql_error());
  $row_RSCatName = mysql_fetch_assoc($RSCatName);
  $totalRows_RSCatName = mysql_num_rows($RSCatName);
  $thename = $row_RSCatName["cat_name"];
  mysql_free_result($RSCatName);
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
        <h1><?php echo getcountryname($_SESSION["clcountry"]); ?> Chatlines Manager</h1>
        <br><br>
        <p>Select a category to view chatlines, click "<strong>ADD NEW CATEGORY</strong>" to create a new category or<br>click "<strong>ADD NEW CHATLINE</strong>" to add a new chatline.
        <br><br>Click <span class='editicon'></span> to edit the chatline or <span class='deleteicon'></span> to delete it.
      <br>
      <br>To edit the category details click "<strong>EDIT THIS CATEGORY</strong>", or click "<strong>DELETE CATEGORY</strong>" to remove.</p>
        <br><br>
        <?php if ($_GET["s"] == 1) { echo "<p class='msg'>Chatline Added.</p><br><br>"; } ?>
        <?php if ($_GET["s"] == 2) { echo "<p class='msg'>Chatline Deleted.</p><br><br>"; } ?>
        <?php if ($_GET["s"] == 3) { echo "<p class='msg'>Chatline Edited.</p><br><br>"; } ?>
        <?php if ($_GET["s"] == 4) { echo "<p class='msg'>Category Added.</p><br><br>"; } ?>
        <?php if ($_GET["s"] == 5) { echo "<p class='msg'>Category Edited.</p><br><br>"; } ?>
        <?php if ($_GET["s"] == 6) { echo "<p class='msg'>Category Deleted.</p><br><br>"; } ?>
        <div id="chatmanager" class="chatmanagerform">
          <a href="addcategory.php">ADD NEW CATEGORY</a> | <a href="addchatline.php">ADD NEW CHATLINE</a><br><br>
          <?php if ($totalRows_RSCats > 0) { ?>
            <form action="" method="post">
            <select name="ChatCats" onChange="submit();">
            <option>Select A Category</option>
            <option>----------------------------</option>
            <?php do {?>
              <option value="<?php echo $row_RSCats["tbl_id"]; ?>"<?php if ($_SESSION["ChatCats"] == $row_RSCats["tbl_id"]) { echo "selected"; } ?>><?php echo $row_RSCats["cat_name"]; ?></option>
            <?php } while ($row_RSCats = mysql_fetch_assoc($RSCats)); ?>
            </select>
            </form>
            <?php if ($_SESSION["ChatCats"] != "") { ?>
            <a href="editcategory.php?tbl_id=<?php echo $_SESSION["ChatCats"]; ?>"><br>EDIT THIS CATEGORY</a> | <a href="deletecategory.php?tbl_id=<?php echo $_SESSION["ChatCats"]; ?>" onClick="return delCat();">DELETE CATEGORY</a><br>
            <?php } ?>
        <?php } else { echo "No chatline categories to display."; } ?>
          <?php if ($popo == 0) { ?>
        <?php if ($totalRows_RSChat > 0) { ?>
            <?php do { ?>
            <div class="roombox">
              <div class="roompic"><img src="/images/chatlines/<?php if ($row_RSChat["cl_pic"] != "") { echo $row_RSChat["cl_pic"]; } else { echo "noPic.jpg"; } ?>" class="picBorder"></div>
              <div class="roomdesc">
                <div class="roomname"><h2><?php echo $row_RSChat["cl_name"]; ?><br><?php echo $row_RSChat["cl_num"]; ?></h2></div>
                <div class="roomoptions"><a href="editchatline.php?tbl_id=<?php echo $row_RSChat["tbl_id"]; ?>"><span class='editicon'></span></a><br><a href="deletechatline.php?tbl_id=<?php echo $row_RSChat["tbl_id"]; ?>" onClick="return delChatline();"><span class='deleteicon'></span></a></div>
                <br><br>
                <?php echo "<br>".getcompcost($row_RSChat["cl_comp"])." per min"; ?>
                <?php 
								switch ($row_RSChat["cl_operator"]) {
									case 1:
									  echo "<br>Opera";
										break;									
									case 2:
									  echo "<br>Digital Select";
										break;									
									case 3:
									  echo "<br>SKY Telecom";
										break;									
									case 4:
									  echo "<br>Mediatel";
										break;									
								} 
								?>
                <?php if ($row_RSChat["cl_type"] == 1) { echo "<br><img src='/images/chatlines/live.png'>"; } else { echo "<br><img src='/images/chatlines/rec.png'>"; } ?>
              </div>
            </div>
            <?php } while ($row_RSChat = mysql_fetch_assoc($RSChat)); ?>
            <?php } ?>
        <?php } else { echo "<br>No chatlines in this category."; } ?>
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
if ($_POST["ChatCats"] != "") {
  mysql_free_result($RSChat);
}
mysql_free_result($RSCats);
?>