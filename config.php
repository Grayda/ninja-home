<?php
	
	$siteName = "My House Dashboard"; // The name of your site. Appears at the top of the page and in the webpage title
	$nbAccessToken = ""; // Ninja Blocks API access token. Get it from http://a.ninja.is/hacking
	$twitterAccessToken = array(
								'oauth_access_token' => "", 
								'oauth_access_token_secret' => "", 
								'consumer_key' => "", 
								'consumer_secret' => ""
							); // Twitter oAuth access token
	$twitterAccount = ""; // The twitter account you want to pull tweets from
	$twitterAmount = 6; // The amount of tweets you want to grab
	// This array is looped through and these hashtags stripped from the results in class/twitter.php. The colours listed are then used when creating tiles on the home screen. 
	// If multiple hashtags are present, then they are all added to the tile, and CSS precedence takes over, so put the more important stuff first.
	$hashtags = array(
					array("tag" => "#quad", "class" => "quadro"),										
					array("tag" => "#half", "class" => ""),															
					array("tag" => "#error", "class" => "double bg-crimson fg-white"),
					array("tag" => "#info", "class" => "double bg-darkcyan fg-white"),
					array("tag" => "#message", "class" => "double bg-darkviolet fg-white"),
					array("tag" => "#log", "class" => "double bg-darkgreen fg-white"),
					array("tag" => "#modal", "class" => "bg-lime fg-black double")					
				); 
	$databaseInfo = array( // Connection details for our database
						"host" => "localhost",
						"username" => "root",
						"password" => "",
						"database" => "ninjaDash",
						"type" => "mysqli"
					);
	$refreshTimes = array( // How often should we refresh our various things? Twitter has a rate limit of 100 calls per hour, so set it to something higher than 30 seconds to avoid hitting the limit
							"webcam" => "30000",
							"twitter" => "60000"
					);
	$webcams = array( // The GUIDs of the webcams you wish to monitor. 
		"",
		""
	);
	
	$webcamCariouselInfo = array( // Parameters for the webcam carousel. fadeTime is how quickly it one image fades out and the other fades in, changeTime is how long each image is displayed for
								"fadeTime" => "1000",
								"changeTime" => "10000"
							);
	
	// Devices that we want to actuate. Stuff like lightbulbs, motion sensors etc. They are turned into tiles and added to the dashboard
	// Name is a short name (used in the javascript function, so keep it JS friendly)
	// Description is a longer description. Think of it as a title (e.g. David's Room) and not a description (e.g. "This light is in the kitchen and turns on every night at 6pm")
	// GUID is the GUID from the dashboard.
	// Data is what is the device is to be actuated with. Put it into an array, preceded by (object), like so: (object) array("DA" => "YOUR DATA HERE")
	// Style / Icon are used to give the tile drawn some style. 
	$actuateDevices = array( 
							array("name" => "loungeroom", "description" => "The Loungeroom Lights", "guid" => "", "data" => (object) array("DA" => "000000000000000000000000"), "style" => "bg-lime fg-white", "icon" => "icon-lamp-2 fg-black"),
							array("name" => "outside", "description" => "Outside Lights", "guid" => "", "data" => (object) array("DA" => "000000000000000000000000"), "style" => "bg-lime fg-white", "icon" => "icon-lamp-2 fg-black")

						);

	$timezone = "Australia/Melbourne"; // Set your timezone here. Used for the "x many hours ago" function and the gmtToLocal function

?>