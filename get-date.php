<?php
/*
 * Function which takes a filename and returns its date. 
 * File should be named as following:
 * YYYYMMDD<Filename>
 */
function get_date( $filename ) {
	require_once "month-to-string.php";
	$date = "";
	if(is_numeric(substr($filename, 0, 6))) {
		$date = 
			substr($filename, 6, 2) . " " . 
			getMonth(substr($filename, 4, 2)) . " ". 
			substr($filename, 0, 4);
	}
	return $date;
}
?>
