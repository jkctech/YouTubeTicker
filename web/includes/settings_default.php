<?php
	// Global Settings array
	$s = array();

	// Your Google YouTube API key
	$s['ytkey'] = "";

	/*
	* Information about the channel you want to track
	*
	* You an get the ID and icon URL of any channel from this tool:
	* https://commentpicker.com/youtube-channel-id.php
	*
	* The name can be anything you would like it to be.
	*/
	$s['channel'] = array();
	$s['channel']['id'] = "UCUuMYw2l2UeWyTGYixYfRCA";
	$s['channel']['name'] = "Evan And Katelyn";
	$s['channel']['icon'] = "https://yt3.ggpht.com/ytc/AAUvwnid8WWA4bkOmwdvGK5ESCk0H3EACW3C3lf96fpm8w=s88-c-k-c0x00ffffff-no-rj";

	/*
	* The base URL of where this code is placed.
	*
	* For relative, leave empty.
	* For anything else, put your URL and make sure it ends with a '/'.
	*/
	$s['baseurl'] = "https://google.com/";

	// The navbar title
	$s['title'] = $s['channel']['name'] . " Tracker";

	/*
	* Caching
	*
	* For as far as you can call this caching...
	* This made as much "portable" as possible, hence no fancy real caching.
	* Videos from a channel and your list of watched videos will be stored here.
	*/
	$s['cache'] = array();

	// Basefolder for cached files
	$s['cache']['folder'] = __DIR__ . "/../data/";

	// Filename where we store channel's video data
	$s['cache']['videos'] = "videos.json";

	// Where we store the video ID's you watched
	$s['cache']['watched'] = "watched.txt";

	// After the videos file is this time old, get new data from YT
	$s['cache']['refresh'] = 3600 * 24;
?>