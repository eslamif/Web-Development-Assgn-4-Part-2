
<!---------------- JAVASCRIPT FUNCTION DEFINITIONS ---------------->
function displayVideoList() {
	var videoList = httpRequest();					//obtain video listing from server
	document.getElementByID("videoList").innerHTML="TESTING";
	
}

function httpRequest() {
	var http;
	if(window.XMLHttpRequest) {					//Browsers other than internet explorer
		http = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {				//internet explore browser
		http = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	if(!http) {
		throw 'Unable to create HttpRequest.';
	}	

	http.onreadystatechange = function() {
		if(http.readyState == 4) {
			var resultParsed = JSON.parse(http.responseText);	//save results
		}
	}
	http.open("GET", "URL HERE", true);
	http.send();

	return resultParsed;
}

