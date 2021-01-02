<?php
if (isset($_GET["u"])) {
	$mydomain = "purebizness.net"; 
	$c = curl_init();
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_URL, $_GET["u"]);
	$contents = curl_exec($c);
	curl_close($c);
	
	if ($contents) { if (strpos ($contents, $mydomain) != false) {	echo 1;	} else { echo 0; } }	else { echo 0; }
} else { echo 0; }
?>