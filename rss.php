<?php
ini_set("display_errors", 1);
/* text/xml to allow browser to display it (instead of downloading it) */
header("Content-Type: text/xml");

require ("./load-entries.php");
require ("./settings.php");
?>
<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>
<?xml-stylesheet href="/rss.xsl" type="text/xsl" ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
	<title><?= $blog_title ?></title>
	<link><?= $urlbase ?></link>
	<atom:link href="<?= $urlbase ?>/rss.php" rel="self"/>
	<description><?= $blog_subtitle ?></description>
	<language>sv</language>

	<?php
	require('Parsedown/Parsedown.php');
	if ($use_parsedown_extra) {
		require('ParsedownExtra/ParsedownExtra.php');
		$Pd = new ParsedownExtra();
	} else {
		$Pd = new Parsedown();
	}
	foreach ($entries as $key => $url) {
		$name = $url;

		# if( substr($url, -3) === ".md" ) {
		# 	$name = substr($url, 0, -3);
		# }
		# $name = substr($name, 8);

		$fullurl = "$urlbase/?filename=$url";
		$file = fopen("entries/" . $url, 'r');
		$first_line = fgets($file);
		$rest_of_file = stream_get_contents($file);
		$title = trim(preg_replace( "/^[# ]*/", "", $first_line), "\n");
		$content = $Pd->text($rest_of_file);
		# https://stackoverflow.com/a/23066553
		$content = preg_replace('/[^\PC\s]/u', '�', $content);

		$year  = substr ($url, 0, 4);
		$month = substr ($url, 4, 2);
		$day   = substr ($url, 6, 2);
		$datestr = "$year-$month-$day";
		$date = date_format(date_create($datestr), DATE_RSS);
	?>
	<item>
		<title><?= htmlspecialchars($title, ENT_XML1|ENT_DISALLOWED, "UTF-8") ?></title>
		<link><?= $fullurl ?></link>
		<guid><?= $fullurl ?></guid>
		<pubDate><?= $date ?></pubDate>
		<description><![CDATA[<?= $content ?>]]></description>
	</item>
	<?php } ?>
</channel>
</rss>
