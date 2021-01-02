<?php session_start(); ?>
<?php
unset($_SESSION['MM_Username']);
unset($_SESSION['MM_Password']);
header("Location: /adultdirectories/login.php?s=3");
?>