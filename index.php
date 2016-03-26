<!Doctype html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>
		In progress
	</title>
	<link rel="stylesheet" href="./blog.css">
	<link rel="stylesheet" href="./content.css">
	<?php
		ini_set('display_startup_errors', 1);
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
		error_reporting(~E_STRICT);

		require('./nav-bar.php');
		require('./list.php');

		require('./comment-system/comments-display.php');

		require('./parsedown/Parsedown.php');
		//require('./parsedown/ParsedownExtra.php');

		$noEntries = count($entries);
		if(isset($_GET['filename'])) {
			$filename = $_GET['filename'];
		} else {
			$filename = $entries[$noEntries - 1];
		}

		// List of all the files in the footnote
		$footnoteFiles = parse_ini_file("./special-files.ini")["files"];
	?>
</head>
<body>

<div id="all">

<?php echo file_get_contents("./top-bar.html"); ?>

<div id="nav-pane">
	<?php echo get_nav_links(); ?>
</div> <!-- nav-pane -->

<div id="content">

<?php
		$Pd = new Parsedown();
		if( $filename === "list" ) {
			echo getList();
		} else if( in_array( $filename, $footnoteFiles )) {
			echo $Pd->text(file_get_contents('./footnote/' . $filename));
		} else {
			echo $Pd->text(file_get_contents('./entries/' . $filename));
		}
?>

</div> <!-- content -->

<div id="comments">
<?php
	$footnoteFiles[] = "list";
	if( !in_array($filename, $footnoteFiles) ) {
		echo "<hr>";
		displayComments( $filename );
	}
?>
</div> <!-- comments -->

<div id="footnote">
	<a href=./about.md>About</a>
	<a href=./contact.md>Contact</a>
	<a href=./legal.md>Legal</a>
	<a href=./qna.md>Q&amp;A</a>
</div> <!-- footnote -->

</div> <!-- all -->

</body>
</html>
