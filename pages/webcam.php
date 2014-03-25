<div class="tile-group-title fg-white">Security</div>
<div class="carousel double-vertical" id="carousel2">
	<?php for($i = 0; $i <= count($webcams) - 1; $i++) { // Loop through our webcams array that we grabbed from config.php ?>
	    <div class="slide">
		    <img src="<?php echo $deviceAPI->image($webcams[$i], true); // true as the last parameter returns the URL to the file and not the raw JPEG data ?>" class="cover1" />
	    </div>
	<?php } ?>
</div>

<script type="application/javascript">
$('#carousel2').carousel({ // Take all our cariousel slides and animate them!
    auto: true,
	effect: 'fade',
    period: <?php echo $webcamCariouselInfo["changeTime"]; // How long should each webcam picture stay up? ?>,
    duration: <?php echo $webcamCariouselInfo["fadeTime"]; // The time taken to fade between two images ?>,
    markers: {
        type: "square"
    }
});</script>