function httpAddVideo() {
	var nameInput = document.getElementById("name").value;
	console.log(nameInput);
	
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
			//var resultParsed = JSON.parse(http.responseText);	//save results
			document.getElementById("videoList").innerText = http.responseText;
		}
	}
	http.open("GET", "http://localhost/myhost-exemple/cs290-ass4-p2/newtrial/database.php?action=addVideo&name=" + nameInput, true);
	http.send();
}



