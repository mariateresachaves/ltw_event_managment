CREATE TABLE users (
	username VARCHAR PRIMARY KEY,
	name VARCHAR,
	password VARCHAR,
	email VARCHAR,
	dateu DATE,
	gender VARCHAR,
	registdate DATETIME DEFAULT current_timestamp
);

CREATE TABLE events (
	ide INTEGER PRIMARY KEY AUTOINCREMENT,
	ucreator VARCHAR REFERENCES users(username),
	image VARCHAR,
	datee DATE,
	description VARCHAR,
	typee VARCHAR
);

CREATE TABLE eventsusers (
	eventid INTEGER REFERENCES events(ide) ON DELETE CASCADE,
	username VARCHAR REFERENCES users(username),
	PRIMARY KEY (eventid, username)
);

CREATE TABLE comments (
	idc INTEGER PRIMARY KEY AUTOINCREMENT,
	username VARCHAR REFERENCES users(username),
	ide REFERENCES events(ide) ON DELETE CASCADE,
	text VARCHAR
);

INSERT INTO users (username, name, password, email, dateu, gender) VALUES ('naodameu', 'Nuno Silva', 'amizade', 'ei2187@fe.up.pt', '1994-05-17', 'Male');
INSERT INTO events (ucreator, image, datee, description, typee) VALUES ('naodameu', 'images/stupidstuff.jpg', '2015-12-25', 'MERRY CHRISTMAS HO HO HO!', 'Concert');
INSERT INTO comments (username, ide, text) VALUES ('naodameu', '1', 'OMG CHRISTMAS IS GOING TO BE ROCKIN!');