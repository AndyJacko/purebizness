<?php require("scripts/db/connection.php"); ?>
<?php require("scripts/functions/nav/navfunctions.php"); ?>
<?php require("scripts/functions/homepage/homefunctions.php"); ?>
<?php session_start(); ?>
<?php
mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSHPSubs = "SELECT * FROM tbl_purebiz_dir_scats ORDER BY sub_cat ASC";
$RSHPSubs = mysql_query($query_RSHPSubs, $Wisdom_Mcr) or die(mysql_error());
$row_RSHPSubs = mysql_fetch_assoc($RSHPSubs);
$totalRows_RSHPSubs = mysql_num_rows($RSHPSubs);

mysql_select_db($database_Wisdom_Mcr, $Wisdom_Mcr);
$query_RSLatest = "SELECT * FROM tbl_purebiz_listings WHERE list_active=1 ORDER BY tbl_id DESC LIMIT 10";
$RSLatest = mysql_query($query_RSLatest, $Wisdom_Mcr) or die(mysql_error());
$row_RSLatest = mysql_fetch_assoc($RSLatest);
$totalRows_RSLatest = mysql_num_rows($RSLatest);
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/usersideGeneric.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Adult Directory | Massage Parlours | Independant Escorts | Web Cams | Transvestites</title>
<!-- InstanceEndEditable -->
<link href="/scripts/css/purebizness.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/scripts/js/gallery/jquery-1.6.1.min.js"></script> 
<script type="text/javascript" src="/scripts/js/purebizness.js"></script> 
<script type="text/javascript" src="/scripts/js/nav/jquery.color.js"></script> 
<script type="text/javascript" src="/scripts/js/nav/jMenu.js"></script>
<!-- InstanceBeginEditable name="head" -->
<meta name="description" content="Adult Directory for punters looking to find Massage Parlours, Saunas, Escort Agency, Escorts, BBW, Strip Clubs, Dating, Galleries, Adult Toys, Webcams, Phone Sex, Chat Lines, Fetish Agency, Overseas, Transexual, Pornstars, Amateurs, Classifieds, Reviews, Swingers, Models etc...">
<meta name="keywords" content="Massage Parlours, Saunas, Escort Agencies, Independent Escorts, BBW, Strip Clubs, Dating, Galleries, Adult Toys, Webcams, Chat Lines, Fetish Agency, Overseas, Transexual, Pornstars, Amateurs, Classifieds, Reviews, Swingers, Models,Adult Dating,Gay,Straight,Masseurs,Services,Models,Fetish,Busty,Dominant,Mistresses,lesbian,BBW,BDSM,Anal,Agencies,Independant Males,Fetish,Parlor,Web Cams,Webcams,Web Cam,Credit Card,Lapdancers,Strip Club,Strippers,Lap Dance,Topless Bars,Showgirls,Table Dancing">
<meta name="Location" content="United Kingdom">
<meta name="Language" content="English" />
<meta name="google-site-verification" content="7AItRVhJEDmihcVawEU7fNZaM-x7yR5fjRk6l-_TQsM">
<!-- InstanceEndEditable -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33275085-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</head>

