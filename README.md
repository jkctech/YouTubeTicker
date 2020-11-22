# YouTube Ticker

Are you dedicated to watching ALL YouTube videos from a specific channel? The *"watched"* feature from YouTube isn't always accurate and maybe you want a clean overlook of how much you still have to watch?

This is project started as a small idea, and grew out to a few days of development, and something I really use. This is intended to be hosted somewhere on a webserver with PHP access.

![](https://i.imgur.com/UwWlx3n.jpg)

### Disclaimer

This project is built as a small tool for personal use. Because of this, there is no form of authentication (yet). I personally use this with `Basic HTTP Authentication`.

### Features
 - Mark what videos you watched of a specific channel.
 - Get a random video from the list of unwatched videos.

### Installation

This mini tool has last been tested with `Apache2` and `PHP7.3` on `22-11-2020`.

1. Make sure you have a Google YouTube API key.
1. Make sure you have some webhosting space. (> 1Mb)
1. Clone / Download this repository.
1. Move all files from `web` into the webroot of your choice.
1. Move to `includes` and copy `settings_default.php` to `settings.php`.
1. Open up `settings.php` and change what is needed.
1. You are now ready to track your views!

### Planned features
 - Support for multiple channels on 1 dashboard
 - Authentication
 - Quick share buttons
 - Android App