<?php require_once('../../scripts/db/connection.php'); ?>
<?php require_once('../../scripts/cp/getvalstring.php'); ?>
<?php require_once('../../scripts/cp/authnlogout.php'); ?>
<?php require_once("../../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSCat = "SELECT * FROM tbl_purebiz_clcats WHERE tbl_id =".$_GET["tbl_id"];
$RSCat = mysql_query($query_RSCat, $Wisdom_Mcr) or die(mysql_error());
$row_RSCat = mysql_fetch_assoc($RSCat);
$totalRows_RSCat = mysql_num_rows($RSCat);

mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSChatlines = "SELECT * FROM tbl_purebiz_chatlines WHERE cl_cat =".$_GET["tbl_id"];
$RSChatlines = mysql_query($query_RSChatlines, $Wisdom_Mcr) or die(mysql_error());
$row_RSChatlines = mysql_fetch_assoc($RSChatlines);
$totalRows_RSChatlines = mysql_num_rows($RSChatlines);

if ($totalRows_RSChatlines > 0) {
  do {
	unlink("../../images/chatlines/".$row_RSChatlines["cl_pic"]);
  } while ($row_RSChatlines = mysql_fetch_assoc($RSChatlines));
}

unlink("../../images/chatlines/".$row_RSCat["cat_img"]);

$delSQL = "DELETE FROM tbl_purebiz_chatlines WHERE cl_cat =".$_GET["tbl_id"];
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$Result1 = mysql_query($delSQL, $Wisdom_Mcr) or die(mysql_error());

$delSQL = "DELETE FROM tbl_purebiz_clcats WHERE tbl_id=".$_GET["tbl_id"];
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$Result1 = mysql_query($delSQL, $Wisdom_Mcr) or die(mysql_error());

mysql_free_result($RSCat);
mysql_free_result($RSChatlines);
header("Location: index.php?s=6");
?>