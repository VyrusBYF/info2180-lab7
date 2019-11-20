window.onload = function (){
	
	var findCountry = document.getElementById("lookup").addEventListener("click",birthPlace);
	var findCity = document.getElementById("city").addEventListener("click",City);

	function birthPlace() {

		var input = document.getElementById("country").value;

		//Value is formatted to ensure the request is completed as long as the country is correctly spelled
		var country = input.charAt(0).toUpperCase() + input.toLowerCase().slice(1);
		//console.log(country);
		var httpRequest = new XMLHttpRequest();
		var url = "world.php";

		httpRequest.onreadystatechange = function (){
			if (httpRequest.readyState === XMLHttpRequest.DONE) {
			 	if (httpRequest.status === 200) {
			 		var response = httpRequest.responseText;
		 			document.getElementById("result").innerHTML=response;

			 	} else {
			 		alert('There was a problem with the request.');
			 	}
			}
		};
		httpRequest.open('GET', url+"?country="+country);
		httpRequest.send();		
	}

	function City() {

		var input = document.getElementById("country").value;

		//Value is formatted to ensure the request is completed as long as the country is correctly spelled
		var country = input.charAt(0).toUpperCase() + input.toLowerCase().slice(1);
		var city = "&context=cities";
		//console.log(country);
		var httpRequest = new XMLHttpRequest();
		var url = "world.php";

		httpRequest.onreadystatechange = function (){
			if (httpRequest.readyState === XMLHttpRequest.DONE) {
			 	if (httpRequest.status === 200) {
			 		var response = httpRequest.responseText;
		 			document.getElementById("result").innerHTML=response;

			 	} else {
			 		alert('There was a problem with the request.');
			 	}
			}
		};
		httpRequest.open('GET', url+"?country="+country+city);
		httpRequest.send();		
	}

}