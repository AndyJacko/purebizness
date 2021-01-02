<?php
function getcompcost($clnum) {
  $con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
  $RSComp = mysql_query("SELECT * FROM tbl_purebiz_compliance WHERE tbl_id=".$clnum);
  $row_RRSComp = mysql_fetch_assoc($RSComp);
  $totalRows_RSComp = mysql_num_rows($RSComp);
  mysql_free_result($RSComp);
  
  return $row_RRSComp["comp_currency"].$row_RRSComp["comp_cost"];
}

function getcountryname($country) {
  $con = mysql_connect("dbHost","dbUser","dbPass");
  mysql_select_db("db", $con);
  $RSComp = mysql_query("SELECT * FROM tbl_purebiz_cl_countries WHERE tbl_id=".$country);
  $row_RRSComp = mysql_fetch_assoc($RSComp);
  $totalRows_RSComp = mysql_num_rows($RSComp);
  mysql_free_result($RSComp);
  
  return $row_RRSComp["country_name"];
}
?>