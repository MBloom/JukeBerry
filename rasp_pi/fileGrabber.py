from os import listdir
from os.path import isfile, join
import eyed3
import requests


musicHome = '/home/pi/Music/'
piName = 'cs4414projectpi'


count = 1

artists = [f for f in listdir(musicHome) if not isfile(f)]
fileLibrary = open('library.csv', 'w')
fileMapping = open('directoryMapping.txt', 'w')
for artist in artists:
	albums = [f for f in listdir(musicHome + artist) if not isfile(f)]
	for album in albums:
		songs = [f for f in listdir(musicHome + artist +'/' + album)]
		for song in songs:
			audiofile = eyed3.load(musicHome + artist + '/' + album + '/' + song)
			artistInfo = audiofile.tag.artist
			albumInfo = audiofile.tag.album
			songInfo = audiofile.tag.title
			fileLibrary.write(piName + ',' + artistInfo + ',' + albumInfo + ',' + songInfo + ',' + str(count) + '\n')
			fileMapping.write(str(count) + ',' + musicHome + artist + '/' + album + '/' + song + '\n')
			count +=1
fileLibrary.close()
fileMapping.close()

#r = requests.get('http://ec2-54-186-3-95.us-west-2.compute.amazonaws.com/phptest.php')
#print r.content
r = requests.post('http://ec2-54-186-3-95.us-west-2.compute.amazonaws.com/library.php', files={'csv': open('library.csv', 'rb')})
print r.text
