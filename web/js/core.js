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
		btn.parent().parent().removeClass("unwatched")

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
		btn.parent().parent().addClass("unwatched")

		// Send update to backend
		sendUpdate(id, "notwatched");
	}
}

var prevTarget = null;
function randomVideo()
{
	var videos = $('.unwatched');
	var target = $(videos[Math.floor(Math.random()*videos.length)]);

	if (prevTarget != null)
		prevTarget.removeClass("border-info");

	if (target.offset() == undefined)
		return;
	
	$([document.documentElement, document.body]).animate({
		scrollTop: target.offset().top - $("#navbar").outerHeight(true) - 10
	}, 1000);

	target.addClass("border-info");

	prevTarget = target;
}