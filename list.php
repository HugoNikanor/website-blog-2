<?php
function getList() {
	global $entries;
	$entries = array_reverse($entries);

	// table start
	$ret = "<div id='list'><table><tr><th class='tableLeft'>Date</th><th class='tableRight'>Name</th></tr>";

	foreach( $entries as $key => $url ) {
		$name = $url;

		// strips .md extension from file
		if( substr($url, -3) === ".md" ) {
			$name = substr($url, 0, -3);
		}

		// get date
		require_once "get-date.php";
		$date = get_date($url);

		// remove date from filename
		$name = substr($name, 8);

		// table row
		$ret .= "<tr><td class=tableLeft><a href=./?filename=".$url.">".$date."</a></td>";
		$ret .= "<td class=tableRight><a href=./?filename=".$url.">".$name."</a></td></tr>";
	}

	// table end
	$ret .= "</table></div>";

	return $ret;

}
?>
