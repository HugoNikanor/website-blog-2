<!Doctype html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="./blog.css">
	<link rel="stylesheet" href="./content.css">
	<link rel="alternate" type="aplication/rss+xml" title="RSS" href=./rss.php" />
	<?php
		ini_set('display_startup_errors', 1);
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
		error_reporting(~E_STRICT);

		require('./settings.php');

		require('./nav-bar.php');
		require('./list.php');

		if ($has_comments) {
			require('./website-comment-system/comments-display.php');
		}

		require('Parsedown/Parsedown.php');
		if ($use_parsedown_extra) {
			require('ParsedownExtra/ParsedownExtra.php');
		}

		$noEntries = count($entries);
		if(isset($_GET['filename'])) {
			$filename = $_GET['filename'];
		} else {
			$filename = $entries[$noEntries - 1];
		}

		// List of all the files in the footnote
		$specialFiles    = parse_ini_file("./special-files.ini", TRUE);
		$footnoteFiles   = $specialFiles["footnote"]["files"];
		$footnoteNames   = $specialFiles["footnote"]["title"];
		$otherSpecial    = $specialFiles["other"]["files"];
		$combinedSpecial = array_merge( $footnoteFiles, $otherSpecial );

		if( !in_array( $filename, $combinedSpecial ) ) {
			$file = "./entries/" . $filename;
			if(!file_exists($file)) {
				$filename="entry-not-found.md";
				$file=$filename;
			}
		}

		// remove leading points and slashes, for safety
		$filename = preg_replace( "/^[\.\/]+/", "", $filename );
	?>
<title>
<?= $blog_title ?>
	<?php
			if( isset($file) ) {
				$title = preg_replace( "/^[# ]*/", "", fgets(fopen($file, 'r')));
				echo " | " . $title;
			}
	?>
</title>
</head>
<body>

<div id="all">
<a class="rss-logo" href="./rss.php"><img src="feed-icon-28x28.png" alt="RSS"/></a>

<?php require("./top-bar.php"); ?>

<div id="nav-pane">
	<?php echo get_nav_links(); ?>
</div> <!-- nav-pane -->

<div id="content">
<div class="date"> <?= $author ?> <?php
require_once "get-date.php";
echo get_date( $filename );
?></div>

<?php
		if ($use_parsedown_extra) {
			$Pd = new ParsedownExtra();
		} else {
			$Pd = new Parsedown();
		}
		if( $filename === "list" ) {
			echo getList();
		} else if( in_array( $filename, $footnoteFiles )) {
			echo $Pd->text(file_get_contents('./footnote/' . $filename));
		} else {
			$contents = file_get_contents($file);
			$wordcount = str_word_count($contents);
			/* 250 is about avarage reading speed (in WPM) */
			echo "<span class='read-time'>Lästid: " . ceil($wordcount / 250) . " minut(er)</span>";
			echo $Pd->text($contents);
		}
?>

<?php if ($has_entry_log && file_exists('entries/.git') && !in_array($filename, $combinedSpecial) ) {  ?>
<details>
	<summary>Changelog</summary>
	<ul>
		<?php echo `cd entries && git log '--pretty=format:<li>%as %s' $filename` ?>
	</ul>
</details>
<?php } ?>

<?php if( !in_array($filename, $combinedSpecial) ) { ?>
<hr/>
<a href="./rss.php">
	<img src="feed-icon-14x14.png" alt="RSS"/>
	RSS-feed to see more like this.
</a>
<?php } ?>
</div> <!-- content -->

<?php if ($has_comments) { ?>
<div id="comments">
<?php
		if( !in_array($filename, $combinedSpecial) ) {
		echo "<hr>";
		displayComments( $filename );
	}
?>
</div> <!-- comments -->
<?php } ?>

<div id="footnote">
<?php for ($i = 0; $i < count($footnoteFiles); $i++) { ?>
	<a href="./?filename=<?= $footnoteFiles[$i] ?>"><?= $footnoteNames[$i] ?></a>
<?php } ?>
</div> <!-- footnote -->

</div> <!-- all -->

</body>
</html>
