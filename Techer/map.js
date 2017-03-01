var isGuest = true;
var isClicked = false;
var myMap;
var myCenter = formatting("(22.3193628,114.1589395)"); 


//check whether geolocation is supported 
function findLocation() {  //done + checked
	isClicked = true;
    if (navigator.geolocation) {
       navigator.geolocation.getCurrentPosition(succeed, fail);
    } else { 
        document.getElementById("map").innerHTML = "Geolocation is not supported by this browser.";
    } 
}

//fail to access location 
function fail(error) {  //done
    switch(error.code) {
        case error.PERMISSION_DENIED:
			//alert("1");
            document.getElementById("map").innerHTML = "User denied the request for Geolocation.";
            break;
        case error.POSITION_UNAVAILABLE:
			//alert("2");
            document.getElementById("map").innerHTML = "Location information is unavailable.";
            break;
        case error.TIMEOUT:
			//alert("3");
            document.getElementById("map").innerHTML = "The request to get user location timed out.";
            break;
        case error.UNKNOWN_ERROR:
			//alert("4");
            document.getElementById("map").innerHTML = "An unknown error occurred.";
			break;
    }
}


//success to access location 
function succeed(position) {  //done 
//alert("succeed");
myCenter = new google.maps.LatLng(position.coords.latitude, position.coords.longitude); 
displayMap();    
}


/* data format should be like "user_id:icon:user_name:user_location:"
user_location = (.., ..)
//location[i][0]: all html code 
//location[i][1] : user location data
//class profile css should add into Techer/style.css
turn database data into 1 array of tutors location
 */
function getLocation(data) {  //done + checked
	var location = [];
	var index = 0;  
	var index2 = data.indexOf(":", index + 1);  

		for (var i = 0; index2 != -1; i++){
		//get user id
		location[i] = [];
		location[i][0] = '<a  href="viewTutor.php?id=' + data.substring(index, index2) + '" style="background-color: none;">'; 
				
		index = index2 + 1;
		index2 = data.indexOf(":", index2 + 1);
		
		//get user icon
		location[i][0] += '<div id="profile2"><img id="user_icon2" src="' + data.substring(index, index2) + '"/>';  
		
		index = index2 + 1;
		index2 = data.indexOf(":", index2 + 1);
		
		//get user name
		location[i][0] += '<p id="user_details" style="color: grey;">' + data.substring(index, index2)+ '</p></div></a>'; //+ '<br/>Major:</p></div></a>';  
		
		index = index2 + 1;
		index2 = data.indexOf(":", index2 + 1);
		
		//get + format user location
		location[i][1] = formatting(data.substring(index, index2));
		
		index = index2 + 1;
		index2 = data.indexOf(":", index2 + 1);
	}/**
	for (var i = 0; index2 != -1; i++){
		//get user id
		location[i] = [];
		location[i][0] = '<a class="tutorLink" href="viewTutor.php?id=' + data.substring(index, index2) + '">' + get_small_profile(data.substring(index, index2)) + "</a>"; 
				
		index = index2 + 1;
		index2 = data.indexOf(":", index2 + 1);
		
		//get + format user location
		location[i][1] = formatting(data.substring(index, index2));
		
		index = index2 + 1;
		index2 = data.indexOf(":", index2 + 1);
	}
	*/
	//alert(locations.length);
	return location;
}

//format : myCenter = (..,..)
function formatting(myCenter){    //done + checked
	myCenter = myCenter.trim();
	var index = myCenter.indexOf(",");
	if (index != -1)
		return new google.maps.LatLng(Number(myCenter.substring(1, index)), Number(myCenter.substring(index + 1,myCenter.length - 1)));
}

//store location to database  
function storeLocation(){  //done + checked
	document.getElementById("user_location").value = myCenter;
    document.forms['hiddenForm'].submit();
}

//display macro view map if unclicked, micro view map if clicked
//if non-guest user -> run storeLocation()
/* default case: (first load the website)
no current user location -> center
generate map
load tutor location (getLocation())

clicked case:
with current user location -> center
store current user location (storeLocation())
generate map
load tutor location (getLocation())
 */
function displayMap(){ //done but not sure
	var myZoom = 12;
	
	if (document.getElementById("user_id").value != "")
		isGuest = false;
	
	if (isClicked) { //true if button is clicked
		myZoom = 15;
		if (!isGuest) {  
		  storeLocation();  
		}
	} 
	//alert(document.getElementById("user_location").value != "");
	if (document.getElementById("user_location").value != ""){  
		myZoom = 15;
		myCenter = formatting(document.getElementById("user_location").value);
	} 

	//initialize map
	var mapProp = {
		center: myCenter,
		zoom: myZoom,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
    myMap = new google.maps.Map(document.getElementById("map"), mapProp);
	
	//get tutor location
	//alert(document.getElementById("otherUser_location").value);
    var myLocation = getLocation(document.getElementById("otherUser_location").value);
	
	if (myLocation != ""){
		//initialize marker
		var infowindow = new google.maps.InfoWindow();
		var marker, i;
		//show marker of tutor locations
		for (i = 0; i < myLocation.length; i++) {  
		  marker = new google.maps.Marker({
			position: myLocation[i][1],
			map: myMap
		  });
		  //show link of tutor detail for each tutor location
		  google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
			  infowindow.setContent(myLocation[i][0]);
			  infowindow.open(myMap, marker);
			}
		  })(marker, i));
		}
	} //else alert("No tutors are available at the moment");
}

if (!isClicked) 
  window.onload = displayMap;