<body>
  <header id="header"><?php include('scripts/design/header.php'); ?></header>
  <section id="pagebody">
    <div id="content" class="column">
      <div id="actualcontent">
      <!-- InstanceBeginEditable name="content" -->
      <strong><i><u>Adult Directory</u></i></strong>  for punters looking to find Massage Parlours, Saunas, Escort Agency, Escorts, BBW, Strip Clubs, Dating, Galleries, Adult Toys, Webcams, Phone Sex, Chat Lines, Fetish Agency, Overseas, Transexual, Pornstars, Amateurs, Classifieds, Reviews, Swingers, Models etc... If you are easily offended by adult material within this or any sites linked to our directory please click <a href="http://www.google.com"><b>[here]</b></a>
      <br><br>
      <a href="http://www.titanpokerroom.co.uk/" target="_blank"><img src="/images/adbanners/onlinepoker.jpg" alt="Online Texas Hold Em Poker"></a>
      <br><br>
      <strong>(#) = Listings in Directory.&nbsp;&nbsp;<img src="/images/directories/foldericons/redfolder.png" align="absmiddle"> = Updated today.&nbsp;&nbsp;<img src="/images/directories/foldericons/greenfolder.png" align="absmiddle"> = Updated in last 3 days.&nbsp;&nbsp;<img src="/images/directories/foldericons/bluefolder.png" align="absmiddle"> = Updated in last 7 days.</strong>
      <br><br>
      <div class="indexdircontainer">
				<?php	do { ?>
          <div class="directorybox"><div class="foldericon"><?php echo getupdated($row_RSHPSubs["tbl_id"]); ?></div><div class='dirdescription'><a href="/adultdirectories/<?php echo getlink($row_RSHPSubs["tbl_id"]); ?>/" class="dirtext"><?php echo getdirectory($row_RSHPSubs["sub_cat"]); ?></a><br><a href="/adultdirectories/<?php echo getlink($row_RSHPSubs["tbl_id"]); ?>/" class="subtext"><?php echo $row_RSHPSubs["sub_disp_name"]; ?></a> (<?php echo getlistings($row_RSHPSubs["tbl_id"]); ?>)</div></div>
        <?php } while ($row_RSHPSubs = mysql_fetch_assoc($RSHPSubs));	?>
      </div>
      <strong>(#) = Listings in Directory.&nbsp;&nbsp;<img src="/images/directories/foldericons/redfolder.png" align="absmiddle"> = Updated today.&nbsp;&nbsp;<img src="/images/directories/foldericons/greenfolder.png" align="absmiddle"> = Updated in last 3 days.&nbsp;&nbsp;<img src="/images/directories/foldericons/bluefolder.png" align="absmiddle"> = Updated in last 7 days.</strong>
      <br><br>
      <?php if ($totalRows_RSLatest > 0) { ?>
      <div class="aLeft">
        <h2>Latest Directory Additions</h2>
        <br>
        <?php
				$i = 1;
        do {
          echo "<strong><div class='pinkTxt iBlock'>$i.&nbsp;&nbsp;&nbsp;<a href='/adultdirectories/viewdetails.php?p=".$row_RSLatest["tbl_id"]."&name=".strtolower($row_RSLatest["list_name"])."'>".strtoupper($row_RSLatest["list_name"])."</a></div>&nbsp;&nbsp;&nbsp;<div class='smallTxt iBlock'>Added: (".$row_RSLatest["list_date"].")&nbsp;&nbsp;&nbsp;To Directory: <a href='/adultdirectories/".getlink($row_RSLatest["list_sub"])."/'>".ucwords(getlink2($row_RSLatest["list_sub"]))."</a></div></strong><br>".$row_RSLatest["list_desc"]." <a href='/adultdirectories/viewdetails.php?p=".$row_RSLatest["tbl_id"]."&d=".getlink($row_RSLatest["list_sub"])."'>more...</a><br><br>";
					$i = $i + 1;
        } while ($row_RSLatest = mysql_fetch_assoc($RSLatest));
        ?>
      </div>
      <?php } ?>
      <div class="phonesex"><a href="http://www.hornystories.co.uk" title="Phone Sex">Phone Sex</a></div>
      <!-- InstanceEndEditable -->
      </div>
    </div>
    <nav id="sitenav" class="column"><?php require("scripts/design/nav.php"); ?></nav>
    <section id="rhs" class="column"><?php require("scripts/design/ads.php"); ?></section>
    <br class="clearfix">
  </section>
  <footer id="footer"><?php require("scripts/design/footer.php"); ?></footer>
</body>
<!-- InstanceEnd --></html>
<?php 
mysql_free_result($RSLatest);
mysql_free_result($RSHPSubs);
?>