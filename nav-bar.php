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

function getAdjacent( $entryNumber, $change ) {
	global $entries, $noEntries;
	$entryNumber += $change;

	if( $entryNumber < 0 ) {
		return $entries[0];
	} elseif( $entryNumber >= $noEntries ) {
		return $entries[$noEntries - 1];
	} else {
		return $entries[$entryNumber];
	}
}


function get_nav_links() {
	global $entries, $noEntries, $filename, $currentEntryNo;

	$currentEntryNo = array_search( './entries/'.$filename, $entries );

	// TODO possibly encode the 'special' characters
	$links = array(
		"|<" => $entries[0],
		"Föregående" => getAdjacent( $currentEntryNo, -1 ),
		//"Lista" => './list/',
		//"Lista" => './index.php?filename=list',
		"Current" => $entries[$currentEntryNo],
		"Nästa" => getAdjacent( $currentEntryNo, 1 ),
		">|" => $entries[$noEntries - 1],
	);

	$ret = "";
	foreach( $links as $key => $value ) {
		$ret .= '<a href="' . $value . '">' . $key . '</a>';
	}

	return $ret;
}

?>
