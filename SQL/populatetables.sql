USE canvas;

CREATE TABLE assignment(
   cid   VARCHAR (5),
   aname VARCHAR (30),
   duedate  VARCHAR(30), 
   atext  VARCHAR (255),
   points   SMALLINT,
   PRIMARY KEY (cid, aname)
);

LOAD DATA LOCAL INFILE 
'assignment.csv' 
INTO TABLE assignment
FIELDS TERMINATED BY ',' 
IGNORE 1 rows;

CREATE TABLE class(
   cid   VARCHAR (5),
   cnum   CHAR (5),
   semester VARCHAR (10),
   year   CHAR (4),
   PRIMARY KEY (cid)
);

LOAD DATA LOCAL INFILE 
'class.csv' 
INTO TABLE class
FIELDS TERMINATED BY ',' ;

CREATE TABLE reply(
   cid    VARCHAR(5),
   qnum   VARCHAR (5),
   rnum   VARCHAR (5),
   sid    VARCHAR (20),
   time   VARCHAR (20),
   rtext  VARCHAR (255),
   PRIMARY KEY (cid,qnum,rnum)
);

LOAD DATA LOCAL INFILE 
'reply.csv' 
INTO TABLE reply
FIELDS TERMINATED BY ',' ;

CREATE TABLE course(
   cnum   CHAR (5),
   cname   VARCHAR (50),
   PRIMARY KEY (cnum)
);

LOAD DATA LOCAL INFILE 
'course.csv' 
INTO TABLE course
FIELDS TERMINATED BY ',';

CREATE TABLE instructor(
   cid   VARCHAR (5),
   instructorID   VARCHAR (20),
   PRIMARY KEY (cid, instructorID)
);

LOAD DATA LOCAL INFILE 
'instructor.csv' 
INTO TABLE instructor
FIELDS TERMINATED BY ','
IGNORE 1 rows;

CREATE TABLE grade(
   cid   VARCHAR (5),
   sid   VARCHAR (20),
   aid   VARCHAR (5),
   ngrade VARCHAR(5), 
   PRIMARY KEY (cid, sid, aid)
);

LOAD DATA LOCAL INFILE 
'grade.csv' 
INTO TABLE grade
FIELDS TERMINATED BY ','
IGNORE 1 rows;

CREATE TABLE post(
   cid   VARCHAR (5),
   pnum   VARCHAR (20),
   ptitle VARCHAR (255),
   ptext VARCHAR (255),
   pdate VARCHAR(30),
   psid VARCHAR (20),
   PRIMARY KEY (cid, pnum)
);

LOAD DATA LOCAL INFILE 
'post.csv' 
INTO TABLE post
FIELDS TERMINATED BY ',' 
IGNORE 1 rows;

CREATE TABLE student(
   sid   VARCHAR (20),
   lid   VARCHAR (20),
   fname VARCHAR (20),
   lname VARCHAR (20),
   PRIMARY KEY (sid)
);

LOAD DATA LOCAL INFILE 
'student.csv' 
INTO TABLE student
FIELDS TERMINATED BY ',';

CREATE TABLE TA(
   cid   VARCHAR (5),
   TAID   VARCHAR (20),
   PRIMARY KEY (cid, TAID)
);

LOAD DATA LOCAL INFILE 
'TA.csv' 
INTO TABLE TA
FIELDS TERMINATED BY ','
IGNORE 1 rows;

CREATE TABLE tag(
   qnum   VARCHAR (2),
   tag  VARCHAR(20),
   cid   CHAR (1),
   PRIMARY KEY (qnum, tag, cid)
);

LOAD DATA LOCAL INFILE 
'tag.csv' 
INTO TABLE tag
FIELDS TERMINATED BY ','
IGNORE 1 rows;

CREATE TABLE takes(
   cid   VARCHAR (5),
   sid   VARCHAR (20),
   lgrade  VARCHAR(2),
   PRIMARY KEY (cid, sid)
);

LOAD DATA LOCAL INFILE 
'takes.csv' 
INTO TABLE takes
FIELDS TERMINATED BY ','
IGNORE 1 rows;