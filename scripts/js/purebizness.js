function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}

function checkcats() {
	var x=document.getElementById("Cat").options[document.getElementById("Cat").selectedIndex].value;
	if (x != "" && x != "Select...") {
		document.Cats.submit();
	} else {
		document.getElementById("Cat").selectedIndex=0;
	}
}

function checksubs() {
	err = "";
	var x=document.getElementById("Sub").options[document.getElementById("Sub").selectedIndex].value;
	if (x == "" || x == "Select...") {
		document.getElementById("Sub").selectedIndex=0;
		err = err + "You need to select a sub category.\n"
	}
	if (document.getElementById("recaptcha_response_field").value == "") {
		err = err + "reCaptcha is required.\n"
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function checksearch() {
	err = "";
	if (document.searchy.search.value == "") {
		err = "You need to enter something to search for.\n";
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}
function validatecontactform() {
	err = "";
	if (document.getElementById('Name').value == "") {
		err = "You need to enter your name.\n";
	}
	if (document.getElementById('Email').value == "") {
		err = err + "You need to enter your email address.\n";
	} else {
		var x=document.getElementById('Email').value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			err = err + "You need to enter a valid e-mail address.\n";
		}
	}
	var x=document.getElementById("How").options[document.getElementById("How").selectedIndex].value;
	if (x == "" || x == "PLEASE SELECT" || x == "MISCELLANEOUS" || x == "SEARCH ENGINE" || x == "======================================================") {
		err = err + "You need to select how you heard about us.\n";
		document.getElementById("How").selectedIndex=0;
	}	
	if (document.getElementById('Message').value == "") {
		err = err + "You need to enter a comment.\n";
	}
	if (document.getElementById("recaptcha_response_field").value == "") {
		err = err + "reCaptcha is required.\n"
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}
function validatesendemailform() {
	err = "";
	if (document.getElementById('Name').value == "") {
		err = "You need to enter your name.\n";
	}
	if (document.getElementById('Email').value == "") {
		err = err + "You need to enter your email address.\n";
	} else {
		var x=document.getElementById('Email').value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			err = err + "You need to enter a valid e-mail address.\n";
		}
	}
	if (document.getElementById('Message').value == "") {
		err = err + "You need to enter a comment.\n";
	}
	if (document.getElementById("recaptcha_response_field").value == "") {
		err = err + "reCaptcha is required.\n"
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function delAddPic() {
  var r=confirm("Delete this photo?");
  if (r==true) {
	  return true;
  } else {
	  return false;
  }
}

function valaddbusinessform() {
	err = "";
	thename = document.getElementById('Name').value;
	if (thename == "") {
		err = err + "You need to enter your business name.\n";
	} else {
		var recippy=document.getElementById('Recip').value;
		if (window.XMLHttpRequest) {
		  xmlhttp=new XMLHttpRequest();
		} else {
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("GET","/scripts/functions/addprofile/checkuser.php?u="+thename,false);
		xmlhttp.send();
		if (xmlhttp.responseText == 1) {
			err = err + "This name has already been taken.\n";
		}
	}
	if (document.getElementById('Password').value == "") {
		err = err + "You need to enter a password.\n";
	}
	if (document.getElementById('URL').value == "") {
		err = err + "You need to enter your URL.\n";
	}
	if (document.getElementById('Recip').value == "") {
		err = err + "You need to enter your reciprocal URL.\n";
	}
	if (document.getElementById('Email').value == "") {
		err = err + "You need to enter your email address.\n";
	} else {
		var x=document.getElementById('Email').value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			err = err + "You need to enter a valid e-mail address.\n";
		}
	}
	if (document.getElementById('Phone').value == "") {
		err = err + "You need to enter your phone number.\n";
	}
	if (document.getElementById('Address').value == "") {
		err = err + "You need to enter your address.\n";
	}
	if (document.getElementById('Area').value == "") {
		err = err + "You need to enter your town/city.\n";
	}
	if (document.getElementById('Postcode').value == "") {
		err = err + "You need to enter your postcode.\n";
	}
	if (document.getElementById('Description').value == "") {
		err = err + "You need to enter your description.\n";
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function valeditbusinessform() {
	err = "";
	if (document.getElementById('URL').value == "") {
		err = err + "You need to enter your URL.\n";
	}
	if (document.getElementById('Recip').value == "") {
		err = err + "You need to enter your reciprocal URL.\n";
	} 
	if (document.getElementById('Email').value == "") {
		err = err + "You need to enter your email address.\n";
	} else {
		var x=document.getElementById('Email').value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			err = err + "You need to enter a valid e-mail address.\n";
		}
	}
	if (document.getElementById('Phone').value == "") {
		err = err + "You need to enter your phone number.\n";
	}
	if (document.getElementById('Address').value == "") {
		err = err + "You need to enter your address.\n";
	}
	if (document.getElementById('Area').value == "") {
		err = err + "You need to enter your town/city.\n";
	}
	if (document.getElementById('Postcode').value == "") {
		err = err + "You need to enter your postcode.\n";
	}
	if (document.getElementById('Description').value == "") {
		err = err + "You need to enter your description.\n";
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function valaddescortform() {
	err = "";
	thename = document.getElementById('Name').value;
	if (thename == "") {
		err = err + "You need to enter your name.\n";
	} else {
		var recippy=document.getElementById('Recip').value;
		if (window.XMLHttpRequest) {
		  xmlhttp=new XMLHttpRequest();
		} else {
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("GET","/scripts/functions/addprofile/checkuser.php?u="+thename,false);
		xmlhttp.send();
		if (xmlhttp.responseText == 1) {
			err = err + "This name has already been taken.\n";
		}
	}
	if (document.getElementById('Password').value == "") {
		err = err + "You need to enter your password.\n";
	}
	if (document.getElementById('URL').value == "") {
		err = err + "You need to enter your URL.\n";
	}
	if (document.getElementById('Recip').value == "") {
		err = err + "You need to enter your reciprocal URL.\n";
	}
	if (document.getElementById('Email').value == "") {
		err = err + "You need to enter your email address.\n";
	} else {
		var x=document.getElementById('Email').value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			err = err + "You need to enter a valid e-mail address.\n";
		}
	}
	if (document.getElementById('Phone').value == "") {
		err = err + "You need to enter your phone number.\n";
	}
	if (document.getElementById('Stats').value == "") {
		err = err + "You need to enter your stats.\n";
	}
	if (document.getElementById('Area').value == "") {
		err = err + "You need to enter your area.\n";
	}
	if (document.getElementById('Description').value == "") {
		err = err + "You need to enter your description.\n";
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function valeditescortform() {
	err = "";
	if (document.getElementById('URL').value == "") {
		err = err + "You need to enter your URL.\n";
	}
	if (document.getElementById('Recip').value == "") {
		err = err + "You need to enter your reciprocal URL.\n";
	}
	if (document.getElementById('Email').value == "") {
		err = err + "You need to enter your email address.\n";
	} else {
		var x=document.getElementById('Email').value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			err = err + "You need to enter a valid e-mail address.\n";
		}
	}
	if (document.getElementById('Phone').value == "") {
		err = err + "You need to enter your phone number.\n";
	}
	if (document.getElementById('Stats').value == "") {
		err = err + "You need to enter your stats.\n";
	}
	if (document.getElementById('Area').value == "") {
		err = err + "You need to enter your area.\n";
	}
	if (document.getElementById('Description').value == "") {
		err = err + "You need to enter your description.\n";
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function valaddpersonalform() {
	err = "";
	thename = document.getElementById('Name').value;
	if (thename == "") {
		err = err + "You need to enter your name.\n";
	} else {
		var recippy=document.getElementById('Recip').value;
		if (window.XMLHttpRequest) {
		  xmlhttp=new XMLHttpRequest();
		} else {
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("GET","/scripts/functions/addprofile/checkuser.php?u="+thename,false);
		xmlhttp.send();
		if (xmlhttp.responseText == 1) {
			err = err + "This name has already been taken.\n";
		}
	}
	if (document.getElementById('Password').value == "") {
		err = err + "You need to enter a password.\n";
	}
	if (document.getElementById('URL').value == "") {
		err = err + "You need to enter your URL.\n";
	}
	if (document.getElementById('Recip').value == "") {
		err = err + "You need to enter your reciprocal URL.\n";
	}
	if (document.getElementById('Email').value == "") {
		err = err + "You need to enter your email address.\n";
	} else {
		var x=document.getElementById('Email').value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			err = err + "You need to enter a valid e-mail address.\n";
		}
	}
	if (document.getElementById('Phone').value == "") {
		err = err + "You need to enter your phone number.\n";
	}
	if (document.getElementById('Stats').value == "") {
		err = err + "You need to enter your stats.\n";
	}
	if (document.getElementById('Area').value == "") {
		err = err + "You need to enter your area.\n";
	}
	if (document.getElementById('Description').value == "") {
		err = err + "You need to enter your description.\n";
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function valeditpersonalform() {
	err = "";
	if (document.getElementById('URL').value == "") {
		err = err + "You need to enter your URL.\n";
	}
	if (document.getElementById('Recip').value == "") {
		err = err + "You need to enter your reciprocal URL.\n";
	} //else {
		//var recippy=document.getElementById('Recip').value;
		//if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		//xmlhttp=new XMLHttpRequest();
		//} else {// code for IE6, IE5
		//xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		//}
		//xmlhttp.open("GET","/scripts/functions/addprofile/checkrecip.php?u="+recippy,false);
		//xmlhttp.send();
		//if (xmlhttp.responseText != 1) {
			//err = err + "Reciprocal link not found.\n";
		//}
	//}
	if (document.getElementById('Email').value == "") {
		err = err + "You need to enter your email address.\n";
	} else {
		var x=document.getElementById('Email').value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			err = err + "You need to enter a valid e-mail address.\n";
		}
	}
	if (document.getElementById('Phone').value == "") {
		err = err + "You need to enter your phone number.\n";
	}
	if (document.getElementById('Stats').value == "") {
		err = err + "You need to enter your stats.\n";
	}
	if (document.getElementById('Area').value == "") {
		err = err + "You need to enter your area.\n";
	}
	if (document.getElementById('Description').value == "") {
		err = err + "You need to enter your description.\n";
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function valaddwebsiteform() {
	err = "";
	thename = document.getElementById('Name').value;
	if (thename == "") {
		err = err + "You need to enter your website name.\n";
	} else {
		var recippy=document.getElementById('Recip').value;
		if (window.XMLHttpRequest) {
		  xmlhttp=new XMLHttpRequest();
		} else {
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("GET","/scripts/functions/addprofile/checkuser.php?u="+thename,false);
		xmlhttp.send();
		if (xmlhttp.responseText == 1) {
			err = err + "This name has already been taken.\n";
		}
	}
	if (document.getElementById('Password').value == "") {
		err = err + "You need to enter your password.\n";
	}
	if (document.getElementById('URL').value == "") {
		err = err + "You need to enter your URL.\n";
	}
	if (document.getElementById('Recip').value == "") {
		err = err + "You need to enter your reciprocal URL.\n";
	}
	if (document.getElementById('Email').value == "") {
		err = err + "You need to enter your email address.\n";
	} else {
		var x=document.getElementById('Email').value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			err = err + "You need to enter a valid e-mail address.\n";
		}
	}
	if (document.getElementById('Area').value == "") {
		err = err + "You need to enter your area.\n";
	}
	if (document.getElementById('Description').value == "") {
		err = err + "You need to enter your description.\n";
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function valeditwebsiteform() {
	err = "";
	if (document.getElementById('URL').value == "") {
		err = err + "You need to enter your URL.\n";
	}
	if (document.getElementById('Recip').value == "") {
		err = err + "You need to enter your reciprocal URL.\n";
	}
	if (document.getElementById('Email').value == "") {
		err = err + "You need to enter your email address.\n";
	} else {
		var x=document.getElementById('Email').value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			err = err + "You need to enter a valid e-mail address.\n";
		}
	}
	if (document.getElementById('Area').value == "") {
		err = err + "You need to enter your area.\n";
	}
	if (document.getElementById('Description').value == "") {
		err = err + "You need to enter your description.\n";
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function validateloginform() {
	err = "";
	if (document.getElementById('Name').value == "") {
		err = err + "You need to enter your listing name.\n";
	}
	if (document.getElementById('Password').value == "") {
		err = err + "You need to enter your password.\n";
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function valnewpass() {
	err = "";
	if (document.getElementById('Current').value == "") {
		err = err + "You need to enter your current password.\n";
	}
	if (document.getElementById('New').value == "") {
		err = err + "You need to enter your new password.\n";
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function checkchars(fname, maxnum) { 
	if (document.getElementById(fname).value != "") {
		var numchars = document.getElementById(fname).value;
		var howmanychars = maxnum - numchars.length;
		document.getElementById(fname+'Chars').innerHTML = "Characters<br>Remaining: "+howmanychars;
	} else {
		document.getElementById(fname+'Chars').innerHTML = "Characters<br>Remaining: "+maxnum;
	}
}

function delChatline() {
  var r=confirm("Delete this chatline?");
  if (r==true) {
	return true;
  } else {
	return false;
  }
}
function delCat() {
  var r=confirm("Delete this category?\n\nThis will also delete any chatlines in the category.");
  if (r==true) {
	return true;
  } else {
	return false;
  }
}

function delListing(listing) {
	var reason=prompt("    DELETE LISTING\n\n\n   Type 1 for no recip.\n\n  Type 2 for requested.\n\nType 3 for other reason.\n\n","");
	if (reason!=null && reason!="")	{
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var popo=xmlhttp.responseText;
			if (popo=="deleted") {
				document.getElementById('listingbox'+listing).className = "hideme";	
			}
		}
		}
		xmlhttp.open("GET","delete.php?tbl_id="+listing+"&r="+reason,true);
		xmlhttp.send();
	} else {
		return false;
	}
}

function activ8page(page,status) {
	//alert(page+" "+status);
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
  } else {// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	  var popo=xmlhttp.responseText;
	  if (popo=="activeyicon") {
		document.getElementById('activ8'+page).innerHTML="<span class=activeyicon onClick='activ8page("+page+",1)'></span>";
		document.getElementById('listingbox'+page).className = "listingbox activebg";
	  } else {
		document.getElementById('activ8'+page).innerHTML="<span class=activenicon onClick='activ8page("+page+",0)'></span>";
		document.getElementById('listingbox'+page).className = "listingbox inactivebg";
	  }
	}
  }
  xmlhttp.open("GET","activ8.php?tbl_id="+page+"&s="+status,true);
  xmlhttp.send();
}

function flagpage(page,status) {
	//alert(page+" "+status);
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
  } else {// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	  var popo=xmlhttp.responseText;
	  if (popo=="flagyicon") {
			document.getElementById('flagged'+page).innerHTML="<span class=flagyicon onClick='flagpage("+page+",1)'></span>";
			document.getElementById('activ8'+page).innerHTML="<span class=activenicon onClick='activ8page("+page+",0)'></span>";
			document.getElementById('listingbox'+page).className = "listingbox inactivebg";
	  } else {
			document.getElementById('flagged'+page).innerHTML="<span class=flagnicon onClick='flagpage("+page+",0)'></span>";
			document.getElementById('activ8'+page).innerHTML="<span class=activeyicon onClick='activ8page("+page+",1)'></span>";
			document.getElementById('listingbox'+page).className = "listingbox activebg";
	  }
	}
  }
  xmlhttp.open("GET","flagged.php?tbl_id="+page+"&s="+status,true);
  xmlhttp.send();
}

function emailpage(page) {
	//alert(page+" "+status);
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
  } else {// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	  var popo=xmlhttp.responseText;
	  if (popo=="emailyicon") {
			document.getElementById('emailed'+page).innerHTML="<span class=emailyicon onClick='emailpage("+page+")'></span>";
			document.getElementById('flagged'+page).innerHTML="<span class=flagyicon onClick='flagpage("+page+",1)'></span>";
			document.getElementById('listingbox'+page).className = "listingbox inactivebg";
			document.getElementById('activ8'+page).innerHTML="<span class=activenicon onClick='activ8page("+page+",0)'></span>";
	  }
	}
  }
  xmlhttp.open("GET","emailnonrecip.php?tbl_id="+page,true);
  xmlhttp.send();
}

function showLegend() {
	if (document.getElementById("iconlegend").className == "show") {
		document.getElementById("iconlegend").className = "hide"
	} else {
	  document.getElementById("iconlegend").className = "show";
	}
}

function delListing2(listing) {
	var reason=prompt("    DELETE LISTING\n\n\n   Type 1 for no recip.\n\n  Type 2 for requested.\n\nType 3 for other reason.\n\n","");
	if (reason!=null && reason!="")	{
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var popo=xmlhttp.responseText;
			if (popo=="deleted") {
				document.getElementById('listingbox'+listing).className = "hideme";	
			}
		}
		}
		xmlhttp.open("GET","directories/delete.php?tbl_id="+listing+"&r="+reason,true);
		xmlhttp.send();
	} else {
		return false;
	}
}

function activ8page2(page,status) {
	//alert(page+" "+status);
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
  } else {// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	  var popo=xmlhttp.responseText;
	  if (popo=="activeyicon") {
		document.getElementById('activ8'+page).innerHTML="<span class=activeyicon onClick='activ8page2("+page+",1)'></span>";
		document.getElementById('listingbox'+page).className = "listingbox activebg";
	  } else {
		document.getElementById('activ8'+page).innerHTML="<span class=activenicon onClick='activ8page2("+page+",0)'></span>";
		document.getElementById('listingbox'+page).className = "listingbox inactivebg";
	  }
	}
  }
  xmlhttp.open("GET","directories/activ8.php?tbl_id="+page+"&s="+status,true);
  xmlhttp.send();
}

function flagpage2(page,status) {
	//alert(page+" "+status);
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
  } else {// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	  var popo=xmlhttp.responseText;
	  if (popo=="flagyicon") {
			document.getElementById('flagged'+page).innerHTML="<span class=flagyicon onClick='flagpage2("+page+",1)'></span>";
			document.getElementById('activ8'+page).innerHTML="<span class=activenicon onClick='activ8page2("+page+",0)'></span>";
			document.getElementById('listingbox'+page).className = "listingbox inactivebg";
	  } else {
			document.getElementById('flagged'+page).innerHTML="<span class=flagnicon onClick='flagpage2("+page+",0)'></span>";
			document.getElementById('activ8'+page).innerHTML="<span class=activeyicon onClick='activ8page2("+page+",1)'></span>";
			document.getElementById('listingbox'+page).className = "listingbox activebg";
	  }
	}
  }
  xmlhttp.open("GET","directories/flagged.php?tbl_id="+page+"&s="+status,true);
  xmlhttp.send();
}

function emailpage2(page) {
	//alert(page+" "+status);
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
  } else {// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	  var popo=xmlhttp.responseText;
	  if (popo=="emailyicon") {
			document.getElementById('emailed'+page).innerHTML="<span class=emailyicon onClick='emailpage2("+page+")'></span>";
			document.getElementById('flagged'+page).innerHTML="<span class=flagyicon onClick='flagpage2("+page+",1)'></span>";
			document.getElementById('listingbox'+page).className = "listingbox inactivebg";
			document.getElementById('activ8'+page).innerHTML="<span class=activenicon onClick='activ8page2("+page+",0)'></span>";
	  }
	}
  }
  xmlhttp.open("GET","directories/emailnonrecip.php?tbl_id="+page,true);
  xmlhttp.send();
}

function showLegend() {
	if (document.getElementById("iconlegend").className == "show") {
		document.getElementById("iconlegend").className = "hide"
	} else {
	  document.getElementById("iconlegend").className = "show";
	}
}

function validateforgotpassform() {
	err = "";
	if (document.getElementById('Name').value == "") {
		err = "You need to enter your listing name.\n";
	}
	if (err != ""){
		alert ('The following error(s) occurred:\n\n' + err);
		return false;
	}else {
		return true;
	}
}

function sendpassword(tbl_id) {
  var r=confirm("Send Password?");
  if (r==true) {
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		} else {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var popo=xmlhttp.responseText;
			if (popo=="sent") {
				document.getElementById('pw'+tbl_id).innerHTML=document.getElementById('pw'+tbl_id).innerHTML+" > sent...";
        //alert ("Sent");
			}
		}
		}
		xmlhttp.open("GET","/cp/directories/forgotpassword.php?ID="+tbl_id,true);
		xmlhttp.send();
  } else {
	  return false;
  }
}





