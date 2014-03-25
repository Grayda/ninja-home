<?php // This needs some cleaning up! Some of it can be moved to the Twitter class in class/twitter.php ?>
<div class="tile-group-title fg-white">Latest Events</div>
<?php 

	$t = new clsTwitter; // New clsTwitter class, which is a wrapper for the TwitterAPIExchange class
	$tweets = $t->getTweets($twitterAccount, 0, $twitterAccessToken); // Get our tweets. Returned as associative array

	if(array_key_exists("errors", $tweets)) { // If we've hit an error (e.g. Rate limit exceeded) then don't proceed, as there's no point.
		echo "<h1 class='fg-white'>" . $tweets["errors"][0]["message"] . "</h1>";  
	} else {
	
?>
  
<?php

	$ret = array(); // Clear out our results array. This gets filled with tweet info that gets passed to ui::drawTile
	$modal = ""; // Clear out our modal text. This gets displayed as a modal window, then dismissed on close
	if(!empty($tweets)) { // If we have tweets to show, continue on!
		for($a = 0; $a <= count($twitterAmount); $a++) { // Loop through our tweets.
			$class = ""; // Reset our class
			if($db->isDismissed($tweets[$a]["id_str"]) == true) { // If we've previously dismissed this tweet, hide it
				if($a < count($tweets) - 1) { $twitterAmount++; } // Make sure we grab another tweet from the list, otherwise you get x - 1 tweets when you really want x
			}
			
			if(strpos($tweets[$a]["text"], "#hide") !== false) { // If we have the #hide tag, then skip this iteration of the loop and go again (i.e. ignore it).
				continue;
			}
			
			for($i = 0; $i <= count($hashtags) - 1; $i++) { // Loop through the hashtags we defined in config.php
				if(strpos($tweets[$a]["text"], $hashtags[$i]["tag"]) !== false) { // If the tag appears in our tweet's text
					$class .= $hashtags[$i]["class"] . " "; // Add the classes for that tag to $class where it'll be passed on to ui:drawTile
				}
			}
			
			if(strpos($tweets[$a]["text"], "#modal") !== false) { // If we've got the #modal tag in there, we need to display it in a window
				$modal .= "<h1 class='text-center'>" . $m->stripText($m->stripHashtags($tweets[$a]["text"])) . "</h1><h3 class='text-center'>" . $m->gmtToLocal($tweets[$a]["created_at"]). "</h3>"; // Add some HTML. This lets us have more than one #modal tweet and still see the results (MetroUI / jQuery will only show one window, no matter how many times the javascript is called)
				$dismiss .= "doDismiss('" . $tweets[$a]["id_str"] . "'); "; // Add the code to dismiss it once it's been made modal (so it doesn't show up when Twitter reloads)
			} 

			if(strpos($tweets[$a]["text"], "#sticky")) { // If our tweet should be sticky, then use array_unshift to add it to the top of the array
				array_unshift($ret, array($tweets[$a]["text"], $m->ago($tweets[$a]["created_at"]), $class, $tweets[$a]["id_str"])); // If more than 1 sticky is present, the latest one is at the top
			} else { // If we're not sticky, just add it to the end like a regular element
				$ret[] = array($tweets[$a]["text"], $m->ago($tweets[$a]["created_at"]), $class, $tweets[$a]["id_str"]); 		

			}
			
				
		}
			

	
			for($i = 0; $i <= count($ret) - 1; $i++) { // Now we come to the tile part! Loop through $ret and write everything out using ui::drawTile
				$ui->drawTile($m->stripText($m->stripHashtags($ret[$i][0])), $ret[$i][1], "javascript:doDismiss('" . $ret[$i][3] . "')", $ret[$i][2], true, $ret[$i][3]);
			}
			
			if(!empty($modal)) { // And if we've got modal stuff to display? Output the necessary Javascript
				?><script type="application/javascript">
					doWindow("<?php echo $modal; ?>");
					<?php echo $dismiss; ?>
				  </script><?php
			}
			
		} else { // If we've got no tweets to display, display the message below.
?><h2 class="fg-white">There are no recent events to display</h2>
<div id="tWindow"></div>
<?php } ?>
<?php } ?>
