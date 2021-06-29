<?php
ini_set("display_errors", 1);
header("Content-Type: text/rss+xml");

require ("./load-entries.php");
require ("./settings.php");

?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
	<title><?= $blog_title ?></title>
	<link><?= $urlbase ?></link>
	<atom:link href="<?= $urlbase ?>/rss.php" rel="self"/>
	<description><?= $blog_subtitle ?></description>
	<language>sv</language>

	<?php
	$Pd = new Parsedown();
	foreach ($entries as $key => $url) {
		$name = $url;

		# if( substr($url, -3) === ".md" ) {
		# 	$name = substr($url, 0, -3);
		# }
		# $name = substr($name, 8);

		$fullurl = "$urlbase/?filename=$url";
		$file_contents = fgets(fopen($file, 'r'));
		$title = preg_replace( "/^[# ]*/", "", $file_contents);
		$content = $Pd->text($file_contents);

		$year  = substr ($url, 0, 4);
		$month = substr ($url, 4, 2);
		$day   = substr ($url, 6, 2);
		$datestr = "$year-$month-$day";
		$date = date_format(date_create($datestr), DATE_RSS);
	?>
	<item>
		<title><?= $title ?></title>
		<link><?= $fullurl ?></link>
		<guid><?= $fullurl ?></guid>
		<pubDate><?= $date ?></pubDate>
		<description><![CDATA[<?= $content ?>]]></description>
	</item>
	<?php } ?>
</channel>
</rss>
