<?php require("../../db/connection.php"); ?>
<?php require("../functions/directoryfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSProfile = "SELECT * FROM tbl_purebiz_listings WHERE tbl_id =".$_GET['id'];
$RSProfile = mysql_query($query_RSProfile, $Wisdom_Mcr) or die(mysql_error());
$row_RSProfile = mysql_fetch_assoc($RSProfile);
$totalRows_RSProfile = mysql_num_rows($RSProfile);

$durl = getdirectoryurl($row_RSProfile["list_sub"]);

//if(file_exists("../../../adultdirectories/".$durl."/".$row_RSProfile["list_title"]."/m/".$row_RSProfile[$_GET["pic"]])){
  //echo "path ok";
//} else {
  //echo "path wrong";
//}
unlink("../../../adultdirectories/".$durl."/".$row_RSProfile["list_title"]."/m/".$row_RSProfile[$_GET["pic"]]);
unlink("../../../adultdirectories/".$durl."/".$row_RSProfile["list_title"]."/t/".$row_RSProfile[$_GET["pic"]]);

$updateSQL = "UPDATE tbl_purebiz_listings SET ".$_GET["pic"]."= '' WHERE tbl_id=".$row_RSProfile["tbl_id"];
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());

mysql_free_result($RSProfile);
header("Location: /cp/directories/edit.php?s=1&tbl_id=".$row_RSProfile["tbl_id"]);
?>