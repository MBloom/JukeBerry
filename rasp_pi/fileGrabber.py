from os import listdir
from os.path import isfile, join
import eyed3

musicHome = '/home/axel/Music/'

count = 1

artists = [f for f in listdir(musicHome) if not isfile(f)]
fileLibrary = open('library.txt', 'w')
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
			fileLibrary.write(artistInfo + ',' + albumInfo + ',' + songInfo + ',' + str(count) + '\n')
			fileMapping.write(str(count) + ',' + musicHome + artist + '/' + album + '/' + song + '\n')
			count +=1
fileLibrary.close()
fileMapping.close()