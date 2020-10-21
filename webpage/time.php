<?php
 	date_default_timezone_set("America/New_York");
	$date = date("m/d/y");
	$hour = date("H");
	$min = date("i");
	$time = date("h:i");
	if ($hour > 11) {
		$timestamp = "At " . $time . " PM " . " " . $date;
	} else {
		 $timestamp = "At " . $time . " AM " .  " " . $date;
	}
	echo $timestamp;
?>
