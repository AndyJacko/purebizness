<br><br>
<div class='navheader'>SEARCH</div>
<div id="searchbox">
  <form name="searchy" id="searchy" action="/search.php" method="get">
    <div id="srchinput"><input name="search" type="text" placeholder=" Search All Directories" value="<?php echo $_GET["search"]; ?>"></div>
    <div id="srchbtton"><button onClick="return checksearch();">&gt;&gt;</button></div>
    <div id="srchtrms">&nbsp;&nbsp;&nbsp;Search: <input name="s" type="radio" value="1" <?php if($_GET["s"] == 1) { echo "checked"; } if (!isset($_GET["s"])) { echo "checked"; } ?>>&nbsp;Phrase&nbsp;&nbsp;<input name="s" type="radio" value="2" <?php if($_GET["s"] == 2) { echo "checked"; } ?>>&nbsp;Words</div>
  </form>
</div>
<div class='navheader'>TWITTER FEED</div>
<div class="twitfeed">
  <a class="twitter-timeline" width="188" height="300" href="https://twitter.com/Purebizness" data-widget-id="350203948805804032">Tweets by @Purebizness</a>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
<div class='navheader'>INTERNATIONAL CHATLINES</div>
<div id="intnums">
  <div class="aCentre smallTxt">Calls connect to random straight story.</div>
  <div class="aCentre sidenum"><img src="/images/chatlines/intnums/1.jpg" width="50" height="20" class="picborder aMiddle">&nbsp;&nbsp;+44758 906 6550</div>
  <div class="aCentre sidenum"><img src="/images/chatlines/intnums/2.jpg" width="50" height="20" class="picborder aMiddle">&nbsp;&nbsp;+44758 906 6551</div>
  <div class="aCentre sidenum"><img src="/images/chatlines/intnums/3.jpg" width="50" height="20" class="picborder aMiddle">&nbsp;&nbsp;+44758 906 6552</div>
  <div class="aCentre sidenum"><img src="/images/chatlines/intnums/4.jpg" width="50" height="20" class="picborder aMiddle">&nbsp;&nbsp;+44758 906 6553</div>
  <div class="aCentre smallTxt">Call from your own country, calls charged at your usual international call rate.</div>
</div>
<br>
