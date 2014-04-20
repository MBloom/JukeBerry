from os import listdir
from os.path import isfile, join

artists = [f for f in listdir('/home/axel/Music') if not isfile(f)]
for artist in artists:
	albums = [f for f in listdir('/home/axel/Music/' + artist) if not isfile(f)]
	for album in albums:
		songs = [f for f in listdir('/home/axel/Music/'+ artist +'/' + album)]
		for song in songs:
			print artist + ',' + album + ',' + song
