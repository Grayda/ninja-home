<div class="tile-group two"> <!-- Holds four regular tiles, or two double-wide tiles -->
<div class="tile-group-title fg-white">Lights</div>
<?php

	for($i = 0; $i <= count($actuateDevices) - 1; $i++) { // Loop through the devices we wish to actuate.
		$ui->drawTile("<span class='" . $actuateDevices[$i]["icon"] . "'></span>", $actuateDevices[$i]["description"], "javascript:doActuate('" . $actuateDevices[$i]["name"] . "')", $actuateDevices[$i]["style"], "", false); // Draw a tile that has javascript:doActuate as the link. $actuateDevices[$i]["name"] is the short name used in the IF statement in header.php (the $_POST["light"] bit)
	}

?>
</div>