<?php

	require_once('class/TwitterAPIExchange.php');

	class clsTwitter {

		function getTweets($user = "", $count = 10, $token = "") { // Gets all the tweets based on details we provide
			
			$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
			$requestMethod = "GET";
			$getfield = "?screen_name=$user&count=$count";

			$twitter = new TwitterAPIExchange($token);
			$twitter->setGetfield($getfield);
			$str = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
			$string = json_decode($str,$assoc = TRUE);
			return $string;
		}
		
		
		
		function removeHashtags($string, $items) { // Searches $string for the items in $items (an array) and strips them out.
			
			if($items == false) { $items = $hashtags; }
			return str_replace($items, "", $string);	
		}
		
	}


?>