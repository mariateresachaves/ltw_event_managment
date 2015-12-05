PRAGMA foreign_keys = ON;

-- - USERS - --

CREATE TABLE users (
	username VARCHAR,
	name VARCHAR,
	password VARCHAR,
	email VARCHAR UNIQUE,
	birthdate DATE,
	gender VARCHAR,
    registdate DATETIME DEFAULT current_timestamp,
    token VARCHAR DEFAULT NULL,
    PRIMARY KEY (username)
);

-- - EVENTS - --

CREATE TABLE events (
	id_event INTEGER,
	username VARCHAR,
    id_events_types INTEGER,
    name VARCHAR,
	image VARCHAR,
	event_date DATE,
	description TEXT,
    visibility INTEGER, -- 0-> Public 1-> Private
    PRIMARY KEY (id_event),
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE ON UPDATE CASCADE
);

-- - EVENTS_TYPES - ---

CREATE TABLE events_types (
    id_events_types INTEGER,
    name VARCHAR UNIQUE,
    PRIMARY KEY (id_events_types)
);

-- - PARTICIPATIONS - --

CREATE TABLE participations (
    username VARCHAR,
    id_event INTEGER,
    PRIMARY KEY (username, id_event),
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_event) REFERENCES events(id_event) ON DELETE CASCADE ON UPDATE CASCADE
);

-- - COMMENTS - --

CREATE TABLE comments (
    username VARCHAR,
    id_event INTEGER,
    text TEXT,
    PRIMARY KEY (username, id_event),
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_event) REFERENCES events(id_event) ON DELETE CASCADE ON UPDATE CASCADE
);

-- ------------------------------------------------------------

-- INSERT INTO users (username, name, password, email, birthdate, gender) VALUES ('naodameu', 'Nuno Silva', 'amizade', 'ei2187@fe.up.pt', '1994-05-17', 'Male');
-- INSERT INTO users (username, name, password, email, birthdate, gender) VALUES ('mtc', 'Maria Chaves', 'yay', 'up201306842@fe.up.pt', '1993-07-22', 'Female');
-- INSERT INTO events_types (id_events_types, name) VALUES (NULL, 'Concert');
-- INSERT INTO events (id_event, username, name, image, event_date, description, id_events_types) VALUES (NULL, 'naodameu', 'Christmas', 'images/stupidstuff.jpg', '2015-12-25', 'MERRY CHRISTMAS HO HO HO!', 1);
-- INSERT INTO comments (username, id_event, text) VALUES ('naodameu', 1, 'OMG CHRISTMAS IS GOING TO BE ROCKIN!');

-- onclick=\"$(this).Click('" . $event['id_event'] . ", " . $going . "')\">
-- $.fn.Click = function(id_event, going) {
--                    changeGoing(id_event, going);
--                };

-- 
--            $(document).ready(function() {
--                $('.eventForm').on('click','.going',function() {
--                    alert("HEllo");
--                });
--            });