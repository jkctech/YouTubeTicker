<?php
	require_once(__DIR__ . "/includes/settings.php");
	require_once(__DIR__ . "/includes/functions.php");

	$file = $s['cache']['folder'] . $s['cache']['videos'];

	unlink($file);

	header("Location: " . $s['baseurl']);
	die();
?>