<?php
	require_once(__DIR__ . "/includes/settings.php");
	require_once(__DIR__ . "/includes/functions.php");

	$file = $s['cache']['folder'] . $s['cache']['watched'];

	// Basic checks
	if (
		!isset($_POST['id']) || // Empty ID
		!isset($_POST['status']) || // Empty status
		($_POST['status'] != "watched" && $_POST['status'] != "notwatched") || // Invalid status
		preg_match("/[a-z0-9_-]{11}/i", $_POST['id']) == false // Invalid YT id
	)
	{
		http_response_code(403);
		die();
	}

	// Create file if needed
	if (!file_exists($file))
	{
		$f = fopen($file, "w");
		fclose($f);
	}

	// Get current items from file
	$items = explode(PHP_EOL, file_get_contents($file));

	// If watched, add to list
	if ($_POST['status'] == "watched")
	{
		$items[] = $_POST['id'];
	}

	// If not watched, remove
	if ($_POST['status'] == "notwatched")
	{
		if (($key = array_search($_POST['id'], $items)) !== false) {
			unset($items[$key]);
		}
	}

	// Make sure it's unique
	$items = array_unique($items);

	// Strip empty elements
	$items = array_filter($items);

	// Combine into 1 stirng again
	$result = implode(PHP_EOL, $items);

	// Save to file
	file_put_contents($file, $result);
?>