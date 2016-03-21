<?php


// TODO safegaurd if there is no entries directory
$entriesDir = './entries';
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($entriesDir)) as $fname)
{
	// filter out "." and "..", as well as vim tmp files
	if ($fname->isDir()) continue;
	if (substr($fname, strlen($fname) - 4, 4) === '.swp') continue;
	if (substr($fname, strlen($fname) - 1, 1) === '~') continue;
	if(substr($fname, strlen($entriesDir) + 1, 1) === '.') continue;
	
	$entries[] = substr($fname, 10);
}

$noEntries = count($entries);

global $filename;

natsort($entries);
$entries = array_values($entries);

function get_nav_links() {
	global $entries, $noEntries, $filename;

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


	// <a href="./<filename>.md">Name</a>
	$links = array(
		"<a class=".$prevClass." href=./".$entries[0].">&#124;&lt;</a>",
		"<a class=".$prevClass." href=./".$entries[$prev].">Föregående</a>",
		// get current / get list
		// TODO note that the linking to 'lista' only works due to a part of the rewrite engine
		// the actual filename is 'list', the 'a' at the end is just a quirk
		"<a href=./lista>Lista</a>",
		"<a class=".$nextClass." href=./".$entries[$next].">Nästa</a>",
		"<a class=".$nextClass." href=./".$entries[$noEntries - 1].">&gt;&#124;</a>",
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
