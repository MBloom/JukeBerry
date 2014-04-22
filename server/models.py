from hashlib import sha256
from datetime import datetime
from binascii import hexlify, unhexlify
import os

from sqlalchemy import (Column, String, LargeBinary, 
                        create_engine, ForeignKey, 
                        Boolean, DateTime, Integer,
                        Enum,)
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import sessionmaker, relationship
from flask import g

DB_NAME = 'jb.db'

engine = create_engine('sqlite:///%s' % DB_NAME, echo=False)
Base = declarative_base()

# global application level session, which handles all conversations with the db
Session = sessionmaker(bind=engine)

#returns a single user from the db
def get_user(name):
    return g.db.query(User).filter_by(name=name).first()


class User(Base):
    __tablename__ = 'users'

    name      = Column(String, primary_key=True)
    password  = Column(String)
    roll = Column(String)

    def __repr__(self):
        return "<User(name={}, pw={}, roll={})>".format(self.name, self.password, self.roll)

    @classmethod
    def check_password(cls, uname, password):
        actual = get_user(uname)
        return actual.password == password

    @classmethod
    def is_admin(cls, uname):
        actual = get_user(uname)
        return actual.userClass == "admin"

    #Flask-login required functions
    def is_authenticated(self):
            return True

    def is_active(self):
        return True

    def is_anonymous(self):
        return False

    def get_id(self):
        u = get_user(self.name)
        return u.name

class Song(Base):
    __tablename__ = 'songs'

    id = Column(Integer, primary_key=True)
    album = Column(String)
    artist = Column(String)
    title = Column(String)
    pi_owner = Column(String)

    def __init__(self, **kwargs):
        for key, val in kwargs.iteritems():
            setattr(self, key, val)

    def to_dict(self):
        return {
                 'id': self.id,
                 'album': self.album,
                 'artist': self.artist,
                 'title': self.title,
                 'pi_owner': self.pi_owner
                }


class Queue(Base):
    __tablename__ = 'queue'

    id = Column(Integer, ForeignKey('songs.id'), primary_key=True)
    owner  = Column(String, ForeignKey('songs.id'), primary_key=True)

    def __init__(self, **kwargs):
        for key, val in kwargs.iteritems():
            setattr(self, key, val)


if __name__ == '__main__':
    Base.metadata.create_all(engine)
    session = Session()
    admin = User(name="admin", password="password", userClass="admin")
    session.add(admin)
    session.commit()
