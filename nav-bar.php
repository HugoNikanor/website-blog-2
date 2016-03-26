<?php
// load in all files in ./entries into an array

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


// sort the entries
natsort($entries);
$entries = array_values($entries);

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

	// TODO note that the linking to 'lista' only works due to a part of the rewrite engine
	// the actual filename is 'list', the 'a' at the end is just a quirk
	$middle = "<a href=./?filename=list>Lista</a>";
	// if the site currently is on the list site, or one of the entries of the 
	// bottom bar then the step buttons sholud be turned off. And the center 
	// button should be changed into a 'current entry' button
	if(
		$filename == "list"       ||
		$filename == "about.md"   ||
		$filename == "contact.md" ||
		$filename == "legal.md"   ||
		$filename == "qna.md"
 	) {
		$prevClass = "disabled";
		$nextClass = "disabled";
		$middle = "<a href=./?filename=".$entries[$noEntries - 1].">Nuvarande Inlägg</a>";
	}


	$links = array(
		"<a class=".$prevClass." href=./?filename=".$entries[0].">&#124;&lt;</a>",
		"<a class=".$prevClass." href=./?filename=".$entries[$prev].">Föregående</a>",
		$middle,
		"<a class=".$nextClass." href=./?filename=".$entries[$next].">Nästa</a>",
		"<a class=".$nextClass." href=./?filename=".$entries[$noEntries - 1].">&gt;&#124;</a>",
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
