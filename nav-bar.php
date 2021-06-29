<?php

require ("./load-entries.php");

function get_nav_links() {
	global $entries, $filename;
	$noEntries = count($entries);

	$currentEntryNo = array_search( $filename, $entries );

	$next = $currentEntryNo + 1;
	$prev = $currentEntryNo - 1;
	$prevClass = "default";
	$nextClass = "default";
	// disable the links that needs to be disabled
	if( $currentEntryNo == 0 ) {
		$prevClass = "disabled";
		$prev = 0;
	}
	if( $currentEntryNo == $noEntries - 1 ) {
		$nextClass = "disabled";
		$next = 0;
	}

	$middle = "<a href='./?filename=list'>Lista</a>";
	global $combinedSpecial;
	if( in_array($filename, $combinedSpecial)) {
		$prevClass = "disabled";
		$nextClass = "disabled";
		$middle = "<a href='./?filename=".$entries[$noEntries - 1]."'>Nuvarande Inlägg</a>";
	}


	$links = array(
		"<a class=".$prevClass." href='./?filename=".$entries[0]."'>&#124;&lt;</a>",
		"<a class=".$prevClass." href='./?filename=".$entries[$prev]."'>Föregående</a>",
		$middle,
		"<a class=".$nextClass." href='./?filename=".$entries[$next]."'>Nästa</a>",
		"<a class=".$nextClass." href='./?filename=".$entries[$noEntries - 1]."'>&gt;&#124;</a>",
	);

	$ret = "";
	foreach( $links as $key => $value ) {
		// TODO this is dependent on rewrite rules
		//$ret .= '<a href=./' . $value . '>' . $key . '</a>';
		$ret .= $value;
	}

	return $ret;
}
?>
