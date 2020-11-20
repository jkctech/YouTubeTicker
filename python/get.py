import json
import requests
import keys

# EDIT THIS
channel_id = "UCUuMYw2l2UeWyTGYixYfRCA"

first_url = 'https://www.googleapis.com/youtube/v3/search?key={}&channelId={}&part=snippet,id&order=date&maxResults=25'.format(keys.yt_key, channel_id)
videos = []
url = first_url

# Loop over all pages
while True:
	raw = requests.get(url).text
	resp = json.loads(raw)

	# Loop over video items
	for i in resp['items']:
		# If it's a video...
		if i['id']['kind'] == "youtube#video":
			# Append video to list
			videos.append({
				"title": i['snippet']['title'],
				"id": i['id']['videoId'],
				"url": 'https://www.youtube.com/watch?v=' + i['id']['videoId'],
				"thumbnail": i['snippet']['thumbnails']['medium']['url']
			})

	# Try moving to next page
	try:
		next_page_token = resp['nextPageToken']
		url = first_url + '&pageToken={}'.format(next_page_token)
	except:
		break

# Save video list as JSON
data = json.dumps(videos)

# Save to file
out = open("videos.json", "w")
out.write(data)
out.close() 
