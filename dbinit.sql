CREATE DATABASE theater_manager;

USE theater_manager;

-- Users Table

CREATE TABLE users (
	handle VARCHAR(30) unique NOT NULL,
	name VARCHAR(50) ,
	email VARCHAR(50),
	pass VARCHAR(100),
	status INT default 0,
	type INT default 0,
	primary key(handle)
);

-- Events

CREATE TABLE events(
	id VARCHAR(5),
	title VARCHAR(100) NOT NULL,
	stime TIME,
	etime TIME,
	edate DATE,
	location VARCHAR(50),
	caption VARCHAR(100),
	img_path VARCHAR(50) NOT NULL,
	rating DOUBLE check (rating < 10) default 5,
	cr_user VARCHAR(30) NOT NULL,
	cr_time TIMESTAMP,
	details TEXT,
	primary key(id),
	foreign key(cr_user) references users(handle) on delete cascade on update cascade
);

-- Categories

CREATE TABLE catagory(
	cid VARCHAR(5),
	cat_name VARCHAR(50),
	primary key(cid)
);

-- Evenet catagory

CREATE TABLE eve_cat(
	eid VARCHAR(5),
	cat_id VARCHAR(5),
	foreign key(eid) references events(id) on delete cascade on update cascade,
	foreign key(cat_id) references catagory(cid) on delete cascade on update cascade
);

CREATE TABLE comments(
	eid VARCHAR(5),
	uname VARCHAR(30),
	cm_data MEDIUMTEXT,
	cm_time TIMESTAMP,
	imp INT default 0,
	foreign key(eid) references events(id) on delete cascade on update cascade,
	foreign key(uname) references users(handle) on delete cascade on update cascade
);

CREATE TABLE followers(
	user_id VARCHAR(30),
	eid VARCHAR(5),
	foreign key(user_id) references users(handle) on delete cascade on update cascade,
	foreign key(eid) references events(id) on delete cascade on update cascade
);

CREATE VIEW best_eve as(
	SELECT title,COUNT(user_id) as num FROM followers f,events e WHERE f.eid = e.id GROUP BY title ORDER BY num desc
);   

-- Admin with rank 2
INSERT INTO users VALUES('admin','admin','admin@thportal.in','admin',1,2);

INSERT INTO users VALUES('organizer','organizer','organizer@thportal.in','organizer',1,1);
INSERT INTO users VALUES('normaluser','normaluser','normaluser@thportal.in','normal',1,0);

INSERT INTO catagory VALUES('NOCAT','....');