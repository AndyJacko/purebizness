<div id="jQ-menu">
<div class="no1header">&nbsp;</div>
<?php if (!isset($_SESSION["MM_Username"])) { ?>
  <div class="navheader">LISTING LOGIN</div>
  <div class="navlogin">
    <form action="/adultdirectories/login.php" method="post">
      <label>Listing Name</label>
      <input type="text" name="Name" id="Name">
      <label>Password</label>
      <input type="password" name="Password" id="Password">
      <button type="submit" onClick="return validateloginform();">LOGIN</button>
    </form>
  </div>
<?php } else { ?>
  <div class="navheader">LISTING OPTIONS</div>
  <ul>
    <li><a href="/adultdirectories/editmyprofile.php"><strong>EDIT LISTING</strong></a></li>
    <li><a href="/adultdirectories/editpassword.php"><strong>EDIT PASSWORD</strong></a></li>
    <li><a href="/scripts/functions/editprofile/logout.php"><strong>LOGOUT</strong></a></li>
  </ul>
<?php } ?>
<div class="navheader">DIRECTORIES</div>
  <?php echo getdirectories(); ?>
<div class="navheader">ADULT RELATED</div>
  <ul>
    <li><a href="/chat_lines/adult-chat-lines.php"><strong>CHAT LINES</strong></a></li>
    <li><a href="/webcams.php"><strong>LIVE WEBCAMS</strong></a></li>
    <li><a href="/dating.php"><strong>ADULT DATING</strong></a></li>
    <li><a href="/galleries.php"><strong>ADULT GALLERIES</strong></a></li>
  </ul>
<div class="navheader">PUREBIZNESS</div>
  <ul>
    <li><a href="/contact_us.php"><strong>CONTACT US</strong></a></li>
  </ul>
</div>
<div class="navheader">SHARE</div>
<div class="addthis_toolbox addthis_default_style shares">
  <a class="addthis_button_preferred_1"></a>
  <a class="addthis_button_preferred_2"></a>
  <a class="addthis_button_preferred_3"></a>
  <a class="addthis_button_preferred_4"></a>
  <a class="addthis_button_preferred_5"></a>
  <a class="addthis_button_preferred_6"></a>
  <a class="addthis_button_compact"></a>
  <a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e39153d01a90834"></script>
