DROP TABLE IF EXISTS WebsiteUsers;
DROP TABLE IF EXISTS Threads;
DROP TABLE IF EXISTS ThreadComments;
DROP TABLE IF EXISTS UserImages;

CREATE TABLE WebsiteUsers(
    username VARCHAR(30),
    email    VARCHAR(100),
    password VARCHAR(50),
    admin BOOLEAN,
    allowedToPost BOOLEAN,
    PRIMARY KEY (username)
);

CREATE TABLE UserImages(
    username VARCHAR(30),
    imageContentType VARCHAR(255),
    userImage BLOB,
    PRIMARY KEY (username)
);

CREATE TABLE Threads(
    id INT AUTO_INCREMENT,
    creatorUserName VARCHAR(30),
    date DATETIME,
    threadTitle VARCHAR(100),
    threadQuestion  VARCHAR(500),
    threadTopic VARCHAR(50),
    numberOfViews INTEGER,
    PRIMARY KEY (id)
);

CREATE TABLE ThreadComments(
    id INT AUTO_INCREMENT,
    threadId INT,
    creatorUserName VARCHAR(30),
    date DATETIME,
    content VARCHAR(500),
    PRIMARY KEY (id)
);

-- password admin1
INSERT INTO WebsiteUsers Values ("admin1", "admin1@example.com", "e00cf25ad42683b3df678c61f42c6bda", TRUE, TRUE);
-- password admin2
INSERT INTO WebsiteUsers Values ("admin2", "admin2@example.com", "c84258e9c39059a89ab77d846ddab909", TRUE, TRUE);

-- password 123
INSERT INTO WebsiteUsers Values ("user1", "user1@example.com", "202cb962ac59075b964b07152d234b70", FALSE, TRUE);
-- password 234
INSERT INTO WebsiteUsers Values ("user2", "user2@example.com", "289dff07669d7a23de0ef88d2f7129e7", FALSE, TRUE);
-- password 345
INSERT INTO WebsiteUsers Values ("user3", "user3@example.com", "d81f9c1be2e08964bf9f24b15f0e4900", FALSE, TRUE);


INSERT INTO Threads Values (1, "user1",  "2018-01-28 1:1:1", "What is Quantum Physics?", "Hello, I am interested in quantum physics could someone give an overview of what it is? Thanks", "Physics", 0);
INSERT INTO Threads Values (2, "user2",  "2019-10-17 1:1:1", "What is the clock rate of a CPU??", "Could someone could explain what the clock rate of a cpu is? Thanks", "Computers", 0);
INSERT INTO Threads Values (3, "user2",  "2019-10-17 1:1:1", "Newton's Second law", "What is Newton's second law? F = ma?", "Physics", 0);
INSERT INTO Threads Values (4, "user2",  "2019-10-17 1:1:1", "What hardware do you need for creating a robot?", "I'm interested in creating a robot and am not sure what components I will need. Could someone explain the essentials?", "Robotics", 0);
INSERT INTO Threads Values (5, "user2",  "2019-10-17 1:1:1", "What operating systems run on phones?", "Hey everyone, I am familiar with computer operating systems a bit, but don't know about operating systems for phones.", "Mobile Phones", 0);
INSERT INTO Threads Values (6, "user2",  "2019-10-17 1:1:1", "Taking integrals", "Why do you increase the exponent by one, then divide by the new number?", "Math", 0);
INSERT INTO Threads Values (7, "user2",  "2019-10-17 1:1:1", "Describing dimensions with more than 3 spacial dimensions", "How to describe 4 dimensional space?", "Math", 0);
INSERT INTO Threads Values (8, "user2",  "2019-10-17 1:1:1", "Discrete and Continouos mathematics", "What are discrete and continuous mathematics?", "Math", 0);
INSERT INTO Threads Values (9, "user2",  "2019-10-17 1:1:1", "What programming language to use for robotics", "Could someone could explain what programming language works well with robotics?", "Robotics", 0);
INSERT INTO Threads Values (10, "user2", "2019-10-17 1:1:1", "What is bandwidth?", "Could someone could explain what bandwidth is? Thanks", "Internet", 0);
INSERT INTO Threads Values (11, "user2", "2019-10-17 1:1:1", "What are the main components of a computer?", "What are the main components of a computer?", "Computers", 0);
INSERT INTO Threads Values (12, "user2", "2019-10-17 1:1:1", "What is an operating system?", "What is an operating system? How does software run directly on the hardware?", "Computers", 0);


