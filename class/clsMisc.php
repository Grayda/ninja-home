<?php

	class clsMisc { // Miscellaneous functions
		
		function ago($time) { // Takes a time and gives you a "ago" time in the past (e.g. 3 days ago, 1 minute ago)
			$time = strtotime($time);
		   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		   $lengths = array("60","60","24","7","4.35","12","10");
		   $now = time();
	       $difference = $now - $time;
	       $tense = "ago";

		   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		       $difference /= $lengths[$j];
		   }

		   $difference = round($difference);

		   if($difference != 1) {
		       $periods[$j].= "s";
		   }

		   return "$difference $periods[$j] $tense ";
		}

		function gmtToLocal($time) { // Converts a GMT time into a local time. Used for the created_at part of tweets. Need to 

			$t = new DateTime($time);
			$t->setTimezone(new DateTimeZone($timezone));			
			return $t->format("g:i:s A d/m/Y");	
		}
		
		function strposa($haystack, $needle, $offset=0) { // Like strpos, but takes an array. Copied from http://stackoverflow.com/questions/6284553/using-an-array-as-needles-in-strpos. 
 		   if(!is_array($needle)) $needle = array($needle);
		    foreach($needle as $query) {
		        if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
		    }
		    return false;
		}
		
		function getHashtags($text) { // Extracts all hashtags from a string and returns them as an array
			preg_match_all("/(#\w+)/", $text, $matches);	
			return $matches;
		}
		
		function stripHashtags($text) { // This is in the Twitter class, so need to remove it from here?
			return preg_replace("/(#\w+)/", "", $text);	
		}
		
		function stripText($text) { // This function (which really needs to be tweaked) removes everything between double square brackets (e.g. "One [[two]] three" will return "One  three". Is used for stripping {{DATE_TIME_UTC}} stuff out from tweets (Which is necessary to stop Twitter from rejecting duplicate tweets)
			return preg_replace("/\[\[(.*)\]\]/", "", $text);
		}
		
	}
	
?>