CREATE TABLE users (
	username VARCHAR PRIMARY KEY,
	name VARCHAR,
	password VARCHAR,
	email VARCHAR,
	dateu DATE,
	image VARCHAR,
	gender VARCHAR,
	regist_date DATETIME NOT NULL DEFAULT current_timestamp
);