INSERT INTO ThreadComments Values (1, 1, "user2",   "2018-02-1 1:1:1", "This is a comment to the thread titled 'What is Quantum Physics?' ");
INSERT INTO ThreadComments Values (2, 2, "user3",   "2018-02-1 1:1:1", "This is a comment to the thread titled 'What is the clock rate of a CPU??' ");
INSERT INTO ThreadComments Values (3, 3, "user2",   "2018-02-1 1:1:1", "This is a comment to the thread titled 'Newton's Second law' ");
INSERT INTO ThreadComments Values (4, 4, "user3",   "2018-02-1 1:1:1", "This is a comment to the thread titled 'What hardware do you need for creating a robot?' ");
INSERT INTO ThreadComments Values (5, 5, "user3",   "2018-02-1 1:1:1", "This is a comment to the thread titled 'What operating systems run on phones?' ");
INSERT INTO ThreadComments Values (6, 6, "user2",   "2018-02-1 1:1:1", "This is a comment to the thread titled 'Taking integrals' ");
INSERT INTO ThreadComments Values (7, 7, "user3",   "2018-02-1 1:1:1", "This is a comment to the thread titled 'Describing dimensions with more than 3 spacial dimensions' ");
INSERT INTO ThreadComments Values (8, 8, "user3",   "2018-02-1 1:1:1", "This is a comment to the thread titled 'Discrete and Continouos mathematics' ");
INSERT INTO ThreadComments Values (9, 9, "user2",   "2018-02-1 1:1:1", "This is a comment to the thread titled 'What programming language to use for robotics' ");
INSERT INTO ThreadComments Values (10, 10, "user2", "2018-02-1 1:1:1", "This is a comment to the thread titled 'What is bandwidth?' ");
INSERT INTO ThreadComments Values (11, 11, "user3", "2018-02-1 1:1:1", "This is a comment to the thread titled 'What are the main components of a computer?' ");
INSERT INTO ThreadComments Values (12, 12, "user3", "2018-02-1 1:1:1", "This is a comment to the thread titled 'What is an operating system?' ");
INSERT INTO ThreadComments Values (13, 12, "user1", "2018-02-1 1:1:1", "This is a comment to the thread titled 'What is an operating system?' ");
INSERT INTO ThreadComments Values (14, 11, "user1", "2018-02-1 1:1:1", "This is a comment to the thread titled 'What are the main components of a computer?' ");
INSERT INTO ThreadComments Values (15, 10, "user1", "2018-02-1 1:1:1", "This is a comment to the thread titled 'What is bandwidth?' ");
INSERT INTO ThreadComments Values (16, 9, "user1",  "2018-02-1 1:1:1", "This is a comment to the thread titled 'What programming language to use for robotics' ");
INSERT INTO ThreadComments Values (17, 8, "user2",  "2018-02-1 1:1:1", "This is a comment to the thread titled 'Discrete and Continouos mathematics' ");
INSERT INTO ThreadComments Values (18, 7, "user3",  "2018-02-1 1:1:1", "This is a comment to the thread titled 'Describing dimensions with more than 3 spacial dimensions' ");
INSERT INTO ThreadComments Values (19, 6, "user3",  "2018-02-1 1:1:1", "This is a comment to the thread titled 'Taking integrals' ");
INSERT INTO ThreadComments Values (20, 5, "user3",  "2018-02-1 1:1:1", "This is a comment to the thread titled 'What operating systems run on phones?' ");
INSERT INTO ThreadComments Values (21, 4, "user2",  "2018-02-1 1:1:1", "This is a comment to the thread titled 'What hardware do you need for creating a robot?' ");
INSERT INTO ThreadComments Values (22, 3, "user2",  "2018-02-1 1:1:1", "This is a comment to the thread titled 'Newton's Second law' ");
INSERT INTO ThreadComments Values (23, 2, "user2",  "2018-02-1 1:1:1", "This is a comment to the thread titled 'What is the clock rate of a CPU??' ");
INSERT INTO ThreadComments Values (24, 1, "user2",  "2018-02-1 1:1:1", "This is a comment to the thread titled 'What is Quantum Physics?' ");

