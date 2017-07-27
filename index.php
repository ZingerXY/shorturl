<?php 
header('Content-Type: text/html;charset=UTF-8');

include "config.php";

$msg = "";

if (!empty($_GET['hash'])) {
	$hash = mysqli_real_escape_string($mysqli, $_GET['hash']);
	$result = mysqli_query($mysqli, "SELECT * FROM urllist WHERE hash='$hash' LIMIT 1");
	if (!mysqli_error($mysqli) && mysqli_affected_rows($mysqli) > 0) {
		$myrow = mysqli_fetch_assoc($result);
		$url = $myrow['url'];
		header("Location: $url");
	} else {
		$msg = "<script>alert('Error link');</script>";
	}
}
?>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>ShortURL</title>
	<meta name=viewport content="width=device-width, initial-scale=0.6">	
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">	
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="main">
		<center>
			<form>
				<div class="box">URL: <input type="text" name="url" id="url"></div>
				<div class="box">Text: <input type="text" name="text" id="text" placeholder="[text for url]"></div>
				<div class="box"><input type="button" value="Get short url" onclick="getShortUrl()"></div>
			</form>
			<div id="shortUrl"></div>
		</center>
	</div>	
	<script type="text/javascript" src="js/jquery-3.1.0.min.js" ></script>
	<script type = "text/javascript" src = "js/app.js"></script>
	<?=$msg;?>
</body>
</html>
