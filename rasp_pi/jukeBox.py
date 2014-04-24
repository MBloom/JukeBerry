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


def getQueueRepeat():	
	lock.acquire()
	print 'GETTING QUEUE!!!'
	#Get queue here!!!!
	try:
		queue.clear()
		payload = {'raspID' : 'cs4414projectpi'}
		r = requests.get('http://54.186.3.95/queue.php', params=payload)
		print 'Request send!'
		seperate = r.content.split(',')
		seperate[0] = seperate[0][4:]
		for song in seperate:
			if len(song) is not 0:
				queue.append(int(song))
		print queue
	finally:
		lock.release()
	##################	
	threading.Timer(15, getQueueRepeat).start()



getQueueRepeat()

while True:
	if pygame.mixer.music.get_busy() == False and len(queue) is not 0:
		lock.acquire()
		try:
			songInt = queue.popleft()
			sendInfo = {'songID': songInt, 'raspID' : 'cs4414projectpi'}
			#send to server to pop songInt
			requests.get('http://ec2-54-186-3-95.us-west-2.compute.amazonaws.com/pop.php', params = sendInfo) 
			print 'requestSent'
			songLoc = direct[songInt].strip()
			pygame.mixer.music.load(songLoc)
			pygame.mixer.music.play()
		finally:
			lock.release()	
		time.sleep(30)
		pygame.mixer.music.stop()
