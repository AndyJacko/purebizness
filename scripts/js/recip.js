function checkrecip(recippy,page){
  if (window.XMLHttpRequest) {
	  xmlhttp=new XMLHttpRequest();
  } else {
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var popo=xmlhttp.responseText;
			if (popo != 1) {
				document.getElementById('listingbox'+page).className = "listingbox norecip";
			}
		}
  }
  xmlhttp.open("GET","/scripts/cp/functions/checkrecip.php?u="+recippy,false);
  xmlhttp.send();
}

function checkrecip2(recippy,page){
  if (window.XMLHttpRequest) {
	  xmlhttp=new XMLHttpRequest();
  } else {
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var popo=xmlhttp.responseText;
			if (popo != 1) {
				document.getElementById('listingbox'+page).className = "listingbox norecip";
			} else {
				document.getElementById('listingbox'+page).className = "hideme";
			}
		}
  }
  xmlhttp.open("GET","/scripts/cp/functions/checkrecip.php?u="+recippy,false);
  xmlhttp.send();
}

function override(page,status) {
	//alert(page+" "+status);
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById('listingbox'+page).className = "hideme";
		}
  }
  xmlhttp.open("GET","override.php?tbl_id="+page+"&s="+status,true);
  xmlhttp.send();
}

function override2(page,status) {
	//alert(page+" "+status);
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById('listingbox'+page).className = "hideme";
		}
  }
  xmlhttp.open("GET","directories/override.php?tbl_id="+page+"&s="+status,true);
  xmlhttp.send();
}
