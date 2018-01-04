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
