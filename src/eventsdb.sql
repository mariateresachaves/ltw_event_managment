DROP TABLE USERP;

CREATE TABLE IF NOT EXISTS USERP (
	usernamep VARCHAR PRIMARY KEY,
	password VARCHAR NOT NULL,
	email VARCHAR NOT NULL,
	date_b DATE NOT NULL,
	image_p VARCHAR NOT NULL,
	regist_date DATETIME NOT NULL DEFAULT current_timestamp
);

INSERT INTO USERP (usernamep, password, email, date_b, image_p)
VALUES ('asdasda', 'asdasda', 'dasdasd@fesfsef.com', '17-02-11', 'http://fsfsfsfsdf/effs.com');