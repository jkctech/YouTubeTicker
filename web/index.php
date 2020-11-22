<?php
	require_once(__DIR__ . "/includes/settings.php");
	require_once(__DIR__ . "/includes/functions.php");

	$videos = getVideos();
	$watched = getWatched();
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>YouTube Ticker</title>
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body class="bg-light">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="#">
					<img src="<?= $s['channel']['icon']; ?>" class="navlogo"> <?= $s['title']; ?>
				</a>
			</nav>
			<hr>
			<div class="row">
				<?php
					foreach($videos as $video)
					{
						echo '<div class="col col-12 col-md-3 mb-3">';
							echo '<div class="card" id="video-' . $video->id . '">';
								echo '<div class="card-header">' . $video->title . '</div>';
								echo '<div class="card-body' . (in_array($video->id, $watched) ? " watched" : "") . '">';
									echo '<a href="' . $video->url . '" target="_blank">';
										echo '<img src="' . $video->thumbnail . '" class="w-100">';
									echo '</a>';
								echo '</div>';
								echo '<div class="card-footer">';
									if (in_array($video->id, $watched))
										echo '<button class="btn btn-success w-100" onclick="updateVideo(this, \'' . $video->id . '\')"><i class="fas fa-check"></i> Watched!</button>';
									else
										echo '<button class="btn btn-light w-100" onclick="updateVideo(this, \'' . $video->id . '\')">Not yet watched</button>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
				?>
			</div>
		</div>
	</body>
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/fontawesome/js/all.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script>
		function sendUpdate(id, status)
		{
			$.ajax({
				type: "POST",
				url: "update.php",
				data: {
					id: id,
					status: status
				}
			});
		}

		function updateVideo(element, id)
		{
			var parent = $(element.parentElement);
			var btn = $(element);

			if (btn.html() == "Not yet watched")
			{
				// Mark as watched
				btn.removeClass("btn-light");
				btn.addClass("btn-success");
				btn.html('<i class="fas fa-check"></i> Watched!');
				btn.parent().parent().find(".card-body").addClass("watched")

				// Send update to backend
				sendUpdate(id, "watched");
			}
			else
			{
				// Mark as unwatched
				btn.addClass("btn-light");
				btn.removeClass("btn-success");
				btn.html('Not yet watched');
				btn.parent().parent().find(".card-body").removeClass("watched")

				// Send update to backend
				sendUpdate(id, "notwatched");
			}
		}
	</script>
</html>