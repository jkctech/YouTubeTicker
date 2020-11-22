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
		<!-- CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<link href="<?= $s['baseurl']; ?>css/style.css" rel="stylesheet">
		<!-- Favicon -->
		<link rel="apple-touch-icon" sizes="180x180" href="<?= $s['baseurl']; ?>assets/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?= $s['baseurl']; ?>assets/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?= $s['baseurl']; ?>assets/favicon/favicon-16x16.png">
		<link rel="manifest" href="<?= $s['baseurl']; ?>assets/favicon/site.webmanifest">
		<link rel="mask-icon" href="<?= $s['baseurl']; ?>assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="shortcut icon" href="<?= $s['baseurl']; ?>assets/favicon/favicon.ico">
		<meta name="msapplication-TileColor" content="#2d89ef">
		<meta name="msapplication-config" content="<?= $s['baseurl']; ?>assets/favicon/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">
	</head>
	<body class="bg-light">
		<div class="container">
			<!-- Navbar -->
			<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light" id="navbar">
				<a class="navbar-brand" href="#">
					<img src="<?= $s['channel']['icon']; ?>" class="navlogo"> <?= $s['title']; ?>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarContent">
					<div style="margin-left: auto; order: 2">
						<button class="btn btn-light" onclick="randomVideo()"><i class="fas fa-random"></i> Random</button>
						<a href="sync.php" class="btn btn-light"><i class="fas fa-sync-alt"></i> Sync Videos</a>
					</div>
				</div>
			</nav>
			<!-- /Navbar -->

			<!-- Content -->
			<div class="row">
				<?php
					foreach($videos as $video)
					{
						echo '<div class="col col-12 col-sm-6 col-md-4 col-lg-3 mb-3">';
							echo '<div class="card' . (in_array($video->id, $watched) ? "" : " unwatched") . '" id="video-' . $video->id . '">';
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
			<!-- /Content -->
		</div>
	</body>
	<!-- Footer -->
	<footer class="my-5 pt-5 text-muted text-center text-small">
		<p class="mb-1">&copy; Jeffrey Koopman <?= date("Y"); ?> | <a href="https://github.com/jkctech/YouTubeTicker">Check on GitHub</a></p>
	</footer>
	<!-- /Footer -->
	<!-- Scripts -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" integrity="sha384-9/D4ECZvKMVEJ9Bhr3ZnUAF+Ahlagp1cyPC7h5yDlZdXs4DQ/vRftzfd+2uFUuqS" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<script src="<?= $s['baseurl']; ?>js/core.js"></script>
	<!-- /Scripts -->
</html>