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

queue.append(22)

while True:
	if pygame.mixer.music.get_busy() == False:
		songInt = queue.popleft()
		songLoc = direct[songInt].strip()
		pygame.mixer.music.load(songLoc)
		pygame.mixer.music.play()

