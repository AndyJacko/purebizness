<?php require("../scripts/db/connection.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSProfile = "SELECT * FROM tbl_purebiz_listings WHERE tbl_id =".$_SESSION['id'];
$RSProfile = mysql_query($query_RSProfile, $Wisdom_Mcr) or die(mysql_error());
$row_RSProfile = mysql_fetch_assoc($RSProfile);
$totalRows_RSProfile = mysql_num_rows($RSProfile);

unlink("../adultdirectories/".$_SESSION["dir"]."/".$_SESSION["sub"]."/".$_SESSION["pname"]."/m/".$row_RSProfile[$_GET["pic"]]);
unlink("../adultdirectories/".$_SESSION["dir"]."/".$_SESSION["sub"]."/".$_SESSION["pname"]."/t/".$row_RSProfile[$_GET["pic"]]);

$updateSQL = "UPDATE tbl_purebiz_listings SET ".$_GET["pic"]."= '' WHERE tbl_id=".$row_RSProfile["tbl_id"];
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());

mysql_free_result($RSProfile);
header("Location: editmyprofile.php?s=1");
?>