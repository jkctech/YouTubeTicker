<?php
	$datafile = __DIR__ . "/../data/videos.txt";

	# Basic checks
	if (
		!isset($_POST['id']) || # Empty ID
		!isset($_POST['status']) || # Empty status
		($_POST['status'] != "watched" && $_POST['status'] != "notwatched") || # Invalid status
		preg_match("/[a-z0-9_-]{11}/i", $_POST['id']) == false # Invalid YT id
	)
	{
		http_response_code(403);
		die();
	}

	# Create file if needed
	if (!file_exists($datafile))
	{
		$file = fopen($datafile, "w");
		fclose($file);
	}

	# Get current items from file
	$items = explode(PHP_EOL, file_get_contents($datafile));

	# If watched, add to list
	if ($_POST['status'] == "watched")
	{
		$items[] = $_POST['id'];
	}

	# If not watched, remove
	if ($_POST['status'] == "notwatched")
	{
		if (($key = array_search($_POST['id'], $items)) !== false) {
			unset($items[$key]);
		}
	}

	# Make sure it's unique
	$items = array_unique($items);

	# Combine into 1 stirng again
	$result = implode(PHP_EOL, $items);

	# Save to file
	file_put_contents($datafile, $result);
?>