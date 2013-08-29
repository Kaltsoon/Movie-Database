CREATE TABLE Genre(
	genreId int NOT NULL,
	name varchar(15) NOT NULL
	PRIMARY KEY (genreId)
)
CREATE TABLE Id(
	movieId int,
	genreId int,
	personId int
)
CREATE TABLE InMovie(
	movieId int NOT NULL,
	personId int NOT NULL,
	task int NOT NULL,
	FOREIGN KEY (movieId) REFERENCES Movie(movieId),
	FOREIGN KEY (personId) REFERENCES Person(personId)
)
CREATE TABLE Movie(
	movieId int NOT NULL,
	name varchar(50) NOT NULL,
	description varchar(1000),
	premierDate date,
	duration int,
	submitDate date,
	PRIMARY KEY (movieId)
)
CREATE TABLE MovieAndGenre(
	movieId int NOT NULL,
	genreId int NOT NULL,
	FOREIGN KEY (movieId) REFERENCES Movie(movieId),
	FOREIGN KEY (genreId) REFERENCES Genre(genreId)
)
CREATE TABLE Person(
	name varchar(30) NOT NULL,
	personId int NOT NULL,
	dateOfBirth date,
	placeOfBirth varchar(30),
	PRIMARY KEY (personId)
)
CREATE TABLE Review(
	movieId int NOT NULL,
	username varchar(20) NOT NULL,
	stars int NOT NULL,
	review varchar(1000) NOT NULL,
	submitDate timestamp,
	FOREIGN KEY (movieId) REFENRENCES Movie(movieId),
	FOREIGN KEY (username) REFERENCES User(username)
)
CREATE TABLE Role(
	personId int NOT NULL,
	movieId int NOT NULL,
	name varchar(30),
	FOREIGN KEY (personId) REFERENCES Person(personId),
	FOREIGN KEY (movieId) REFERENCES Movie(movieId)
)
CREATE TABLE User(
	username varchar(20) NOT NULL,
	password varchar(20) NOT NULL,
	description varchar(500),
	favoriteMovie varchar(50),
	favoriteActor varchar(50),
	registerDate date,
	permission int,
	PRIMARY KEY (username)
)