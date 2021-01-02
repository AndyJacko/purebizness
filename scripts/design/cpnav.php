<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSCountries = "SELECT * FROM tbl_purebiz_cl_countries ORDER BY country_name ASC";
$RSCountries = mysql_query($query_RSCountries, $Wisdom_Mcr) or die(mysql_error());
$row_RSCountries = mysql_fetch_assoc($RSCountries);
$totalRows_RSCountries = mysql_num_rows($RSCountries);
?>
<div id="jQ-menu">
  <div class="no1header">&nbsp;</div>
  <div class="navheader">CONTROLPANEL</div>
  <ul>
    <li><a href="<?php echo $logoutAction; ?>"><b>LOGOUT</b></a></li>
    <li><a href="/cp/cpmain.php"><b>CP MAIN</b></a></li>
  </ul>
  <div class="navheader">DIRECTORIES</div>
  <ul>
    <li><a href="/cp/directories/newcat.php"><b>NEW CATEGORY</b></a></li>
    <li><a href="/cp/directories/newsub.php"><b>NEW SUB-CATEGORY</b></a></li>
    <li><hr color="#CCC"></li>
    <?php echo getdirectoriescp(); ?>
    <li><hr color="#CCC"></li>
    <li><a href="/adultdirectories/addyourlisting.php"><b>ADD LISTING</b></a></li>
    <li><hr color="#CCC"></li>
    <li><a href="/cp/directories/directoryall.php"><b>All LISTINGS</b></a></li>
    <li><a href="/cp/directories/directoryall.php?o=sponsored"><b>SPONSORED LISTINGS</b></a></li>
    <li><a href="/cp/directories/directoryall.php?o=flagged"><b>FLAGGED LISTINGS</b></a></li>
    <li><a href="/cp/directories/directoryall.php?o=inactive"><b>INACTIVE LISTINGS</b></a></li>
    <li><hr color="#CCC"></li>
    <li><a href="/cp/directories/recipall.php"><b>ALL RECIPS</b></a></li>
    <li><a href="/cp/directories/recipall.php?o=override"><b>OVERRIDDEN RECIPS</b></a></li>
    <li><a href="/cp/directories/recipall.php?o=flagged"><b>FLAGGED RECIPS</b></a></li>
    <li><a href="/cp/directories/recipall.php?o=failed"><b>FAILED RECIPS</b></a></li>
  </ul>
  <div class="navheader">CHATLINES</div>
  <ul>
    <li><span class='toggle'><strong>SELECT COUNTRY</strong></span>
      <ul>
			<?php do { ?>
        <li><a href="/cp/chatlines/?tbl_id=<?php echo $row_RSCountries["tbl_id"]; ?>"><b><?php echo strtoupper($row_RSCountries["country_name"]); ?></b></a></li>
      <?php } while ($row_RSCountries = mysql_fetch_assoc($RSCountries)); ?>
      </ul>
    </li>
    <li><hr color="#CCC"></li>
    <li><a href="/cp/chatlines/addchatline.php"><b>ADD CHATLINE</b></a></li>
    <li><a href="/cp/chatlines/addcategory.php"><b>ADD CATEGORY</b></a></li>
    <li><a href="/cp/chatlines/addcountry.php"><b>ADD COUNTRY</b></a></li>
    <li><hr color="#CCC"></li>
    <li><a href="/cp/chatlines/compliancetext.php"><b>COMPLIANCE TEXT</b></a></li>
    <li><a href="/cp/chatlines/compliancecost.php"><b>COMPLIANCE COST</b></a></li>
  </ul>
</div>
<?php 
mysql_free_result($RSCountries);
?>