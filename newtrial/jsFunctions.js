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
	
	for(var i = 0; i < jsonObj.length; i++) {
		var name = jsonObj[i][0];
		var category = jsonObj[i][1];
		var length = jsonObj[i][2];
		var status = jsonObj[i][3];
		
		var tr = document.createElement("tr");
		document.getElementById('nextRow').appendChild(tr);
		
		var td = document.createElement("td");
		td.innerText = name;
		tr.appendChild(td);
			
		var td = document.createElement("td");
		td.innerText = category;
		tr.appendChild(td);
		
		var td = document.createElement("td");
		td.innerText = length;
		tr.appendChild(td);
		
		var td = document.createElement("td");
		td.innerText = status;
		tr.appendChild(td);		
	}		
}


function httpAddVideo() {
	var name = document.getElementById("name").value;
	var category = document.getElementById("category").value;
	var length = document.getElementById("length").value;
	
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
			//Do nothing client side
		}
	}
	http.open("GET", "http://localhost/myhost-exemple/cs290-ass4-p2/newtrial/database.php?action=addVideo&name=" + name + "&category=" + category + "&length=" + length, true);
	http.send();
	
	window.location.reload();
}


function deleteAllVideos() {
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
			//Do nothing client side
		}
	}
	http.open("GET", "http://localhost/myhost-exemple/cs290-ass4-p2/newtrial/database.php?action=deleteAll", true);
	http.send();
	
	window.location.reload();	
}

