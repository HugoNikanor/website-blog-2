<?php
function getList() {
	// TODO there possibly is a better way to do sub-imports
	require("./month-to-string.php");

	global $entries;
	$entries = array_reverse($entries);

	// table start
	$ret = "<div id='list'><table><tr><th class='tableLeft'>Date</th><th class='tableRight'>Name</th></tr>";

	foreach( $entries as $key => $url ) {
		// strips .md extension from file
		$name = substr($url, 0, -3);

		// parse date if one is present
		if(is_numeric(substr($url, 0, 6))) {
			$date = 
				substr($url, 6, 2) . " " . 
				getMonth(substr($url, 4, 2)) . " ". 
				substr($url, 0, 4);

			// remove date from filename
			$name = substr($name, 8);
		} else {
			$date = "";
		}

		// table row
		$ret .= "<tr><td class=tableLeft><a href=./?filename=".$url.">".$date."</a></td>";
		$ret .= "<td class=tableRight><a href=./?filename=".$url.">".$name."</a></td></tr>";
	}

	// table end
	$ret .= "</table></div>";

	return $ret;

}
?>
