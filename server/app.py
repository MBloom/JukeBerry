from flask import Flask, request, g, render_template, redirect, abort, url_for, Response, session
from flask.ext.login import LoginManager, login_required, login_user, logout_user, current_user

import config, models
from models import Session, User, Song, Queue
from forms import LoginForm, AccountForm, SongForm
from sqlalchemy import exc
import collections
import json
from sqlalchemy.exc import IntegrityError

app = Flask(__name__, static_folder='static')
app.config.from_object(config)

login_manager = LoginManager()
login_manager.init_app(app)

# initializes a per request db session
@app.before_request
def create_session():
    g.db = Session()

# closes and commits that session
@app.after_request
def commit_session(resp):
    g.db.commit()
    return resp


@login_manager.user_loader
def load_user(uname):
    # returns none if user does not exist
    return models.get_user(uname)

@app.route('/create/', methods=["GET", "POST"])
def create_user():
    form = AccountForm(request.form)
    if form.validate():
        user = models.get_user(form.data['username'])
        if user != None:
            message = "User already exists. Please choose another username."
            return render_template("create.html", form=form, message=message)
        elif form.data['password'] != form.data['auth_pass']:
            message = "Passwords do not match."
            return render_template("create.html", form=form, message=message)
        else:
            new_user = User(name=form.data['username'],
                            password=form.data['password'],
                            roll="user")
            g.db.add(new_user)
            login_user(new_user)
            return redirect(url_for("home"))
    print form.data
    return render_template("create.html", form=form, message=None)

@app.route('/add/', methods=["POST"])
def add() :
    form = SongForm(request.form)
    if form.validate():
        songData = form.data['song'].split(" - ")
        notTitle = songData[1].split(" (")
        artist = notTitle[0]
        album = notTitle[1].split(")")[0]
        song = models.get_song(songData[0], artist, album)
        user = models.get_user(current_user.get_id())
        print song.id
        print song.artist
        print song.album
        print song.pi_owner
        if song != None and user != None:
            nextSong = Queue(id=song.id, album = song.album, artist = song.artist, title = song.title, pi_owner = song.pi_owner, owner=user.name)
            try:
                g.db.add(nextSong)
                g.db.session.flush()
                return redirect(url_for("home"))
            except IntegrityError:
                #g.db.rollback()
                return render_template("home.html", error="You've already added that song to the list!") 
            #return redirect(url_for("home"))
        return render_template("home.html", error="Song not in available list.")
    return render_template("home.html", error="form not valid")

@app.route('/login/', methods=["GET", "POST"])
def login():
    form = LoginForm(request.form)
    message = ""
    if form.validate():
        # since the form isn't bad, we check for valid user
        user = models.get_user(form.data['username'])
        if user != None and User.check_password(form.data['username'], form.data['password']):
            login_user(user)
            return redirect(url_for("home"))
        else :
            message = "Username/Password do not match"
    return render_template("login.html", form=form, message=message)


@app.route('/logout/')
def logout():
    logout_user()
    return redirect(url_for("home"))

@app.route('/admin/')
@login_required
def admin():
    num_songs = len(g.db.query(Queue).all())
    users = g.db.query(User).all()
    # admin authentication
    admins = g.db.query(User).filter_by(roll="admin")
    if current_user.get_id() in admins:
        return render_template('admin.html', users=users, num_songs=num_songs)
    else:
        return render_template('admin.html', users=users, num_songs=num_songs)

@app.route('/')
def home():
    yours = []
    uname = current_user.get_id()
    all_songs = g.db.query(Song).all()
    your_songs = g.db.query(Queue).filter_by(owner=uname).all()
    return render_template('home.html', your_songs=your_songs, uname=uname, songs=all_songs)

if __name__ == '__main__':
    app.run('0.0.0.0', port=19199,  debug=True)