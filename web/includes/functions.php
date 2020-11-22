<?php
	/*
	* Get all videos from the channel.
	*
	* Might take some seconds depending on the amount of videos.
	* Costs API credit as well so don't overuse it :)
	*/
	function getAllVideos()
	{
		global $s;

		// Store all video data to return :)
		$videos = array();
		
		// First URL we use to access the API
		// We expand with pagination parameters later on.
		$baseurl = "https://www.googleapis.com/youtube/v3/search?";

		// Base params for the request
		$params = http_build_query(array(
			"key" => $s['ytkey'],
			"channelId" => $s['channel']['id'],
			"part" => "snippet,id",
			"order" => "date",
			"maxResults" => 50
		));
		
		// Append params to request
		$baseurl .= $params;

		// We chane $url on every iteration, set the first
		$url = $baseurl;

		// Loop untill further notice
		while (true)
		{
			// Get data from API and parse it to an object
			$data = json_decode(file_get_contents($url));

			// Loop over all items from the search
			foreach($data->items as $item)
			{
				// If it's a video
				if ($item->id->kind == "youtube#video")
				{
					// Append to list
					$videos[] = array(
						"title" => $item->snippet->title,
						"id" => $item->id->videoId,
						"url" => "https://www.youtube.com/watch?v=" + $item->id->videoId,
						"thumbnail" => $item->snippet->thumbnails->medium->url
					);
				}
			}

			// If this field is empty, this means there is no next page.
			if (!empty($data->nextPageToken))
				$url = $baseurl . "&pageToken=" . $data->nextPageToken;
			else
				break;
		}

		return ($videos);
	}

	/*
	* Get videos from either the cache or the API.
	* If the cache is new enough, use that, otherwise get from API.
	*/
	function getVideos()
	{
		global $s;

		$file = $s['cache']['folder'] . $s['cache']['videos'];

		// If cachefile does not exist or is older than we want it to be...
		// Download new data		
		if (!file_exists($file) || time() - filemtime($file) > $s['cache']['refresh'])
		{
			// Download from the API
			$videos = getAllVideos();

			// Run data through an encode and decode stage to make it into an object.
			// Ideally, you should cast this, but it does not work so let's get dirty.
			$videos = json_decode(json_encode($videos));

			// Save it to the cachefile
			file_put_contents($file, json_encode($videos));
		}
		else
		{
			// Just get the data from the cachefile
			$videos = json_decode(file_get_contents($file));
		}

		return ($videos);
	}

	/*
	* Return array of watched video ID's
	*/
	function getWatched()
	{
		global $s;

		$file = $s['cache']['folder'] . $s['cache']['watched'];

		// Make sure we always return an array, empty or not.
		if (!file_exists($file))
			$watched = array();
		else
			$watched = explode(PHP_EOL, file_get_contents($file));

		return ($watched);
	}
?>