# Database-Web-Development-Learning-Management-System
Design database based on ER, use MYSQL to populate tables, create database on Google Cloud Platform, implement 22 webpages in HTML and PHP for the development of learning management system. Functions include viewing course details, grading, Q&amp;A, etc.

## Overview
The Mathematics and Computer Science (MathCS) Department wants to hire you to create a web application to replace Canvas, our learning management system. The learning management system will allow students and faculty to manage grades and discussion questions seamlessly (think of this as simplified Canvas with Piazza support integrated seamlessly).

## Database Design (ER diagram)
<img width="739" alt="Screenshot 2021-12-24 at 6 18 06 PM" src="https://user-images.githubusercontent.com/73702692/147374068-87906b22-b470-44d2-8f66-ce60a954f7c9.png">

Assumptions:
Has:
1. A class doesn’t need to have questions. 2. A question must belong to 1 class. 3. A class have N questions 4. A question belongs to 1 class.
Takes:
1. A class must have students. 2. A student don’t need to taken any classes. 3. A class have N students 4. A student takes N classes.
Instructor:
1. A class must have instructor. 2. An instructor must belong to one class. 3. A class have N instructors. 4. An instructor teaches N classes.
TA:
1. A class doesn’t need to have TAs. 2. A student doesn’t need to be TA. 3. A class have N TAs. 4. A TA belongs to N classes.
Assigns:
1. A class doesn’t need to assign assignments. 2. An assignment must be assigned by one class. 3. A class assigns N assignments. 4. An assignment is assigned by 1 class.
Does:
1. A student doesn’t need to do assignments. 2. An assignment doesn’t need to be done by students. 3. A student does N assignments. 4. An assignments is done by N students.
Replies:
1. A question doesn’t have to be replied by any replies. 2. A reply must reply to one question. 3. A question has N replies. 4. A reply belongs to 1 question.

## Relational Model Creation

<img width="771" alt="Screenshot 2021-12-24 at 6 19 45 PM" src="https://user-images.githubusercontent.com/73702692/147376581-aa1737b8-8688-484a-8986-f5253dd1f3bb.png">

## Database Normalization

Student -> sid, loginid, fname, lname cnum -> cname
cid, aname -> duedate, atext, points cnum, semester, year -> instructorID cid, qnum -> qnum, title, qtext, postdate cid, aname, sid -> ngrade
cid, sid -> lgrade
cid, qnum, rnum -> sid, time, rtext
My relational schema is in 2NF as there are no non-key attributes functionally depend on a subset of the key. My relational schema is also in 3NF as there are non-key attributes functionally dependent on attributes that are not super key. I build another schema called ‘course’ from Q1 to Q2 to prevent the issue since cnum along can determine cname.

## Files Explaination:

php files:
* login.html: login page
login2.html: login page for instructor/TA
authenticate.php: authenticate the sid and login id of the student a2.php: authenticate the sid and login id of the instructor/TA homepage.php: homepage for students
homepage2.php: homepage for instructor/TA
create.php: create assignment
igrade.php, g1.php, grade2.php: instructor/TA grading page
helloworld.php: for testing
index.html: for testing
grade.php
qa.php: Q&A page
postc.php: post question page
reply1, reply2.php: reply page
tag.php, tag2.php: tag page
teach.php: instructor specific teach page trans.php: transcript page
