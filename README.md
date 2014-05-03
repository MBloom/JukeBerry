JukeBrry
========

cs4414 final project

Ever wanted to have multiple people in charge of a playlist? Changing phones can be a hassle, and who wants to let just one person decide the music that everyone is listening to?

JukeBrry works as a solution for this problem: users can add songs to a playlist remotely and in real time from a music library stored on a Raspberry Pi. Since the Pi can play the music as well, no one has to sacrifice their phone and leave it plugged into the speakers. Instead, users simply access the JukeBrry site (which renders on mobile as well, thanks to Twitter's Bootstrap) and are able to add songs from the pre-populated library. 

The site features an auto-complete feature so that users don't have to remember the entire song title, artist, and album in order to add it to the current playlist. However, users can also view the entire library in a sortable table using the Library tab from the home page, and will be able to add songs from that page as well. Users can delete songs that they added, but not songs that other users added to combat monopolization of the playlist. Administrators can view all users along with their user roles, but not their passwords for security reasons. 

Users must make an account in order to use the site, in order to keep track of who has added what songs in addition to deletion privileges for specific songs. In this way, users can also only add a specific song to the playlist once, though other users can add that song again (i.e., User A can add song Z only once, but users B and C can also add song Z once) in order to account for all users' preferences.

The site automatically refreshes the playlist to show users the most updated version, and that interval can be adjusted in server/templates/home.html. The page also refreshes whenever a user deletes a song. 

To run the site:
1.  Change the IP address for the Raspberry Pi in the config file
2.  Run server/app.py and leave this running

The site should be up and running after that! If you choose to just view the site instead of downloading it yourself, you can view the site at 54.185.3.96. However, please remember that this is an AWS MicroInstance, because of cost concerns, so the server may crash because of bandwidth restrictions at any time.
