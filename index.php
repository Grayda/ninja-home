<?php ob_start(); ?>

<?php require("pages/includes.php"); // Include our stuff here ?>
<?php require("elements/header.php"); // The start of our HTML. ?>
<div class="tile-group four">
	<div id="twitter">
		<?php include_once("pages/twitter.php"); // Our Twitter message board ?> 
    </div>
</div>
<?php include_once("pages/lights.php"); // Our light (and other devices to actuate) icons ?>
<div class="tile-group four">
	<div id="webcam">
		<?php include_once("pages/webcam.php"); // The webcams hooked up to the Ninja Block ?>
	</div>
</div>
<?php require("elements/footer.php"); // And the footer. Wraps things up nicely. ?>
<?php ob_end_flush(); ?>