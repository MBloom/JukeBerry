import requests


r = requests.post('http://ec2-54-186-3-95.us-west-2.compute.amazonaws.com/library.php', files={'csv': open('library.csv', 'rb')})
print r.text 
