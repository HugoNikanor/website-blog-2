<!Doctype html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>
		In progress
	</title>
	<link rel="stylesheet" href="./blog.css">
	<?php
		ini_set('display_startup_errors', 1);
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
		error_reporting(~E_STRICT);

		require('./nav-bar.php');
		require('./parsedown/Parsedown.php');
		//require('./parsedown/ParsedownExtra.php');

		if(isset($_GET['filename'])) {
			$filename = $_GET['filename'];
		} else {
			$filename = substr($entries[$noEntries - 1], 10);
		}

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
		if( $filename === "list" ) {
			echo "This be the list";
		} else {
			$Pd = new Parsedown();
			echo $Pd->text(file_get_contents('./entries/' . $filename));
		}
?>

</div> <!-- content -->

</div> <!-- all -->

</body>
</html>
