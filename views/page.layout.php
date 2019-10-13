<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="author" content="<?php echo $author; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo "$title © $author"; ?>">

	<title><?php echo $title; ?></title>

	<link rel="icon" href="views/images/favicon.ico">

	<link rel="stylesheet" type="text/css" href="libraries/Bootstrap-3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="libraries/Bootstrap-3.3.7/css/bootstrap-theme.min.css">

	<link rel="stylesheet" type="text/css" href="libraries/Font-Awesome-4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="views/styles/style.css">
	<link rel="stylesheet" type="text/css" href="views/styles/loader.css">
</head>

<body class="bg"><!-- onload="(function(){sleep(1000)}).call(this)" -->

	<div id="loader"></div>

	<div id="header" class="container">
		<div class="row"></div>
	</div>

	<div id="navibar">
		<?php include_once("imports/navbar.php"); ?>
	</div>

	<div id="content" class="container">
		<?php include_once("$file_page_content"); ?>
	</div>

	<div id="footer" class="container">
		<div class="row"><?php include_once("imports/footer.php"); ?></div>
	</div>

	<?php include_once("imports/about.php"); ?>

	<script type="text/javascript" src="libraries/jQuery-3.1.1/jquery-3.1.1.min.js"></script>

	<script type="text/javascript" src="libraries/Bootstrap-3.3.7/js/bootstrap.min.js"></script>

	<?php include_once("imports/jsdefines.php"); ?>

	<script type="text/javascript" src="views/scripts/misc.js"></script>
	<script type="text/javascript" src="views/scripts/events.js"></script>
	<script type="text/javascript" src="views/scripts/loader.js"></script>

	<?php include_once("imports/lazincl.php"); ?>

</body>

</html>