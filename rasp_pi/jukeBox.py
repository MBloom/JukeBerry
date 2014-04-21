import pygame
from collections import deque

direct = dict()
fileContents = []

queue = deque()

with open('directoryMapping.txt') as f:
	fileContents = f.readlines()

for line in fileContents:
	split = line.split(',')
	direct[int(split[0])] = split[1]

pygame.mixer.init()

queue.append(3)

while True:
	if pygame.mixer.music.get_busy() == False:
		songInt = queue.popleft()
		songLoc = direct[songInt].strip()
		print '/home/axel/Music/DaveMatthews/LIveInAtlanticCity/D1_01_SeekUp.mp3'
		print songLoc
		pygame.mixer.music.load(songLoc)
		pygame.mixer.music.play()
