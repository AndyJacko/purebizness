<?php require("../../db/connection.php"); ?>

<?php
function isBanned($name) {
  $con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
	
  $RSBanned = mysql_query("SELECT list_name FROM tbl_purebiz_listings WHERE list_name=$name");
  $row_RSBanned = mysql_fetch_assoc($RSBanned);
  $totalRows_RSBanned = mysql_num_rows($RSBanned);

	mysql_free_result($RSBanned);
}
?>