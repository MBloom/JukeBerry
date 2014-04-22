from wtforms.form import Form
from wtforms import StringField, PasswordField
from wtforms.validators import Length

class LoginForm(Form):
    username = StringField('Username', validators=[Length(min=3, max=30)])
    password = PasswordField('Password', validators=[Length(min=3, max=30)])

class AccountForm(Form):
	username = StringField('Username', validators=[Length(min=3, max=30)])
	password = PasswordField('Password', validators=[Length(min=3, max=30)])
	auth_pass = PasswordField('Repeat Password')

class SongForm(Form):
	song = StringField('Title', validators=[Length(min=3, max=250)])
	#album = StringField('Album', validators=[Length(min=3, max=250)])
	#artist = StringField('Artist', validators=[Length(min=3, max=250)])
