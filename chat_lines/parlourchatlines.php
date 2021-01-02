<?php require("../scripts/db/connection.php"); ?>
<?php require("../scripts/functions/chatlines/chatlinefunctions.php"); ?>
<?php require("../scripts/functions/nav/navfunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSCats = "SELECT * FROM tbl_purebiz_clcats WHERE cat_country = 1 ORDER BY cat_name ASC";
$RSCats = mysql_query($query_RSCats, $Wisdom_Mcr) or die(mysql_error());
$row_RSCats = mysql_fetch_assoc($RSCats);
$totalRows_RSCats = mysql_num_rows($RSCats);

mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSComp = "SELECT * FROM tbl_purebiz_comp_text WHERE tbl_id =1";
$RSComp = mysql_query($query_RSComp, $Wisdom_Mcr) or die(mysql_error());
$row_RSComp = mysql_fetch_assoc($RSComp);
$totalRows_RSComp = mysql_num_rows($RSComp);

if (isset($_GET["tbl_id"])) {
  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  $query_RSChat = "SELECT * FROM tbl_purebiz_chatlines WHERE cl_cat = ".$_GET["tbl_id"];
  $RSChat = mysql_query($query_RSChat, $Wisdom_Mcr) or die(mysql_error());
  $row_RSChat = mysql_fetch_assoc($RSChat);
  $totalRows_RSChat = mysql_num_rows($RSChat);
  
  mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
  $query_RSCatName = "SELECT * FROM tbl_purebiz_clcats WHERE cat_country = 1 AND tbl_id = ".$_GET["tbl_id"];
  $RSCatName = mysql_query($query_RSCatName, $Wisdom_Mcr) or die(mysql_error());
  $row_RSCatName = mysql_fetch_assoc($RSCatName);
  $totalRows_RSCatName = mysql_num_rows($RSCatName);
  $thename = $row_RSCatName["cat_name"];
  mysql_free_result($RSCatName);
}
?>
<div style="background-color:#000">
<link href="/scripts/css/chatlines.css" rel="stylesheet" type="text/css">
      <div id="actualcontent">
<?php if ($totalRows_RSCats > 0) {?>
        <div class="clcats">
		      <?php do { ?>
            <a href="?tbl_id=<?php echo $row_RSCats["tbl_id"]; ?>"><strong><?php echo $row_RSCats["cat_name"]; ?></strong></a>&nbsp;&nbsp;
          <?php } while ($row_RSCats = mysql_fetch_assoc($RSCats)); ?>
        </div>
        <?php } ?>
		    <?php
        if (isset($_GET["tbl_id"])) {
          echo "<br><h1>$thename Chatlines</h1><br>";  
          if ($totalRows_RSChat > 0) {
            do {	  
        ?>	 
        <div class="actualchatline">
          <div class="actualchatlineimg">  
            <img src="/images/chatlines/<?php if ($row_RSChat["cl_pic"] != "") { echo $row_RSChat["cl_pic"]; } else { echo "noPic.jpg"; } ?>" alt="Phone Sex On Adult Chat Lines">
          </div>
          <div class="actualchatlineinfo">
            <div class="chatlinename"><?php echo $row_RSChat["cl_name"]; ?></div>
            <div><?php echo nl2br($row_RSChat["cl_desc"]); ?></div>
            <div class="chatlinenumber"><?php echo $row_RSChat["cl_num"]; ?></div>
            <div class="chatlinecomp">Calls cost <?php echo getcompcost($row_RSChat["cl_comp"]); ?> per min plus network extras.</div>
            <div class="chatlinetype"><?php if ($row_RSChat["cl_type"] == 1) { echo "<img src='/images/chatlines/live.png'>"; } else { echo "<img src='/images/chatlines/rec.png'>"; } ?></div>
          </div>
        </div>
        <?php   
            } while ($row_RSChat = mysql_fetch_assoc($RSChat));
          } else {
            echo "<p><font size='3'><b>There are no chatlines in this section yet, but check back soon because they are CUMMING.</b></font></p><br><br>";
          }
        } else {
        ?>
        <br><h1>Select A Category</h1><br>
        <div class="chatvideo">
          <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="460" height="380">
            <param name="movie" value="http://api.firestormmedia.tv/aff_stream/flash/player.swf?affid=5000065&amp;type=1&amp;clickable=0" />
            <param name="quality" value="high" />
            <param name="wmode" value="opaque" />
            <param name="swfversion" value="6.0.65.0" />
            <param name="allowFullScreen" value="true">
            <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
            <param name="expressinstall" value="/scripts/livestream/expressInstall.swf" />
            <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
            <!--[if !IE]>-->
            <object type="application/x-shockwave-flash" data="http://api.firestormmedia.tv/aff_stream/flash/player.swf?affid=5000065&amp;type=1&amp;clickable=0" width="460" height="380">
              <!--<![endif]-->
              <param name="quality" value="high" />
              <param name="wmode" value="opaque" />
              <param name="swfversion" value="6.0.65.0" />
              <param name="allowFullScreen" value="true">
              <param name="expressinstall" value="/scripts/livestream/expressInstall.swf" />
              <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
              <div>
                <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
                <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
              </div>
              <!--[if !IE]>-->
            </object>
            <!--<![endif]-->
          </object>
        </div>
        <?php } ?>
        <br><br>
        <p class="chatlinecomp"><?php echo $row_RSComp["comp_text"]; ?></p>
      </div>
      </div>
<?php 
if ($_GET["tbl_id"] != "") {
  mysql_free_result($RSChat);
}
mysql_free_result($RSComp);
mysql_free_result($RSCats);
?>