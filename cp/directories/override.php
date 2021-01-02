<?php require("../../scripts/db/connection.php"); ?>
<?php require("../../scripts/cp/authnlogout.php"); ?>
<?php
if ($_GET["s"] == 0) {
  $updateSQL = "UPDATE tbl_purebiz_listings SET list_override=1, list_active=1 WHERE tbl_id=".$_GET["tbl_id"];
  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  $Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());
  echo "overriden";
} else {
  $updateSQL = "UPDATE tbl_purebiz_listings SET list_override=0 WHERE tbl_id=".$_GET["tbl_id"];
  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  $Result1 = mysql_query($updateSQL, $Wisdom_Mcr) or die(mysql_error());
  echo "normal";
}
?>