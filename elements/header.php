<?php
	// This is a bit hacky. I need to clean it up. Basically we can't get jQuery to reload pages/webcam.php directly, because
	// the page doesn't know about config.php (and reincluding it throws a bunch of errors I need to work through). But if we use
	// index.php as a "proxy" and include the pages we want to load, then everything works OK, but we need to exit() when we do load
	// a page, otherwise we get the page we're after, plus the rest of the dashboard. Still with me? Good!
	
	for($i = 0; $i <= count($actuateDevices) - 1; $i++) { // Loop through all the devices we wish to actuate
		if(@$_POST["light"] == $actuateDevices[$i]["name"]) { // If $_POST == the device we wish to actuate
			$deviceAPI->actuate($actuateDevices[$i]["guid"], $actuateDevices[$i]["data"]); // Then do it!
			exit(); // Quit afterwards so we're not loading the rest of everything.
		}
	}
	
	switch(@$_POST["page"]) { // Our "proxy" pages used by jQuery to AJAX our pages every 30-60 seconds
		
		case "twitter": // If the request has come in to reload the Twitter feed
			require("pages/twitter.php"); // Load the twitter feed
			exit(); // Then exit
			break; // Is this really necessary?

		case "webcam":
			require("pages/webcam.php");
			exit();
			break;
	}
	
	if(!empty($_POST["dismiss"])) { // If we're dismissing a notification
		$db->dismiss(htmlspecialchars($_POST["dismiss"]));	// Sanitize the input (need to do this in clsSQL) and let $db->dismiss do its magic
		exit(); // Quit, because this is done via AJAX and we don't need to load lots of unnecessary stuff
	}

	if(!empty($_POST["truncate"])) { // This is a reset button. Used during debugging to clear out the "dismissed" database so all tweets we've previously cleared will show again
		$db->doSQL("TRUNCATE TABLE  `dismissed`");
		exit();
	}
	

?>
<html>
	<head>
		<title><?php echo $siteName; ?></title>
        <link href="metroui/css/metro-bootstrap.css" rel="stylesheet">
		<link href="metroui/min/iconFont.min.css" rel="stylesheet">
		<script src="metroui/js/jquery/jquery.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
		<script src="metroui/js/metro-loader.js"></script>
		<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css">
		<style>
			.window { // For some stupid reason, the .window won't move into the center (it's always at 0,0) so we need to do some CSS to move it.
				position: absolute;
				left: 30%;
				top: 40%;
			}
			
		</style>


		<script type="text/javascript">
			function doActuate(device) { // An AJAX call that actuates lights. Just POST to index with the key "light" and the value of a predefined light, and it's done. 
				$.ajax({
				  type: "POST",
				  url: "index.php",
				  data: { light: device },
				});
			}
			
			function doReset() { // A debugging call that truncates the 'dismissed' table and starts everything anew
				$.ajax({
				  type: "POST",
				  url: "index.php",
				  data: { truncate: true },
				});

				reloadTwitter();
			}
			
			function doDismiss(id) { // An AJAX call to hide an element on the page and send its ID to the database
				$.ajax({
				  type: "POST",
				  url: "index.php",
				  data: { dismiss: id },
				});

				$("#" + id).hide( "slow", function() {}); 

				reloadTwitter();
			}

			$(window).ready(function () { // On page load, set webcam to reload according to $refreshTimes["webcam"] in config.php
			    setInterval(function() {
    		    	reloadWebcam();
	    		}, <?php echo $refreshTimes["webcam"]; ?>);
				
				setInterval(function() { // On page load, set Twitter feed to reload according to $refreshTimes["twitter"] in config.php
    		    	reloadTwitter();
	    		}, <?php echo $refreshTimes["twitter"]; ?>);
			});
			
			function reloadTwitter() { // The function that reloads Twitter
				$.ajax({
        		url: "index.php",
        		type: "post",
		        data: { page: "twitter" },
		        success: function(response){
        		    $('#twitter').html(response); // When we get data back, replace #twitter with it 
    	    	},
		    });			

			}
			
			function reloadWebcam() { // The function that reloads our webcams
				$.ajax({
        		url: "index.php",
        		type: "post",
		        data: { page: "webcam" },
		        success: function(response){
        		    $('#webcam').html(response); // When we get data back, replace #twitter with it 
    	    	},
				});
			}

			function doWindow(content) { // Displays a modal window. 
				$.Dialog({
			        shadow: true,
			        overlay: true,
					flat: true,
			        icon: '<span class="icon-rocket"></span>',
			        title: 'Title',
					position: 'default',
			        width: '40%',
					height: "auto",
			        padding: 10,
					position: 50,
			        content: content,
			    });
			}
	
		</script>

	</head>
	<body class="metro window-overlay">

    	<div class="tile-area tile-area-dark">
        	<h1 class="tile-area-title fg-white"><?php echo $siteName; ?></h1>
			<div class="user-id">
	    			<?php $ui->drawTile("<i class='icon-spin'></i>", "", "./", "bg-lime half half-vertical", false); // Draws a refresh button ?>
                    <?php $ui->drawTile("<i class='icon-cancel'></i>", "", "javascript:doReset()", "bg-crimson half half-vertical", false); // Draws a "factory defaults" button ?>
	        </div>
