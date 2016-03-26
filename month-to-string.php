<?php



function getMonth($input) {
	
	$monthNames = array(
		'01' => "Jan",
		'02' => "Feb",
		'03' => "Mar",
		'04' => "Apr",
		'05' => "May",
		'06' => "Jun",
		'07' => "Jul",
		'08' => "Aug",
		'09' => "Sep",
		'10' => "Oct",
		'11' => "Nov",
		'12' => "Dec"
	);

	if(isset($monthNames)) {
		if(is_numeric($input) &&
		   $input > 0 &&
		   $input < 13) {
			return($monthNames[$input]);
		} else {
			//return $input;
			return 'uuu';
		}
	} else {
		return('nope');
	}
}

?>
