// Uber API Constants
// Security note: these are visible to whomever views the source code!
var uberClientId = "jtzzb6VFgszQc7G_U6vD1G7VJjrcsMj2"
	, uberServerToken = "xDkMILy7hejcNuASqp-q_rhq39a48UG_BYJ9qrNb"; 

// Create variables to store latitude and longitude
var userLatitude
	, userLongitude
	, partyLatitude = 55.629191
	, partyLongitude = 12.069543;

// Create variable to store timer
var timer;

// Great resource: https://developer.mozilla.org/en-US/docs/Web/API/Geolocation/Using_geolocation
navigator.geolocation.watchPosition(function(position) {
	// Update latitude and longitude
	userLatitude = position.coords.latitude;
	userLongitude = position.coords.longitude;

	// Create timer if needed
	// Once initialized, it will fire every 60 seconds as recommended by the Uber API
	// We only create the timer after we've gotten the user's location for the first time 
	if (typeof timer === typeof undefined) {
		timer = setInterval(function() {
			getEstimatesForUserLocation(userLatitude, userLongitude);
		}, 60000);

		// Query Uber API the first time manually
		getEstimatesForUserLocation(userLatitude, userLongitude);
	}
});

function getEstimatesForUserLocation(latitude,longitude) {
	console.log("Requesting updated time estimate...");
  $.ajax({
    url: "http://sandbox-api.uber.com/v1/estimates/price",
    headers: {
    	Authorization: "Token " + uberServerToken
    },
    data: { 
    	start_latitude: latitude,
    	start_longitude: longitude,
    	end_latitude: partyLatitude,
    	end_longitude: partyLongitude
    },
    success: function(result) {
    	console.log(JSON.stringify(result));

    	// 'results' is an object with a key containing an Array
    	var data = result["prices"]; 
    	if (typeof data != typeof undefined) {
    		// Sort Uber products by time to the user's location 
    		data.sort(function(t0, t1) {
    			return t0.duration - t1.duration;
    		});

    		// Update the Uber button with the shortest time
    		var shortest = data[0];
    		if (typeof shortest != typeof undefined) {
    			console.log("Updating time estimate...");
					$("#time").html("IN " + Math.ceil(shortest.duration / 60.0) + " MIN");
    		}
    	}
    }
  });
}

$("a").click(function(event){
	// Redirect to Uber API via deep-linking to the mobile web-app
	var uberURL = "https://m.uber.com/sandbox/sign-up?";

	// Add parameters
	uberURL += "client_id=" + uberClientId;
	if (typeof userLatitude != typeof undefined) uberURL += "&" + "pickup_latitude=" + userLatitude;
	if (typeof userLongitude != typeof undefined) uberURL += "&" + "pickup_longitude=" + userLongitude;
	uberURL += "&" + "dropoff_latitude=" + partyLatitude;
	uberURL += "&" + "dropoff_longitude=" + partyLongitude;
	uberURL += "&" + "dropoff_nickname=" + "Thinkful";

	// Redirect to Uber
	window.location.href = uberURL;
});