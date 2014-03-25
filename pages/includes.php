<?php 

	if(file_exists("config-live.php")) { // We do it this way so I don't accidentally upload my config.php with keys and such in it :\
    	require("config-live.php"); 
	} else {
		require("config.php");
	}

?>

<?php require("class/ninja/nbapi.php"); // Our Ninja PHP library ?>
<?php require("class/ui.php"); // A few helper functions for drawing UI stuff ?>
<?php require("class/twitter.php"); // A few helper functions for drawing UI stuff ?>
<?php require("class/clsMisc.php"); // A few helper functions for drawing UI stuff ?>
<?php require("class/clsSQL.php"); // A few helper functions for drawing UI stuff ?>

<?php 
	$ui = new ui; // Draws tiles and other UI based stuff
	$m = new clsMisc; // Helper functions for dealing with dates, strings etc.
	$db = new cSQL($databaseInfo["host"], $databaseInfo["username"], $databaseInfo["password"], $databaseInfo["database"]); // Our database class
	$deviceAPI = new Device($nbAccessToken); // And finally, our Ninja Blocks class that lets us do awesome things with the data and devices on our Ninja Block
?>
