import pygame
from collections import deque
import threading
import time
import requests

direct = dict()
fileContents = []
lock = threading.Lock()

queue = deque()

with open('directoryMapping.txt') as f:
	fileContents = f.readlines()

for line in fileContents:
	split = line.split(',')
	direct[int(split[0])] = split[1]

pygame.mixer.init()

#queue.append(3)


def getQueue():	
	lock.acquire()
	print 'GETTING QUEUE!!!'
	#Get queue here!!!!
	try:
		queue.clear()
		payload = {'raspID' : 'cs4414projectpi'}
		r = requests.get('http://54.186.3.95/queue.php', params=payload)
		seperate = r.content.split(',')
		seperate[0] = seperate[0][4:]
		for song in seperate:
			queue.append(int(song))
		print queue
	finally:
		lock.release()
	##################	
	threading.Timer(30, getQueue).start()



getQueue()




while True:
	if pygame.mixer.music.get_busy() == False and len(queue) is not 0:
		lock.acquire()
		try:
			songInt = queue.popleft()
			#sendInfo = {'songID': songInt}
			#send to server to pop songInt
			#requests.get('ec2-54-186-3-95.us-west-2.compute.amazonaws.com/pop.php'	) 
			songLoc = direct[songInt].strip()
			pygame.mixer.music.load(songLoc)
			pygame.mixer.music.play()
		finally:
			lock.release()
	time.sleep(10)
	pygame.mixer.music.stop()
