function getVideoList() {
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
			var jsonStr = http.responseText;
			displayVideoList(jsonStr);			//call w/ JSON string
		}
	}
	http.open("GET", "http://localhost/myhost-exemple/cs290-ass4-p2/newtrial/database.php?action=getVideo", true);
	http.send();
}


function displayVideoList(jsonStr) {
	var jsonObj = JSON.parse(jsonStr);			//convert JSON string to JSON object
	document.getElementById("testing").innerText = jsonObj.name;
	
	for(var key in jsonObj) {
		console.log(key + " = " + jsonObj[key]);
	}
	

}




function httpAddVideo() {
	var nameInput = document.getElementById("name").value;
	
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
			document.getElementById("videoList").innerText = http.responseText + ' was added to the database.';
		}
	}
	http.open("GET", "http://localhost/myhost-exemple/cs290-ass4-p2/newtrial/database.php?action=addVideo&name=" + nameInput, true);
	http.send();
}



