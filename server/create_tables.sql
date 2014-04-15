DROP TABLE IF EXISTS songs;
DROP TABLE IF EXISTS queue;
DROP TABLE IF EXISTS users;
CREATE TABLE songs (id int, artist text, title text, album text, pi_owner text);
CREATE TABLE queue (song_id int,  text);
CREATE TABLE users (name text, password text, roll text);
INSERT INTO users VALUES('admin', 'password', 'admin');