<?php
// load in all files in ./entries into an array

// TODO safegaurd if there is no entries directory
$entriesDir = './entries';
foreach (scandir($entriesDir) as $fname)
{
	// filter out "." and "..", as well as vim tmp files
	if (is_dir("$entriesDir/$fname")) continue;
	if (substr($fname, strlen($fname) - 4, 4) === '.swp') continue;
	if (substr($fname, strlen($fname) - 1, 1) === '~') continue;
	if ($fname[0] === '.') continue;
	if (substr($fname, strlen($fname) - 3, 3) !== '.md') continue;

	$entries[] = $fname;
}

// sort the entries
natsort($entries);
$entries = array_values($entries);
