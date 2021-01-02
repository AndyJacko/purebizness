<?php require_once('../../scripts/db/connection.php'); ?>
<?php require_once('../../scripts/cp/getvalstring.php'); ?>
<?php require_once('../../scripts/cp/authnlogout.php'); ?>
<?php require_once("../../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSChatline = "SELECT * FROM tbl_purebiz_chatlines WHERE tbl_id =".$_GET["tbl_id"];
$RSChatline = mysql_query($query_RSChatline, $Wisdom_Mcr) or die(mysql_error());
$row_RSChatline = mysql_fetch_assoc($RSChatline);
$totalRows_RSChatline = mysql_num_rows($RSChatline);

if ($row_RSChatline["cl_pic"] != "") {
  unlink("../../images/chatlines/".$row_RSChatline["cl_pic"]);
}
$delSQL = sprintf("DELETE FROM tbl_purebiz_chatlines WHERE tbl_id=".$_GET["tbl_id"]);
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$Result1 = mysql_query($delSQL, $Wisdom_Mcr) or die(mysql_error());

mysql_free_result($RSChatline);
header("Location: index.php?s=2");
?>