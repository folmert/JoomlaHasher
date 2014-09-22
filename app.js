document.addEventListener("DOMContentLoaded", function() {
	
	var input = document.querySelectorAll(".input");
	var btn = document.querySelectorAll(".btn");
	var output = document.querySelectorAll(".output");
	var form = document.querySelectorAll("form");

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 ) {
			if(xmlhttp.status == 200){
				var response = xmlhttp.responseText;

				output[0].value = response;
				output[0].focus();
				output[0].select();

				console.log(response);

			}
			else if(xmlhttp.status == 400) {
				alert('There was an error 400');
			}
			else {
				alert('something else other than 200 was returned');
			}
		}
	}

	var formSubmit = function(e) {
		e.preventDefault();

		var inputVal = input[0].value;
		var postData = "input="+inputVal;

		xmlhttp.open("POST", "hash.php", true);
		xmlhttp.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" );
		xmlhttp.send(postData);

	}

	form[0].addEventListener("submit", formSubmit, false);
});